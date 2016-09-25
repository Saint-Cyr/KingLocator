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
            ->add('user')
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
        $requiredField = (preg_match('/_edit$/', $this->getRequest()->get('_route'))) ? false : true;
        
        $formMapper
        ->with('Details 1', array('class' => 'col-md-4'))
            ->add('user')
            ->add('name')
            ->add('headOfficeAdress')
            ->add('headOfficePhone')
            ->add('file', 'file', array('required' => $requiredField))
        ->end()
        ->with('Details 2', array('class' => 'col-md-8'))
            ->add('description', 'textarea', array('attr' => array('class' => 'ckeditor')))
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
