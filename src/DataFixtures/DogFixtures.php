<?php

namespace App\DataFixtures;

use App\Entity\Dog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dogsinfo = [
            [
                'name' => 'Mali',
                'background' => 'Mali est une chienne un peu timide, mais une fois sa confiance gagnée elle se révèle affectueuse et pot de colle',
                'description' => 'Il faudra une famille présente et prête à s\'investir dans son éducation.
                Nous recherchons pour Mali une famille sans autres animaux.
                Ok enfants respectueux.',
                'isLOF' => '1',
                'isTolerant' => '0'
            ],
            [
                'name' => 'Napoleon',
                'background' => 'Napoléon est un chien très touchant qui semble avoir vécu à l\'attache (il a une ancienne cicatrice qui fait tout le tour de son cou).',
                'description' => 'En laisse il reste réactif dès qu\'il voit un chien il aboie beaucoupmais en liberte il est sociable avec eux
                Napoléon est très mignon et se montre câlin avec les gens avec lesquels il est à l\'aise
                Il pourra être sage en intérieur
                Un placement non urbain sera idéal, en pavillon et sans jeunes enfants.
                on evitera un placement avec de nombreux escaliers et du sport',
                'isLOF' => '0',
                'isTolerant' => '0'
            ],
            [
                'name' => 'Boby',
                'background' => 'Boby étant encore un chiot dans sa tête, il est le roi des petites bêtises (jouer avec les couvertures par exemple).',
                'description' => 'Boby est un adorable épagneul, dynamique, très joueur et câlin. Boby adore jouer avec les autres chiens. Un copain chien dans le foyer serait donc le top.
                
                Boby aura besoin d\'une famille patiente, sportive et douce avec lui car il peut être craintif lorsqu\'il ne connait pas.
                
                Boby pourra vivre en maison ou en appartement avec des enfants dans le foyer.',
                'isLOF' => '1',
                'isTolerant' => '1'
            ],
            [
                'name' => 'Ninette',
                'background' => "Ninette est une gentille chienne, mais sur la réserve lorsqu'elle ne connait pas, il faudra donc du temps afin qu'elle soit en confiance, et elle a un souci de confiance envers les hommes dont elle se méfie davantage ...",
                'description' => "Elle se montre protectrice de son environnement.
                C'est une chienne qui aime les balades et les grands espaces, afin qu'elle se sente à l'aise, nous la placerons en maison et non en appartement. Elle aime jouer, et elle est gourmande.
                Elle n'est pas compatible avec les autres animaux.",
                'isLOF' => '1',
                'isTolerant' => '0'
            ],
        ];

        foreach ($dogsinfo as $chien){
        $dog = new Dog();
        $dog->setName($chien['name']);
        $dog->setBackground($chien['background']);
        $dog->setDescription($chien['description']);
        $dog->setIsLOF($chien['isLOF']);
        $dog->setIsTolerant($chien['isTolerant']);

        $manager->persist($dog);
}
        $manager->flush();
    }
}