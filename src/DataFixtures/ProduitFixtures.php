<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\DataFixtures\MarqueFixtures;
use App\DataFixtures\CategorieFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\FicheProduitFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProduitFixtures extends Fixture implements DependentFixtureInterface
{
    

    public function load(ObjectManager $manager): void
    {
        // Instanciation d'un objet du modèle Produit
        $produit = new Produit();
            // On donne des valeurs aux propriétés de l'objet Produit
            $produit->setNom('S2');
                $produit->setDescription('Appareil photo ancien de collection');
                $produit->setQuantite(10);
                $produit->setPrix(450);
                $produit->setSlug('nikons2');
                $produit->setImageName('nikons2.jpg');
                $produit->setMarque($this->getReference(MarqueFixtures::NIKON));
                $produit->setCategorie($this->getReference(CategorieFixtures::PHOTO));
                $produit->setFicheProduit($this->getReference(FicheProduitFixtures::S2));

            // Memorisation de l'objet
            $manager->persist($produit);
            
            $produit = new Produit();
                $produit->setNom('Super8');
                $produit->setDescription("Elle intègre un écran LCD de 4 pouces qui est orientable à plus ou moins 45 degrés pour faciliter toute vos prises de vues. La caméra dispose d’un port pour carte SD qui vraisemblablement devrait, non pas servir à la prise d’images, mais à la prise de son.");
                $produit->setQuantite(2);
                $produit->setPrix(2000);
                $produit->setSlug('super8');
                $produit->setImageName('super8.png');
                $produit->setCategorie($this->getReference(CategorieFixtures::CAMERA));
                $produit->setMarque($this->getReference(MarqueFixtures::KODAK));
            $manager->persist($produit);

            $produit = new Produit();
                $produit->setNom('LM 845IA');
                $produit->setDescription("Le LM-845IA, est une évolution qualitative du LM-518. L'étage de puissance (2x22W) est un montage single ended de tubes 845 drivé par des 6P3P. L’amplificateur LM-845iA utilise des tubes triodes 845 montés en « single-ended » et fonctionnant en pure Classe A. Il délivre une puissance de 2x22W.");
                $produit->setQuantite(5);
                $produit->setPrix(3990);
                $produit->setSlug('lm845ia');
                $produit->setMarque($this->getReference(MarqueFixtures::LINE_MAGNETIC));
                $produit->setImageName('lm805.png');
                $produit->setCategorie($this->getReference(CategorieFixtures::AMPLI));
            $manager->persist($produit);

            $produit = new Produit();
                $produit->setNom('102');
                $produit->setDescription("Année 1930 avec manivelle.");
                $produit->setQuantite(1);
                $produit->setPrix(325);
                $produit->setSlug('columbia102');
                $produit->setMarque($this->getReference(MarqueFixtures::COLUMBIA));
                $produit->setImageName('columbia.png');
                $produit->setCategorie($this->getReference(CategorieFixtures::GRAMOPHONE));
            $manager->persist($produit);

            $produit = new Produit();
                $produit->setNom('The Sixes');
                $produit->setDescription("Équipée d'une entrée phono pré-amplifiée, la paire d'enceintes Klipsch The Sixes peut être raccordée directement à une platine vinyle. Cette chaîne vinyle est disponible sous la référence Klipsch The Sixes + Heritage Debut Carbon.");
                $produit->setQuantite(8);
                $produit->setPrix(669);
                $produit->setSlug('thesixes');
                $produit->setMarque($this->getReference(MarqueFixtures::KLIPSCH));
                $produit->setImageName('klipsch.png');
                $produit->setCategorie($this->getReference(CategorieFixtures::ENCEINTE));
            $manager->persist($produit);

            $produit = new Produit();
                $produit->setNom('rambler');
                $produit->setDescription("La radio portable Roberts Rambler BT au design vintage offre toutes les fonctions d'une radio moderne : Bluetooth, écran LCD, radio FM/DAB, double alarme et deux connectiques mini-jack (sortie casque et entrée analogique).");
                $produit->setQuantite(1);
                $produit->setPrix(119);
                $produit->setSlug('rambler');
                $produit->setMarque($this->getReference(MarqueFixtures::ROBERTS));
                $produit->setImageName('rambler.png');
                $produit->setCategorie($this->getReference(CategorieFixtures::RADIO));
            $manager->persist($produit);

            $produit = new Produit();
                $produit->setNom('victrola');
                $produit->setDescription("Platine FM.");
                $produit->setQuantite(1);
                $produit->setPrix(119);
                $produit->setSlug('victrola');
                $produit->setMarque($this->getReference(MarqueFixtures::VICTROLA));
                $produit->setImageName('victrola.png');
                $produit->setCategorie($this->getReference(CategorieFixtures::PLATINE));
            $manager->persist($produit);


// Injection en BDD
            $manager->flush();
        }
    

    public function getDependencies()
    {
        return [
            
            CategorieFixtures::class
        ];
    }
}

            