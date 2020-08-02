<?php

namespace App\Controller\Admin;

use App\Entity\Employe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class EmployeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employe::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('departement'),
            TextField::new('user'),
            TextField::new('email'),
        ];
    }


    public function configureActions(Actions $actions): Actions
    {
        // if the method is not defined in a CRUD controller, link to its route

        return $actions
            // ...

            //   ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-file-alt')->linkToRoute('employe_new');

            }
            )
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->linkToRoute('employe_edit',function (Employe $entity) {
                    return [
                        'id' => $entity->getId(),

                    ];

            }
            );

    });

}
}
