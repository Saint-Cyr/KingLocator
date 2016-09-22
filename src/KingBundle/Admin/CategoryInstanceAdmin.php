<?php

namespace KingBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CategoryInstanceAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
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
            ->add('logo', null, array('template' => 'KingBundle:Default:list.html.twig'))
            ->add('headOfficeAdress')
            ->add('headOfficePhone')
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
        ->with('Details', array('class' => 'col-md-8'))
            ->add('name')
            ->add('description', 'textarea', array('attr' => array('class' => 'ckeditor')))
            ->add('headOfficeAdress')
            ->add('headOfficePhone')
            ->add('file', 'file', array('required' => true))
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
            ->add('createdAt')
            ->add('description')
            ->add('logo')
            ->add('headOfficeAdress')
            ->add('headOfficePhone')
        ;
    }
    
    public function prePersist($image)
    {
        $this->manageFileUpload($image);
    }
    public function preUpdate($image)
    {
        $this->manageFileUpload($image);
    }
    private function manageFileUpload($image)
    {
        if ($image->getFile()) {
            $image->refreshUpdated();
        }
    }
}
