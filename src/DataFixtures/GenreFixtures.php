<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Genre;

class GenreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      $genres = ["Comédie", "Dramatique", "Policier", "Judiciaire", "Médical", "Politique", "Action-Aventure", "Fantastique--Science-Fiction", "Historique", "Guerre", "Western", "Animation", "Documentaire", "Mini-Série", "Super-Héro"];

      for($i=0; $i<sizeof($genres); $i++){
        $genre = new Genre;
        $genre->setNomGenre($genres[$i]);

        $manager->persist($genre);
      }

        $manager->flush();
    }
}
