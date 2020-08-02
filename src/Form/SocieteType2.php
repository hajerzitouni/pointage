<?php

namespace App\Form;

use App\Entity\Societe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
class SocieteType2 extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{

$builder
->add('Users',EntityType::class , [
    'class'=>User::class]
)
;



}

public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults([
'data_class' => Societe::class,
]);
}
}
