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
            ->add('name')
            ->add('officialAddress')
            ->add('localAddress')
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
            ->add('staticImageName')
            ->add('animatedImageName')
            ->add('audioName')
            ->add('audioVisualName')
            ->add('name')
            ->add('whatsApp')
            ->add('latitude')
            ->add('longitude')
            ->add('officialAddress')
            ->add('localAddress')
            ->add('createdAt')
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
