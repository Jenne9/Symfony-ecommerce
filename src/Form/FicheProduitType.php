<?php

namespace App\Form;

use App\Entity\FicheProduit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('type')
            ->add('format')
            ->add('pellicule')
            ->add('mesure')
            ->add('autofocus')
            ->add('iso')
            ->add('obturation')
            ->add('poids')
            ->add('dimension')
            ->add('couleur')
            ->add('flash')
            ->add('amplificateur')
            ->add('hautParleur')
            ->add('equaliseur')
            ->add('impedance')
            ->add('rendement')
            ->add('pavillon')
            ->add('filtre')
            ->add('vitesse')
            ->add('cellule')
            ->add('produit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FicheProduit::class,
        ]);
    }
}
