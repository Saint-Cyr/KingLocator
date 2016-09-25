<?php

namespace KingBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class InterestAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('categoryInstance')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('icon')
            ->add('categoryInstance')
            ->add('latitude')
            ->add('staticImageName')
            ->add('animatedImageName')
            ->add('audioName')
            ->add('audioVisualName')
            ->add('longitude')
            ->add('staticImage')
            ->add('officialAddress')
            ->add('localAddress')
            ->add('createdAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
        ->with('Connexion Information', array('class' => 'col-md-4'))
            
            ->add('name')
            ->add('whatsApp')
            ->add('createdAt')
        ->end()
        ->with('Media information', array('class' => 'col-md-4'))
            ->add('staticImageName')
            ->add('animatedImageName')
            ->add('audioName')
            ->add('audioVisualName')
        ->end()
        ->with('Address informations', array('class' => 'col-md-4'))
            ->add('latitude', null, array('disabled' => 'disabled'))
            ->add('longitude', null, array('disabled' => 'disabled'))
            ->add('officialAddress', null, array('disabled' => 'disabled'))
            ->add('localAddress')
        ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('latitude')
            ->add('longitude')
            ->add('officialAddress')
            ->add('localAddress')
            ->add('createdAt')
        ;
    }
}
