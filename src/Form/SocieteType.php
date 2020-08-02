<?php

namespace App\Form;

use App\Entity\Societe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class SocieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

            $builder
                ->add('adresse')
                ->add('nomsoc')
                ->add('tel')
                ->add('file',FileType::class, array('attr' => array('class' => 'form-control')));

            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Societe::class,
        ]);
    }
}
