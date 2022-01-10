<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = [ 
        [
            "number"=>1,
            "year"=>2007, 
            "description"=>"The Big Bang Theory Season 1",
            "program" => 'program_The Big Bang Theory'
        ],
        [ 
            "number"=>2, 
            "year"=>2008, 
            "description"=>"The Big Bang Theory Season 2",
            "program" => 'program_The Big Bang Theory'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $key => $seasonInfo) {

            $season = new Season();

            $season->setNumber($seasonInfo['number']);
            $season->setDescription($seasonInfo['description']);
            $season->setYear($seasonInfo['year']);
            $season->setProgram($this->getReference($seasonInfo['program']));
            $this->addReference('season_' . $seasonInfo['number'], $season);

            $manager->persist($season);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          ProgramFixtures::class,
        ];
    }
}