<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class MarqueFixtures extends Fixture 
{
    public const NIKON = 'NIKON';
    public const KODAK = 'KODAK';
    public const ROBERTS = 'ROBERTS';
    public const LINE_MAGNETIC = 'LINE MAGNETIC';
    public const VICTROLA = 'VICTROLA';
    public const KLIPSCH = 'KLIPSCH';
    public const COLUMBIA = 'COLUMBIA';
    
    public function load(ObjectManager $manager): void
    {
        $marque = new Marque();
            $marque->setNom('NIKON');
            $this->addReference(self::NIKON, $marque);
            $manager->persist($marque);

        $marque = new Marque();
            $marque->setNom('KODAK');
            $this->addReference(self::KODAK, $marque);
            $manager->persist($marque);
        
        $marque = new Marque();
            $marque->setNom('ROBERTS');
            $this->addReference(self::ROBERTS, $marque);
            $manager->persist($marque);

        $marque = new Marque();
            $marque->setNom('LINE MAGNETIC');
            $this->addReference(self::LINE_MAGNETIC, $marque);
            $manager->persist($marque);

        $marque = new Marque();
            $marque->setNom('VICTROLA');
            $this->addReference(self::VICTROLA, $marque);
            $manager->persist($marque);

        $marque = new Marque();
            $marque->setNom('KLIPSCH');
            $this->addReference(self::KLIPSCH, $marque);
            $manager->persist($marque);

        $marque = new Marque();
            $marque->setNom('COLUMBIA');
            $this->addReference(self::COLUMBIA, $marque);
            $manager->persist($marque);

        $manager->flush();
    }

}