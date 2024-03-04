<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;



class ApiUtilisateurController extends AbstractController
{

    private UtilisateurRepository $utilisateurRepository;
    private SerializerInterface $serializer;
    private EntityManagerInterface $manager;

    private UserPasswordHasherInterface $hash;


    public function __construct(
        UtilisateurRepository $utilisateurRepository,
        SerializerInterface $serializer,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $hash
    ) {
        $this->utilisateurRepository = $utilisateurRepository;
        $this->serializer = $serializer;
        $this->manager = $manager;
        $this->hash = $hash;
    }

    #[Route('/api/utilisateur/all', name: 'app_api_utilisateur_all', methods: 'GET')]
    public function getAllUtilisateur(): Response
    {
        return $this->json($this->utilisateurRepository->findAll(), 200, [
            "Access-Control-Allow-Origin" => "*",
        ], ["groups" => "api"]);
    }


    #[Route('api/utilisateur/add', name: 'app_api_utilisateur_add', methods: 'POST')]
    public function addUtilisateur(Request $request): Response
    {

        //1 récupérer le contenu de la requête
        $data = $request->getContent();
        //2 convertir en objet Categorie
        $user = $this->serializer->deserialize($data, Utilisateur::class, "json");
        $user->setPassword($this->hash->hashPassword($user, $user->getPassword()));

        //3 persister la Categorie
        $this->manager->persist($user);

        //Flush (enregister en BDD)
        $this->manager->flush();

        dd($user);
        return $this->json($user, 200, [
            "Access-Control-Allow-Origin" => "*",
        ]);
    }

}
