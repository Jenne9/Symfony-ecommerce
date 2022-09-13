<?php

namespace App\DataFixtures;

use App\Entity\FicheProduit;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class FicheProduitFixtures extends Fixture 
{
    public const S2= "NIKON-S2";

    public function load(ObjectManager $manager): void
    {
        $ficheProduit = new FicheProduit();
            $ficheProduit->setNom('S2');
            $ficheProduit->setTechnologie("Film Type: 135 (35mm)
            Lens: 5cm f/1.4 Nippon Kogaku Nikkor-S coated 7-elements
            ");
            $this->addReference(self::S2, $ficheProduit);
            $manager->persist($ficheProduit);

        $manager->flush();
    }

}
