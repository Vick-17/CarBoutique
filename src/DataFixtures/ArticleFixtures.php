<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;

use App\Entity\ArticleVoiture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticleFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        // initialisation de l'objet Faker
        // on peut préciser en paramètre la localisation, 
        // pour avoir des données qui semblent "françaises"
        $faker = Factory::create('fr_FR');

		for($nbUsers = 1; $nbUsers < 100; $nbUsers++) {
			$user = new User();
			$user->setEmail($faker->email);
			if($nbUsers == 1)
			$user->setRoles(['ROLE_ADMIN']);
			else
				$user->setRoles(['ROLE_USER']);
			$user->setPassword('azertyui');
			$user->setName($faker->firstName);
			$user->setLastname($faker->lastname());
			$user->setIsVerified($faker->numberBetween(0, 1));
			$user->setPhoto($faker->imageUrl());
			$user->setPhoneNumber($faker->serviceNumber());
			$user->setAdresse($faker->region());
			$manager->persist($user);
		}
		
		$manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}