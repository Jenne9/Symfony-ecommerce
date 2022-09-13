<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class EditPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        
        ->add('plainPassword', RepeatedType::class, [
                'type'=>PasswordType::class,
                'first_options'=>['label'=> 'Mot de passe :'],
                'second_options'=>['label'=> 'Confirmer mot de passe :'],
                'mapped' => false,
            ])
        ->add('newpassword', PasswordType::class, ['label'=>'Nouveau mot de passe :'] )
        ->add('valider', SubmitType::class )

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
