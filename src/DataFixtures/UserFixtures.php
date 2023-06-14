<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Adopter;
use App\Entity\Breeder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    protected UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        // create table that compose users details
        $usersAdopter = [
            [
                'password' => '1020',
                'email' => 'roanna@spa.com',
                'firstName' => 'tata',
                'lastName' => 'toto',
                'city' => 'Lyon',
                'department' => 'Rhone',
                'phone' => '0660000001',
            ],

            [
                'password' => '2020',
                'email' => 'roaa@spa.com',
                'firstName' => 'David',
                'lastName' => 'C',
                'city' => 'Lyon',
                'department' => 'Rhone',
                'phone' => '0660000001',
            ],

            [
                'password' => '3020',
                'email' => 'peter@spa.com',
                'firstName' => 'Peter',
                'lastName' => 'k',
                'city' => 'Lyon',
                'department' => 'Rhone',
                'phone' => '0660000001',
            ],

            [
                'password' => '4020',
                'email' => 'thi@spa.com',
                'firstName' => 'Thi-Hui',
                'lastName' => 'H',
                'city' => 'Lyon',
                'department' => 'Rhone',
                'phone' => '0660000001',
            ],
            [
                'password' => '5020',
                'email' => 'sami@spa.com',
                'firstName' => 'Sami',
                'lastName' => 'A',
                'city' => 'Lyon',
                'department' => 'Rhone',
                'phone' => '0660000001',
            ],
        ];

        foreach ($usersAdopter as $adopter) {
            // create objects
            $user = new Adopter();
            $user->setEmail($adopter['email']);
            $password = $this->hasher->hashPassword($user, $adopter['password']);
            $user->setPassword($password);

            $user->setFirstName($adopter['firstName']);
            $user->setLastName($adopter['lastName']);
            $user->setCity($adopter['city']);
            $user->setDepartment($adopter['department']);
            $user->setPhone($adopter['phone']);

            $manager->persist($user);
        }

        $userBreeder = [
            'SPA de Lyon' => [
                'pass' => '2020',
                'email' => 'lyon@spa.com',
            ],
            'SPA de Annecy' => [
                'pass' => '1010',
                'email' => 'annecy@spa.com',
            ],
            'SPA de Roanna' => [
                'pass' => '3030',
                'email' => 'rotary@spa.com',
            ],
            'SPA de Paris' => [
                'pass' => '4040',
                'email' => 'paris@spa.com',
            ],
            'SPA de Meme' => [
                'pass' => '5050',
                'email' => 'meme@spa.com',
            ],
        ];

        foreach ($userBreeder as $name => $infos) {
            // create objects
            $user = new Breeder();
            $user->setName($name);
            $user->setEmail($infos['email']);

            $password = $this->hasher->hashPassword($user, $infos['pass']);

            $user->setPassword($password);

            $manager->persist($user);
        }

        // create objects
        $user = new Admin();
        $user->setEmail('admin@yahoo.com');

        $password = $this->hasher->hashPassword($user, '0000');

        $user->setPassword($password);

        $manager->persist($user);

        // save all to database
        $manager->flush();
    }
}
