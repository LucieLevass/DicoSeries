<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Status;

class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      $nomStatus = ["Terminée", "En cours", "Annulée"];

      for($i=0; $i<sizeof($nomStatus); $i++){
        $status = new Status;
        $status -> setNomStatus($nomStatus[$i]);

        $manager->persist($status);
      }

        $manager->flush();
    }
}
