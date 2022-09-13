<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\DataFixtures\MarqueFixtures;
use App\DataFixtures\ProduitFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\FicheProduitFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategorieFixtures extends Fixture implements DependentFixtureInterface
{

// ====================================================== //
// ===================== PROPRIETES ===================== //
// ====================================================== //
    public const PHOTO = "Appareil photo";
    public const CAMERA = "Camera";
    public const AMPLI = "Ampli";
    public const PLATINE = "Platine";
    public const ENCEINTE = "Enceinte";
    public const RADIO = "Radio";
    public const GRAMOPHONE = "Gramophone";

// ====================================================== //
// ===================== METHODES ===================== //
// ====================================================== //
    public function load(ObjectManager $manager): void
    {
        $categorie = new Categorie();
            $categorie->setNom('Appareil Photo');
            $categorie->addMarque($this->getReference(MarqueFixtures::NIKON));
            $this->addReference(self::PHOTO, $categorie);
            $manager->persist($categorie);

        $categorie = new Categorie();
            $categorie->setNom('Camera');
            $categorie->addMarque($this->getReference(MarqueFixtures::KODAK));
            $this->addReference(self::CAMERA, $categorie);
            $manager->persist($categorie);

        $categorie = new Categorie();
            $categorie->setNom('Ampli');
            $categorie->addMarque($this->getReference(MarqueFixtures::LINE_MAGNETIC));
            $this->addReference(self::AMPLI, $categorie);
            $manager->persist($categorie);

        $categorie = new Categorie();
            $categorie->setNom('Platine');
            $categorie->addMarque($this->getReference(MarqueFixtures::VICTROLA));
            $this->addReference(self::PLATINE, $categorie);
            $manager->persist($categorie);

        $categorie = new Categorie();
            $categorie->setNom('Enceinte');
            $categorie->addMarque($this->getReference(MarqueFixtures::KLIPSCH));
            $this->addReference(self::ENCEINTE, $categorie);
            $manager->persist($categorie);

        $categorie = new Categorie();
            $categorie->setNom('Radio');
            $categorie->addMarque($this->getReference(MarqueFixtures::ROBERTS));
            $this->addReference(self::RADIO, $categorie);
            $manager->persist($categorie);

        $categorie = new Categorie();
            $categorie->setNom('Gramophone');
            $categorie->addMarque($this->getReference(MarqueFixtures::COLUMBIA));
            $this->addReference(self::GRAMOPHONE, $categorie);
            $manager->persist($categorie);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            
            MarqueFixtures::class,
            
        ];
    }


}
