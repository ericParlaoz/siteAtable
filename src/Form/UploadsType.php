<?php

namespace App\Form;

use App\Entity\Fichiers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class UploadsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', null, [
            'label' => 'Nom de fichier',
            'attr' => ['placeholder' => 'Nom du fichier'],
            'required' => false
        ])
           // ->add('UpdatedAt')
           //->add('CreatedAt')
           ->add('file', VichFileType::class, [
            'required' => false,
               'allow_delete' => true,
             'delete_label' => 'Supprimer le fichier',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fichiers::class,
        ]);
    }
}
