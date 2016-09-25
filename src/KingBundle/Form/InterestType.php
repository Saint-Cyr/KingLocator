<?php

namespace KingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;


class InterestType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Get the contexted Icons
        $user = $options['user'];
        
        $categoryInstance = $user->getCategoryInstance();
        //Make sure the user is a client that have been register and linked to an CategoryInstance
        if(!$categoryInstance){
            throw new AccessDeniedException();
        }
        
        $icons = $categoryInstance->getIcons();
        
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
            ->add('icon', EntityType::class, array('class' => 'KingBundle:Icon',
                                                   'choice_label' => 'nickName',
                                                   'placeholder' => '---- Choose an icon ----',
                                                   'choices' => $icons,
                                                   ))
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
        //Passe the security service as a required option to the form
        $resolver->setRequired('user');
    }
}
