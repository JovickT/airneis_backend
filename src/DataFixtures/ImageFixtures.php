<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $images = [
            'images/300x300-9555e51fdd6fb66ddb069acfd8dda99c.png',
            'images/300x300-8c52b68089e3ff546cb5a1da812fbc25.png',
            'images/300x300-52d6df8b5af8ae2a906b3d19b31e69b7.png',
            'images/300x300-60081e8ba86b535b5b4aac07fb838fce.png',
            'images/300x300-c061143dce5c75104eadd6daee18da91.png',
            'images/300x300-2b8fe00ba5cc327924e3ab49807f9951.png',
            'images/300x300-c684542cc0bfea4a5a78c415edf6e51b.png',
            'images/300x300-24a76b7b2bff9b6a14d6b81c26420086.png',
            'images/300x300-4efb7788222b6fa71da788e8263da13d.png',
            'images/300x300-cb4c1b5ae91d0db753475b836f641940.png',
            'images/300x300-a95062ba546c2bfd28c067273bf59678.png',
            'images/300x300-c3ceee366de254dd8f95169a0926bce4.png',
            'images/300x300-7e694e27c145f3536a7e15c9acb1ff13.png',
            'images/300x300-0fef85d749fdb11a5f81b88df14bb5de.png',
            'images/300x300-eb6025d927bb79672383d18e211a3e3c.png',
            'images/300x300-684fecb043acd036bfb644c73858473a.png',
            'images/300x300-29b2ac18f17d95e95bbfe817710043de.png',
            'images/300x300-66d98a9a71235020d90722bb7e994d4b.png',
            'images/300x300-734c551fdff3e27b74ee24c49e1861e1.png',
            'images/300x300-e59cc7644c2ac0852f00c4eba4f026c5.png',
            'images/300x300-4c5f2b7e5fd31c72b79f1578c93223c2.png',
            'images/300x300-baaa043dcee8c38f6caaae663b26c70f.png',
            'images/300x300-fae72cb7ceae7c7a56309e46cd7f6c68.png',
            'images/300x300-ff2da7102986b3c97c503ef7b2f661c7.png',
            'images/300x300-8cbe24c44326b4f544f6d234e652b639.png',
            'images/300x300-0256e2694ad913cfd0d238e9bc0f2979.png',
            'images/300x300-3980bb35dcffce2040197d5642bc123e.png',
            'images/300x300-cca111934d07a3c35d97ac8fa19f487c.png',
            'images/300x300-7a1dba51f8ca520df203b1d91f0d04f4.png',
            'images/300x300-d4d80c72553ade1da833de43ec037833.png',
            'images/300x300-850ebc006e613d62c2f101a344676e77.png',
            'images/300x300-7fb1df18506718a1f8cace82e9de8256.png',
            'images/300x300-22da996c4b39d509fd116383ca0c44ea.png',
            'images/300x300-d065851cd659121eb638e5868cf35b89.png',
            'images/300x300-fc60cd8c93b46736c93c782c2011a774.png',
            'images/300x300-3b67fb849bac864b57b2f75da71ea718.png',
            'images/300x300-674ec014ea489ac8ec5842e65baf2a17.png',
            'images/300x300-b2d5617fba61151ae12e0358d6cbe993.png',
            'images/300x300-5f416d6c06264e24d9ee379623aca66b.png',
            'images/300x300-fbc3705b5e6b3106549e0e24efe9aefe.png',
            'images/300x300-2eaca555a12f7a38709df9f6f77ba736.png',
            'images/300x300-461bb1226aae10c0850f1dc177db884c.png',
            'images/300x300-f6ab1cc5a3ca1ba614eecf2d1dbcee47.png',
            'images/300x300-effaae8f7fc3b1f43eaba43532f6b557.png',
            'images/300x300-4a0012202caee1ac00f533074076e118.png',
            'images/300x300-8ba0a7469225bdcf4b2b79fe623d30de.png',
            'images/300x300-c6585e995384080ca09cffb3061bb20e.png',
            'images/300x300-2756d58115970b08730d9cb13e5f4d76.png',
            'images/300x300-6df6486612d97e1ca2b2ce2d29d8d707.png',
            'images/300x300-c6535115f9551797e0316e8c6755d7e8.png',
            'images/300x300-666992c77ba5c3391c7d10277e7cb6cc.png',
            'images/300x300-c22b2d53677b1d93df67ebcf595bc070.png',
            'images/300x300-e73426f5b3d6b1bc92ee04c11e4b6b5d.png',
            'images/300x300-a54ff7fb463715d71b07d921ed58b788.png',
            'images/300x300-768ad4dc60a7ef859f62e39a0ad3226a.png',
            'images/300x300-15586bbe65d37697019e832393a53593.png',
            'images/300x300-99cd5b3bd6b44a9cc41c07b3ab73fa65.png'
        ];

        foreach ($images as $lien) {
            $image = new Image();
            $image->setLien($lien);
            $manager->persist($image);
        }

        $manager->flush();
    }
}
