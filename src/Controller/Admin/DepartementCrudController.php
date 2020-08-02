<?php

namespace App\Controller\Admin;

use App\Entity\Departement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
Use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField ;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

class DepartementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Departement::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nom'),
            TextField::new('specialite'),
            //TextEditorField::new('description'),
            TextField::new('societe'),
           TextField::new('user','Chef Departement'),
            // DateTimeField::new('creation'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInSingular('departement')
            ->setEntityLabelInPlural('Departements')

            // the Symfony Security permission needed to manage the entity
            // (none by default, so you can manage all instances of the entity)
            ->setEntityPermission('ROLE_SUPER_ADMIN','ROLE_ADMIN')
           // ->setEntityPermission('ROLE_ADMIN')
            ;

    }

    public function configureActions(Actions $actions): Actions
    {
        // if the method is not defined in a CRUD controller, link to its route
        $sendInvoice = Action::new('Add', 'Add')
            // if the route needs parameters, you can define them:
            // 1) using an array
            ->linkToRoute('departement_new');
        return $actions
            // ...
            ->add(Crud::PAGE_INDEX, $sendInvoice)
         //   ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-file-alt')->linkToRoute('departement_new');

    }
    );

}
}
   /* public function createEntity(string $entityFqcn)
    {
        $Department = new Departement();
        //$Department->createdBy($this->getUser());

        return  $Department;
    }*/

