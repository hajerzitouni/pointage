<?php

namespace App\Controller\Admin;

use App\Entity\Historique;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
Use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
Use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
class HistoriqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Historique::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
           /* IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),*/
            TextField::new('Employe'),
           DateTimeField::new('date'),
            TextField::new('heure_arrive'),
            TextField::new('heure_depart'),
            TextField::new('description'),
            TextField::new('ecart'),
            BooleanField::new('conge'),
        ];
    }


    public function configureActions(Actions $actions): Actions
    {

        return $actions
            // ...

             ->remove(Crud::PAGE_INDEX, Action::EDIT)
             ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::DELETE);
           /* -> add(Crud::PAGE_INDEX, Action::INDEX, function (Action $action) {
                return $action->setIcon('fa fa-file-alt')->linkToRoute('historique_index');

            }
            );*/

    }
}
