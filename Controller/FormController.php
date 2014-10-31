<?php

namespace Opifer\EavBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Opifer\EavBundle\Form\Type\NestedContentType;

class FormController extends Controller
{
    /**
     * @Route(
     *     "/eav/form/submit/{valueId}",
     *     name="opifer.eav.form.submit",
     *     options={"expose"=true}
     * )
     * @Method({"POST"})
     *
     * @param Request $request
     * @param integer $valueId
     *
     * @return RedirectResponse
     */
    public function submitAction(Request $request, $valueId)
    {
        $value = $this->getDoctrine()->getRepository('OpiferEavBundle:FormValue')
            ->find($valueId);

        if (!$value) {
            throw new ResourceNotFoundException('No value with ID "'.$valueId.'" could be found.');
        }

        $template = $value->getTemplate();
        $entity = $this->get('opifer.eav.eav_manager')->initializeEntity($template);

        $form = $this->createForm('eav', $entity, ['valueId' => $valueId]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush($entity);

            if (is_null($value->getValue()) || $value->getValue() == '') {
                return new Response('Form was submitted successfully!');
            } else {
                return new RedirectResponse($value->getValue());
            }
        } else {
            foreach ($form->getErrors() as $error) {
                dump($error);
            }
            die;
        }
    }

    /**
     * Render a form type
     *
     * @Route(
     *     "/eav/form/render/{attribute}/{id}/{index}",
     *     name="opifer.eav.form.render",
     *     options={"expose"=true}
     * )
     *
     * @param Request        $request
     * @param string         $attribute
     * @param integer|string $id
     * @param integer        $index
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderAction(Request $request, $attribute, $id, $index)
    {
        $em = $this->getDoctrine();

        if (is_numeric($id)) {
            throw new \Exception('ID\s should not be allowed, cause we cannot guess the corresponding template');
            //$content = $em->getRepository('OpiferCmsBundle:Content')->find($id);
        }

        $template = $this->get('opifer.eav.template_manager')->getRepository()->findOneByName($id);

        $entity = $this->get('opifer.eav.eav_manager')->initializeEntity($template);

        // In case of newly added nested content, we need to add an index
        // to the form type name, to avoid same template name conflicts.
        $id = $id.NestedContentType::NAME_SEPARATOR.$index;

        $form = $this->createForm(new NestedContentType($attribute, $id), $entity);
        $form = $this->render('OpiferEavBundle:Form:render.html.twig', ['form' => $form->createView()]);

        $entity = $this->get('jms_serializer')->serialize($entity, 'json');

        return new JsonResponse([
            'form'    => $form->getContent(),
            'content' => json_decode($entity, true)
        ]);
    }
}