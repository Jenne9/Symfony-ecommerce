<?php

namespace App\Form;

use App\Entity\ImageProduit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ImageProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', FileType::class, ['label'=>false, 'required'=>false])
            ->remove('nom')
            ->remove('imageName')
            ->remove('updatedAt')
            ->remove('produits')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ImageProduit::class,
        ]);
    }
}
