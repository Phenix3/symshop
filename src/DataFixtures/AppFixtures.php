<?php

namespace App\DataFixtures;

use App\Entity\Colissimo;
use App\Entity\Country;
use App\Entity\RangeValue;
use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    protected $countries = [];
    protected $ranges    = [];
    protected $states    = [
        ['name'  => 'Attente chèque', 'slug' => 'cheque', 'color' => 'blue',
            'indice' => 1],
        ['name' => 'Attente mandat administratif', 'slug' => 'mandat', 'color' => 'blue', 'indice' => 1],
        ['name' => 'Attente virement', 'slug' => 'virement', 'color' => 'blue', 'indice' => 1],
        ['name' => 'Attente paiement par carte', 'slug' => 'carte', 'color' =>
            'blue', 'indice' => 1],
        ['name'  => 'Erreur de paiement', 'slug' => 'erreur', 'color' => 'red',
            'indice' => 0],
        ['name' => 'Annulé', 'slug' => 'annule', 'color' => 'red', 'indice' =>
            2],
        ['name' => 'Mandat administratif reçu', 'slug' => 'mandat_ok', 'color' => 'green', 'indice' => 3],
        ['name' => 'Paiement accepté', 'slug' => 'paiement_ok', 'color' =>
            'green', 'indice' => 4],
        ['name'  => 'Expédié', 'slug' => 'expedie', 'color' => 'green',
            'indice' => 5],
        ['name'  => 'Remboursé', 'slug' => 'rembourse', 'color' => 'red',
            'indice' => 6],
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $this->loadCountries($manager, $faker);
        $this->loadRanges($manager, $faker);
        $this->loadClissimos($manager, $faker);
        $this->loadStates($manager, $faker);

        $manager->flush();

        \str_shuffle();
    }

    public function getDependencies()
    {

        return [
            SettingFixtures::class,
            UserFixtures::class,
        ];
    }

    public function loadCountries($manager, $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $country = new Country();
            $country->setName($faker->country)
                ->setTax($faker->randomFloat(2, 10, 100));
            $this->countries[] = $country;
            $manager->persist($country);
        }
    }

    private function loadRanges($manager, $faker)
    {
        for ($i = 0; $i < 6; $i++) {
            $range = new RangeValue();
            $range->setMax($faker->randomFloat(2, 5, 50));
            $this->ranges[] = $range;
            $manager->persist($range);
        }
    }

    private function loadClissimos($manager, $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            $colissimo = new Colissimo();
            $colissimo->setCountry($faker->randomElement($this->countries))
                ->setRange($faker->randomElement($this->ranges))
                ->setPrice($faker->randomFloat(2, 0, 100))
            ;
            $manager->persist($colissimo);
        }
    }

    public function loadStates($manager, $faker)
    {
        foreach ($this->states as $item) {
            $state = new State();
            $state->setName($item['name'])
                ->setSlug($item['slug'])
                ->setIndice($item['indice'])
                ->setColor($item['color'])
            ;
            $manager->persist($state);
        }
    }
}
