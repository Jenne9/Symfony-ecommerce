<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Produit;
use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Form\FicheProduitType;
use App\Form\ImageProduitType;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ["label"=>"Nom :"])
            ->add('slug', TextType::class, ["label"=>"Slug :", "required"=>false])           
            ->add('description', CKEditorType::class, ["label"=>"Description :", "required"=>false])
            ->add('quantite', IntegerType::class, ['label'=>"Stock :", "required"=>false])
            ->add('prix', MoneyType::class, ['label'=>"Prix :", "required"=>false])
            ->add('imageFile', FileType::class, ['label'=>'Photo :', "required"=>false])
            ->add('marque', EntityType::class, ['class'=>Marque::class, 'label'=>'Marque :', "required"=>false])
            ->add('isNew', ChoiceType::class, ['choices' => ['Oui' => true, 'Non' => false,], 'label'=>'Nouveauté :', "required"=>false])
            ->add('categorie', EntityType::class, ['class'=>Categorie::class, 'label'=>'Catégorie :', "required"=>false])
            // ->add('ficheProduit', FicheProduitType::class, [ 'label'=>false, "required"=>false])
            ->remove('imageName')
            ->remove('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
            
        ]);
    }
}
