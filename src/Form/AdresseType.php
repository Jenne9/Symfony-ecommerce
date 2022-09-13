<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['label'=>"Nom de l'adresse :"])
            ->add('rue', TextType::class, ['label'=>"Rue :"])
            ->add('complement', TextType::class, ['label'=>"Complément :", 'required'=>false])
            ->add('codePostal', TextType::class, ['label'=>"Code Postal :"])
            ->add('ville', TextType::class, ['label'=>"Ville :"])
            ->add('telephone', TextType::class, ['label'=>"Téléphone :"])
            ->add('pays', CountryType::class, ['label'=>"Pays :"] )
            ->remove('user');
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
