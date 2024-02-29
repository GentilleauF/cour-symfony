<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;
use App\Entity\Utilisateur;
use App\Entity\Article;
use Faker;

class AppFixtures extends Fixture
{
    // public function load(ObjectManager $manager): void
    // {   //Ajout de la 1ere catégorie
    //     $categorie = new Categorie();
    //     $categorie->setNom('Sport');
    //     $manager->persist($categorie);

    //     //Ajout de la 2eme catégorie
    //     $categorie2 = new Categorie();
    //     $categorie2->setNom('blog');
    //     $manager->persist($categorie2);

    //     //creation de l'utilsateur
    //     $user = new Utilisateur();
    //     $user->setNom("gentilleau")
    //     ->setPrenom('francois')
    //     ->setEmail('fg66@hotmail.fr')
    //     ->setPassword(md5('azerty'));
    //     $manager->persist($user);


    //     $article = new Article();
    //     $article->setTitre('Article 1')
    //     ->setContenu('blabla')
    //     ->setDateCreation(new \DateTimeImmutable("2024-02-28"))
    //     ->setUtilisateur($user)
    //     ->addCategory($categorie)
    //     ->addCategory($categorie2);
    //     $manager->persist($article);

    //     $manager->flush();
    //     // dd($categorie);
    // }


    // public function load(ObjectManager $manager): void
    // {
    //     $faker = \Faker\Factory::create('fr_FR');
    //     for ($i = 0; $i < 30; $i++) {
    //         $categorie = new Categorie();
    //         $categorie->setNom($faker->word);

    //         $manager->persist($categorie);
    //     }


    //     for ($i = 0; $i < 50; $i++) {
    //         $user = new Utilisateur();
    //         $user->setNom($faker->firstName)
    //             ->setPrenom($faker->lastName)
    //             ->setEmail($faker->email)
    //             ->setPassword(md5('azerty'))
    //             ->setUrlImage($faker->imageUrl(654, 480, 'article', true));
                
    //             $manager->persist($user);
    //     }

    //     for ($i = 0; $i < 20; $i++) {
    //         $article = new Article();
    //         $article->setTitre($faker->word)
    //             ->setContenu($faker->sentence)
    //             ->setDateCreation(new \DateTimeImmutable("2024-02-28"))
    //             ->setUtilisateur($user)
    //             ->addCategory($categorie);
    //         $manager->persist($article);
    //     }




    //     $manager->flush();
    // }


    public function load(ObjectManager $manager): void
    {
        /*-Créer 30 catégories,
        -Créer 50 Utilisateurs,
        -Créer 200 articles,
        */
        $faker = Faker\Factory::create('fr_FR');
        //créer un tableau pour stocker les catégories
        $categories = [];

        //boucle pour créer 30 catégories
        for ($i=0; $i < 30; $i++) { 
            $cat = new Categorie();
            $cat->setNom($faker->jobTitle());
            //ajouter la catégorie au tableau categories
            $categories[] = $cat;
            //persister la catégorie
            $manager->persist($cat);
        }

        $utilisateurs = [];
        //boucle pour créer 50 utilisateurs
        for ($i=0; $i < 50 ; $i++) { 
            $user = new Utilisateur();
            $user
                ->setNom($faker->lastName())
                ->setPrenom($faker->firstName('male'|'female'))
                ->setEmail($faker->freeEmail())
                ->setPassword($faker->md5())
                ->setUrlImage($faker->imageUrl(654, 480, 'users', true));

            $utilisateurs[] = $user;
            $manager->persist($user);
        }

        //boucle pour ajouter 200 article
        for ($i=0 ; $i < 200 ; $i++ ) { 
            $article = new Article();
            $article
                ->setTitre($faker->words(3, true))
                ->setContenu($faker->paragraph(2, false))
                ->setDateCreation(new \DateTimeImmutable($faker->date('Y-m-d')))
                ->setUtilisateur($utilisateurs[$faker->numberBetween(0, 49)])
                ->setImageUrl($faker->imageUrl(654, 480, 'users', true))
                ->addCategory($categories[$faker->numberBetween(0, 9)])
                ->addCategory($categories[$faker->numberBetween(10, 19)])
                ->addCategory($categories[$faker->numberBetween(20, 29)]);
            $manager->persist($article);
        }
        $manager->flush();
    }
}
