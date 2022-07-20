<?php

namespace App\DataFixtures;

use App\Entity\Etat;
use App\Entity\Participant;
use App\Entity\Sortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;


use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private ObjectManager $objectManager;
    private UserPasswordHasherInterface $hasher;
    private Generator $generator;


    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $this->addSorties();
        $this->addUsers();
    }
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
        $this-> generator= Factory::create("fr_FR");

    }

    //Un function qui genere de sorties dans la base de données

    public function addSorties()
    {
        $etats = $this->manager->getRepository(Etat::class)->findAll();

        for ($i = 0; $i < 20; $i++) {
            $sortie = new Sortie();
            $sortie->setNom($this->generator->name);
            $sortie->setDateHeureDebut($this->generator->dateTimeBetween('+1 month', '+3 months'));
            $sortie->setDateLimiteInscription($this->generator->dateTimeBetween('now', '+2 months'));
            $sortie->setNbInscriptionMax($this->generator->numberBetween(2, 50));
            $sortie->setDuree($this->generator->numberBetween(2, 50));
            $sortie->setInfosSortie(implode( ' ',  $this->generator->words(3)));

            /**
             * @var Etat $etat
             */

            $etat = $this->generator->randomElement($etats);
            $sortie->setEtat($etat);

            $this->manager->persist($sortie);

        }
        $this->manager->flush();

    }

    // function qui genere des users dans la base de données
    public function addUsers(){
        for ($i = 0; $i < 20; $i++) {
            $user = new Participant();

            $user->setNom($this->generator->lastName);
            $user->setPrenom($this->generator->firstName);
            $user->setTelephone("0123456789");
            $user->setEmail($this->generator->email);

            $password= $this->hasher->hashPassword($user, "123456");
            $user->setPassword($password);

            $this->manager->persist($user);
        }
        $this->manager->flush();
    }





}