<?php

namespace Opifer\ContentBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Opifer\ContentBundle\Model\DirectoryInterface;
use Opifer\ContentBundle\Event\ResponseEvent;
use Opifer\ContentBundle\OpiferContentEvents;

class DirectoryController extends Controller
{
    /**
     * Index
     *
     * @param Request $request
     *
     * optional parameters
     *     directory_id integer
     *
     * @return JsonResponse
     */
    public function indexAction(Request $request)
    {
        $dispatcher = $this->get('event_dispatcher');
        $event = new ResponseEvent($request);
        $dispatcher->dispatch(OpiferContentEvents::DIRECTORY_INDEX_RESPONSE, $event);
        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $manager = $this->get('opifer.content.directory_manager');
        $repository = $manager->getRepository();

        if ($request->get('directory_id')) {
            $curDirectory = $repository->find($request->get('directory_id'));

            $directories = $curDirectory->getChildren();
        } else {
            $directories = $repository->findBy(['parent' => null]);
        }

        $data = $this->get('jms_serializer')->serialize($directories, 'json');

        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }
}