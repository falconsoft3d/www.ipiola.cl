<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BuildingType extends AbstractType
{
    protected $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'label' => $this->translator->trans('field.building.name'),
        ));

        $builder->add('date', DateType::class, array(
            'label'  => $this->translator->trans('field.building.date'),
            'widget' => 'single_text',
            'input'  => 'datetime',
            'format' => 'MM/dd/yyyy',
        ));

        // $builder->get('date')->addModelTransformer(new CallbackTransformer(
        //     function ($dateTime) {
        //         return $dateTime->format('M/d/Y');
        //     },
        //     function ($strDate) {
        //         return new \DateTime();
        //     }
        // ));

        $builder->add('architect', TextType::class, array(
            'label' => $this->translator->trans('field.building.architect'),
        ));

        $builder->add('comments', TextareaType::class, array(
            'label'    => $this->translator->trans('field.building.comments'),
            'required' => false,
        ));

        $builder->add('imageFile', VichImageType::class, array(
            'label'         => $this->translator->trans('field.building.image_file'),
            'required'      => false,
            'allow_delete'  => true,
            'download_link' => true,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Building'
        ));
    }
}