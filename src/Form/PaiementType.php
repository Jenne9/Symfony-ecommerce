<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Transporteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];
        $builder
            ->add('adresse', EntityType::class, ['class'=>Adresse::class, 'required'=>true, 'choices'=> $user->getAdresses(), 'multiple'=>false, 'expanded'=>true])
            ->add('transporteur', EntityType::class, ['class'=>Transporteur::class, 'required'=>true,'multiple'=>false, 'expanded'=>true])
            ->add('information', TextareaType::class, ['required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user'=> array()
        ]);
    }
}
