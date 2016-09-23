<?php

namespace KingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class InterestType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('officePhone')
            ->add('whatsApp')
            ->add('latitude')
            ->add('officialAddress')
            ->add('staticImage', FileType::class, array('label' => 'Static Image', 'required' => true))
            ->add('animatedImage', FileType::class, array('label' => 'Animated image (gif)', 'required' => true))
            ->add('audio', FileType::class, array('label' => 'Audio file', 'required' => true))
            ->add('audioVisual', FileType::class, array('label' => 'Audio visual file', 'required' => true))
            ->add('localAddress')
            ->add('longitude')
            ->add('categoryInstance')
            ->add('icon')
            ->add('save', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KingBundle\Entity\Interest'
        ));
    }
}
