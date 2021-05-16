<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Pays;

class PaysFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      $nomPays = ["France", "Etats-Unis", "Royaume-Unis", "Espagne"];

      for($i=0; $i<sizeof($nomPays); $i++){
        $pays = new Pays;
        $pays -> setNomPays($nomPays[$i]);

        $manager->persist($pays);
      }

        $manager->flush();
    }
}
