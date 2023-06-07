<?php

namespace App\DataFixtures;

use App\Entity\Race;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RaceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $races = [
        "Affenpinscher",
        "Airedale Terrier",
        "Akita Américain",
        "Akita Inu",
        "American Staffordshire Terrier",
        "Ancien chien d'arrêt danois",
        "Anglo-Français de Petite Vènerie",
        "Ariégeois",
        "Barbet",
        "Barbu Tchèque",
        "Barzoï",
        "Basenji",
        "Basset Artésien-Normand",
        "Basset Bleu de Gascogne",
        "Basset de Westphalie",
        "Basset des Alpes",
        "Basset Fauve de Bretagne",
        "Basset Hound",
        "Beagle",
        "Beagle-Harrier",
        "Bearded Collie",
        "Beauceron",
        "Bedlington Terrier",
        "Berger Allemand",
        "Berger Américain Miniature",
        "Berger Australien",
        "Berger Belge Groenendael",
        "Berger Belge Laekenois",
        "Berger Belge Malinois",
        "Berger Belge Tervueren",
        "Berger Blanc Suisse",
        "Berger Catalan",
        "Berger d'Anatolie",
        "Berger d'Asie Centrale",
        "Berger de Bergame",
        "Berger de Bohême",
        "Berger de Brie",
        "Berger de l'Atlas",
        "Berger de Maremme et des Abruzzes",
        "Berger de Picardie",
        "Berger de Russie",
        "Berger de Savoie",
        "Berger des Pyrénées",
        "Berger des Shetland",
        "Berger du Caucase",
        "Berger du massif du Karst",
        "Berger finnois de Laponie",
        "Berger Hollandais",
        "Berger Islandais",
        "Berger Polonais de Plaine",
        "Berger Polonais de Podhale",
        "Berger Portugais",
        "Berger Yougoslave",
        "Bichon à poil frisé",
        ];

        foreach ($races as $race){
          $r = new Race();
          $r->setName($race);

          $manager->persist($r);
        }

        $manager->flush();
    }
}