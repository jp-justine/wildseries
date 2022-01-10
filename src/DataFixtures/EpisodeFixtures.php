<?php

namespace App\DataFixtures;

use App\entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        [
            "title"=>"La Nouvelle Voisine des surdoués", 
            "number"=>1, 
            "synopsis"=>"Sheldon et Leonard, deux chercheurs en physique, font la rencontre de leur nouvelle voisine, Penny. Elle va rapidement bousculer leur quotidien.",
            "season" => 'season_1'
        ],
        [
            "title"=>"Des voisins encombrants", 
            "number"=>2, 
            "synopsis"=>"Leonard cherche à séduire Penny et recourt à l'aide de Sheldon. Mais rapidement, cela va tourner au désastre ...",
            "season" => 'season_1'
        ],
        [
            "title"=>"Le corollaire de patte-de-velours", 
            "number"=>3, 
            "synopsis"=>"Leonard déprime lorsqu'il découvre que Penny a un rencard. Sous les conseils de ses amis, il cherche à séduire une autre femme ...",
            "season" => 'season_1'
        ],
        [
            "title"=>"Les poissons luminescents", 
            "number"=>4, 
            "synopsis"=>"Sheldon se fait licencier et doit chercher à se reconvertir. Lorsque la situation devient critique, Léonard doit alors faire appel à sa mère ...",
            "season" => 'season_1'
        ],
        [
            "title"=>"Le postulat du hamburger", 
            "number"=>5, 
            "synopsis"=>"Leonard perd espoir avec Penny et décide de conclure avec Penny. Pendant ce temps là, le quotidien de Sheldon est chamboulé lorsqu'il doit changer son choix de hamburger.",
            "season" => "season_1"
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $key => $episodeInfo) {

            $episode = new episode();

            $episode->setTitle($episodeInfo["title"]);
            $episode->setNumber($episodeInfo["number"]);
            $episode->setSynopsis($episodeInfo["synopsis"]);
            $episode->setSeason($this->getReference($episodeInfo["season"]));

            $manager->persist($episode);
            
            $this->addReference("episode_" . $key, $episode);
      
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }
}