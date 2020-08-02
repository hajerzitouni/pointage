<?php

namespace App\Controller\Admin;

use App\Entity\Societe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
Use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
class SocieteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Societe::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nomsoc'),
            TextField::new('adresse'),
            TextField::new('tel'),
            TextField::new('siteweb'),
            AssociationField::new('users')
            //TextField::new('users'),
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInSingular('Societe')
            ->setEntityLabelInPlural('Societes')

            // the Symfony Security permission needed to manage the entity
            // (none by default, so you can manage all instances of the entity)
            ->setEntityPermission('ROLE_SUPER_ADMIN')
            ;

    }

    public function configureActions(Actions $actions): Actions
    {
        // if the method is not defined in a CRUD controller, link to its route
        $sendInvoice = Action::new('Affecter', 'Affecter')
            // if the route needs parameters, you can define them:
            // 1) using an array
            ->linkToRoute('societe_edit2',function (Societe $entity) {
        return [
            'id' => $entity->getId(),

        ];

    });
        return $actions
            // ...
            ->add(Crud::PAGE_INDEX, $sendInvoice)->setPermission('Affecter', 'ROLE_SUPER_ADMIN')
            //   ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-file-alt')->linkToRoute('societe_new');

            }



            );

    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
