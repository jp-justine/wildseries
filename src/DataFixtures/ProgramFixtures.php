<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        [
            "title"=>"The Big Bang Theory",
            "Synopsis"=>"Leonard Hofstadter et Sheldon Cooper vivent en colocation à Pasadena. Ce sont tous deux des physiciens surdoués, « geeks » de surcroît. C'est d'ailleurs autour de cela qu'est axée la majeure partie comique de la série. Ils partagent quasiment tout leur temps libre avec leurs deux amis Howard Wolowitz et Rajesh Koothrappali pour jouer à des jeux vidéo comme Halo, organiser un marathon de la saga Star Wars, jouer à des jeux de société comme le Boggle klingon ou de rôles tel que Donjons et Dragons, voire discuter de théories scientifiques très complexes.Leur univers routinier est perturbé lorsqu'une jeune femme, Penny, s'installe dans l'appartement d'en face. Leonard a immédiatement des vues sur elle et va tout faire pour la séduire ainsi que l'intégrer au groupe et à son univers, auquel elle ne connaît rien.",
            "poster"=>"https://m.media-amazon.com/images/I/81ksNXITStL._AC_SX466_.jpg",
            "category" => 'category_Humour'
        ],
        
        [
            "title"=>"The Witcher",
            "Synopsis"=>"Le sorceleur Geralt, un chasseur de monstres mutant, se bat pour trouver sa place dans un monde où les humains se révèlent souvent plus vicieux que les bêtes.",
            "poster"=>"https://fr.web.img6.acsta.net/r_1920_1080/pictures/19/12/12/12/13/2421997.jpg",
            "category" => "category_Fantastique"
        ],
        
        [
            "title"=>"Hawkeye",
            "Synopsis"=>"L’ancien Avenger Clint Barton a une mission apparemment simple : retourner dans sa famille pour Noël. Possible ? Peut-être avec l’aide de Kate Bishop, une archère de 22 ans qui rêve de devenir une super-héroïne. Ils vont devoir faire équipe alors qu’une présence du passé de Barton menace de faire dérailler l’esprit festif.",
            "poster"=>"https://fr.web.img2.acsta.net/r_1920_1080/pictures/21/12/21/17/32/4932150.jpg",
            "category" => "category_Aventure"
        ],
        
        [
            "title"=>"Le lire de Boba Fett",
            "Synopsis"=>"Spin-off de The Mandalorian centré sur les aventures du légendaire chasseur de primes Boba Fett et de la mercenaire Fennec Shand. Après s’être hasardés dans les bas-fonds de la galaxie, tous deux reviennent au milieu des dunes de Tatooine pour y revendiquer le territoire autrefois dirigé par Jabba le Hutt et son syndicat du crime...",
            "poster"=>"https://fr.web.img5.acsta.net/r_1920_1080/pictures/21/11/01/19/55/0179288.jpg",
            "category" => "category_Fantastique"
        ],
        
        [
            "title"=>"Kimetsu no Yaiba",
            "Synopsis"=>"Depuis les temps anciens, il existe des rumeurs concernant des démons mangeurs d'hommes qui se cachent dans les bois. Pour cette raison, les citadins locaux ne s'y aventurent jamais la nuit. La légende raconte aussi qu'un tueur déambule la nuit, chassant ces démons assoiffés de sang. Depuis la mort de son père, Tanjiro a pris sur lui pour subvenir aux besoins de sa famille. Malgré cette tragédie, ils réussissent à trouver un peu de bonheur au quotidien. Cependant, ce peu de bonheur se retrouve détruit le jour où Tanjiro découvre que sa famille s'est fait massacrer et que la seule survivante, sa sœur Nezuko, est devenue un démon. À sa grande surprise, Nezuko montre encore des signes d'émotion et de pensées humaines. Ainsi, commence la dure tâche de Tanjiro, celle de combattre les démons et de faire redevenir sa sœur humaine.",
            "poster"=>"https://fr.web.img6.acsta.net/r_1920_1080/pictures/19/09/18/13/46/0198270.jpg",
            "category" => "category_Animation"
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programInfo) {

            $program = new Program();

            $program->setTitle($programInfo['title']);
            $program->setSynopsis($programInfo['Synopsis']);
            $program->setPoster($programInfo['poster']);
            $program->setCategory($this->getReference($programInfo['category'])); 
            $this->addReference('program_' . $programInfo['title'], $program); 
                      
            for ($i=0; $i < count(ActorFixtures::ACTORS); $i++) 
            {
                $program->addActor($this->getReference('actor_' . $i));
            }
            $manager->persist($program);
            
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ActorFixtures::class,
          CategoryFixtures::class,
        ];
    }


}

