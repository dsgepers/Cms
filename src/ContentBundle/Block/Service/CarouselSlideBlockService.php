<?php

namespace Opifer\ContentBundle\Block\Service;

use Opifer\CmsBundle\Form\Type\CKEditorType;
use Opifer\ContentBundle\Block\Tool\Tool;
use Opifer\ContentBundle\Block\Tool\ToolsetMemberInterface;
use Opifer\ContentBundle\Entity\CarouselSlideBlock;
use Opifer\ContentBundle\Model\BlockInterface;
use Opifer\MediaBundle\Form\Type\MediaPickerType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Carousel Slide Block Service
 */
class CarouselSlideBlockService extends AbstractBlockService implements BlockServiceInterface, ToolsetMemberInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildManageForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildManageForm($builder, $options);

        $propertiesForm = $builder->get('properties')
            ->add('id', TextType::class, ['attr' => ['help_text' => 'help.html_id'], 'required' => false])
            ->add('extra_classes', TextType::class, ['attr' => ['help_text' => 'help.extra_classes'],'required' => false]);


        if ($this->config['styles']) {
            $builder->get('properties')
                ->add('styles', ChoiceType::class, [
                    'label' => 'label.styling',
                    'choices'  => array_combine($this->config['styles'], $this->config['styles']),
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true,
                    'attr' => [
                        'help_text' => 'help.html_styles',
                        'tag' => 'styles'
                    ],
                ]);
        }

        $builder->add(
            $builder->create('default', FormType::class, ['inherit_data' => true])
                ->add('media', MediaPickerType::class, [
                    'required'  => false,
                    'multiple' => false,
                    'attr' => [
                            'help_text' => 'help.carouselslide_media',
                        ]
                    ])
                ->add('value', CKEditorType::class, [
                    'label' => 'label.rich_text',
                    'attr' => [
                        'label_col' => 12,
                        'widget_col' => 12,
                        'help_text' => 'help.carouselslide_rich_text',
                    ],
                    'required' => false
                ])
        )->add(
            $propertiesForm
        );
    }

    /**
     * {@inheritDoc}
     */
    public function createBlock()
    {
        return new CarouselSlideBlock();
    }

    /**
     * @return array
     */
    public function getStyles()
    {
        return $this->config['styles'];
    }

    /**
     * @param array $styles
     */
    public function setStyles($styles)
    {
        $this->config['styles'] = $styles;
    }

    /**
     * {@inheritDoc}
     */
    public function getTool(BlockInterface $block = null)
    {
        $tool = new Tool('Carousel slide', 'carousel_slide');

        $tool->setIcon('filter')
            ->setDescription('A basic carousel slide');

        return $tool;
    }

    /**
     * @param BlockInterface $block
     * @return string
     */
    public function getDescription(BlockInterface $block = null)
    {
        return 'A basic carousel slide';
    }
}
