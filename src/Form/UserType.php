<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['label'=>'Nom :', 'required'=>true])
            ->add('prenom', TextType::class, ['label'=>'Prénom :', 'required'=>true])
            ->add('email', EmailType::class, ['label'=>'Email :', 'required'=>true])            
            ->add('plainPassword', PasswordType::class, ['label'=>'Mot de passe','required'=>false,'mapped'=>false])
            ->add('adresses', EntityType::class, ['class'=>Adresse::class, "label"=>"Adresse :", "multiple"=>true, "required"=>false])
            ->remove('isVerified')
            ->remove('roles', ChoiceType::class, ['label'=>'Rôle :','choices'=>['Utilisateur'=>'USER', 'Administrateur'=>'ADMIN',],
                'required'=>true,
                'mapped'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
