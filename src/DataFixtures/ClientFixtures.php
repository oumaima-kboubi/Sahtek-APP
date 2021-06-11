<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Client;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {

            $client = new Client();
            $client->setName($faker->name);
            $client->setCin($faker->numberBetween(10000000, 99999999));
            $manager->persist($client);
        }
        $manager->flush();
    }
}
