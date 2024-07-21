<?php

namespace App\DataFixtures;

use App\Entity\Marques;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MarquesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $marques = [
            'LuxeDesign',
            'ModernComfort',
            'HomeStyle',
            'ClassicFurniture',
            'TrendyLiving',
            'ArtisanHome',
            'ContemporaryDesign',
            'UrbanStyle',
            'LuxuryLiving',
            'SmartFurniture',
            'ModernLiving',
            'RusticHome',
            'OfficeComfort',
            'OutdoorEssentials',
            'DesignerChoice',
            'BarTrends',
            'SleepWell',
            'BasicLiving',
            'StorageSolutions',
            'KidsZone',
            'RetroStyle',
            'UrbanLiving',
            'CottageCharm',
            'BabyEssentials',
            'ModernHome',
            'IndustrialDesign',
            'MultifunctionalFurniture',
            'ScandinavianDesign',
            'NaturalHome',
            'RusticLiving',
            'MinimalistStyle',
            'VintageVibes',
            'ScandinavianDesign',
            'BohemianLiving',
            'NordicComfort',
            'Ikea',
        ];

        foreach ($marques as $nom) {
            $marque = new Marques();
            $marque->setNom($nom);
            $manager->persist($marque);
        }

        $manager->flush();
    }
}
