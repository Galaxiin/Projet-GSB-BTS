<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\Famille;
use App\Entity\Composant;
use App\Entity\Constituer;
use App\Entity\Medicament;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');

        // ROLE FIXTURES ----------------------------------------------------------------

        $adminRole = new Role();
        $practicienRole = new Role();

        //Role avec acces total
        $adminRole->setTitre('ROLE_ADMIN');
        //Role avec acces restreint (users interdit)
        $practicienRole->setTitre('ROLE_PRACTICIEN');

        $manager->persist($adminRole);
        $manager->persist($practicienRole);

        // ADMIN FIXTURES ----------------------------------------------------------------

        $adminUser1 = new User();
        $adminUser2 = new User();
        $adminUser3 = new User();

        //Crypter le mdp
        $password=$this->encoder->encodePassword($adminUser1, 'password');

        $adminUser1->setNom('Raizer')
                    ->setPrenom('Antonin')
                    ->setEmail('antonin.raizer@gmail.com')
                    ->setPassword($password)
                    ->addUserRole($adminRole);
        $manager->persist($adminUser1);

        $adminUser2->setNom('Oumar')
                    ->setPrenom('Thierno')
                    ->setEmail('thierno@symfony.com')
                    ->setPassword($password)
                    ->addUserRole($adminRole);
        $manager->persist($adminUser2);

        $adminUser3->setNom('Fadiga')
                    ->setPrenom('Sella')
                    ->setEmail('sella@symfony.com')
                    ->setPassword($password)
                    ->addUserRole($adminRole);
        $manager->persist($adminUser3);
        
        // USER FIXTURES ----------------------------------------------------------------
        
        $users =[];
        for($i = 1; $i <= 10; $i++) {
            $user = new User();

            //Crypter le mdp
            $password = $this->encoder->encodePassword($user, 'password');

            //creation aleatoire des donnees
            $user->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setEmail($faker->email)
                ->setPassword($this->encoder->encodePassword($user, 'password'))
                ->addUserRole($practicienRole);
            
            $manager->persist($user);
            $users[] = $user;
        }

        // COMPOSANT FIXTURES ----------------------------------------------------------

        $composants = [];
        for($i = 1; $i <= 30; $i++) {
            $composant = new Composant();

            $user = $users[mt_rand(0, count($users) - 1)];

            //creation aleatoire des donnees
            $composant->setCMPCode($faker->ean8)
                        ->setCMPLibelle($faker->sentence(5))
                        ->setCMPAuteur($user);

            $manager->persist($composant);
            $composants[]=$composant;
        }

        // FAMILLE FIXTURES ----------------------------------------------------------

        $familles = [];
        for($i = 1; $i <= 10; $i++) {
            $famille = new Famille();

            $user = $users[mt_rand(0, count($users) - 1)];

            //creation aleatoire des donnees
            $famille->setFAMCode($faker->ean8)
                    ->setFAMLibelle($faker->sentence(3))
                    ->setFAMAuteur($user);

            $manager->persist($famille);
            $familles[]=$famille;
        }

        // MEDICAMENT FIXTURES ----------------------------------------------------------------

        $medicaments = [];
        for($i = 1; $i <= 30; $i++) {
            $medicament = new Medicament();

            $user = $users[mt_rand(0, count($users) - 1)];
            $famille = $familles[mt_rand(0, count($familles) - 1)];

            //creation aleatoire des donnees
            $depot="3400";
            $medicament->setMEDDepotLegal($depot.$faker->ean8)
                        ->setMEDNomCommercial($faker->sentence(5))
                        ->setMEDComposition("liste des composants : a developper")
                        ->setMEDEffets($faker->paragraph(2))
                        ->setMEDContreIndic($faker->paragraph(2))
                        ->setMEDPrixEchantillon($faker->randomFloat(2,5,100))
                        ->setMED_Auteur($user)
                        ->setMEDFamille($famille);

            $manager->persist($medicament);
            $medicaments[]=$medicament;
        }

        // CONSTITUTION MEDICAMENT FIXTURES

        for($i = 1; $i <= 100; $i++) {
            $constitution = new Constituer();

            $medicament = $medicaments[mt_rand(0, count($medicaments) - 1)];
            $composant = $composants[mt_rand(0, count($composants) - 1)];

            $constitution->setMEDDepotLegal($medicament)
                        ->setCMPCode($composant)
                        ->setCSTQTE(mt_rand(0,20));

            $manager->persist($constitution);
        }
        $manager->flush();
    }
}
