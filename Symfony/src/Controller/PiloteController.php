<?php
// src/Controller/TestTableController.php
namespace App\Controller;


use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

// importation des entités
use App\Entity\Pilote;
use App\Entity\User;

class PiloteController extends AbstractController
{

    /**
     * @Route("/salut-pote", name="salut_mon_pote")
     */
    public function avis()
    {
        $prenomPote = "Marcel";
        return $this->render('salut.html.twig', ['prenom' => $prenomPote]);
    }

    /**
     * @Route("/gestion-pilotes", name="gestion_pilotes")
     */
    public function index(ManagerRegistry $doctrine)
    {
        // récupération du repository relatif à l'entité (classe) Pilote
        $repository = $doctrine->getRepository(Pilote::class);
        // recherche de tous les pilotes
        $listePilotes = $repository->findAll();
        // affichage de la liste des pilotes
        return $this->render('pilote/listePilotes.html.twig', ['pilotes' => $listePilotes]);
    }

    /**
     * @Route("/insert-table")
     */
    public function insert(ManagerRegistry $doctrine)
    {
        // récupération de l'Entity Manager
        $em = $doctrine->getManager();
        // instanciation de l'entité et injection des données
        $monPilote = new Pilote();
        $monPilote->setId(4);
        $monPilote->setNom("Yuki ");
        $monPilote->setPrenom("Tsunoda");
        $monPilote->setPoints(17);
        $monPilote->setEcurie("AlphaTauri");

        // notification de la modification de l'entité
        $em->persist($monPilote);
        // demande de modification de la base de données
        $em->flush();

        return new Response("Insertion réussie !");
    }

    /**
     * @Route("/print-table")
     */
    public function print(ManagerRegistry $doctrine)
    {

        // récupération du repository relatif à l'entité (classe) Pilote
        $repository = $doctrine->getRepository(Pilote::class);
        // recherche de tous les employés
        $listePilotes = $repository->findAll();
        // message complet à retourner
        $message = "";
        // parcours de tous les pilotes
        foreach ($listePilotes as $monPilote) {
            $message .= "Id : " . $monPilote->getId() . "<br />";
            $message .= "Nom : " . $monPilote->getNom() . "<br />";
            $message .= "Prenom : " . $monPilote->getPrenom() . "<br />";
            $message .= "Points : " . $monPilote->getPoints() . "<br />";
            $message .= "Ecurie : " . $monPilote->getEcurie() . "<br /><br />";
        }
        return new Response($message);
    }

    /**
     * @Route("/ajout-pilote", name="ajout_pilote")
     */
    public function ajout(ManagerRegistry $doctrine, Request $request)
    {
        // instanciation de l'entité Pilote
        $pilote = new Pilote();


        // création du constructeur de formulaire en fournissant l'entité
        $formBuilder = $this->createFormBuilder($pilote);

        /* ajout successif des propriétés souhaitées de l'entité
         pour les champs de formulaire avec leur type */
        $formBuilder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('points', TextType::class)
            ->add('ecurie', TextType::class)
            ->add('validation', SubmitType::class,
                ['label' => 'Valider la saisie'])
            ->add('effacement', ResetType::class,
                ['label' => 'Effacer la saisie']);

        // récupération du formulaire à partir du constructeur de formulaire
        $form = $formBuilder->getForm();

        /* traitement de la requête : Symfony récupère éventuellement les valeurs des
         champs de formulaire et alimente l'objet $pilote */
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        // le formulaire a été soumis et il est valide
        {
            // écriture dans la base de données
            $em = $doctrine->getManager();
            $em->persist($pilote);
            $em->flush();

            // récupération du repository relatif à l'entité (classe) pilote
            $repository = $doctrine->getRepository(Pilote::class);
            // recherche de tous les employés
            $listePilotes = $repository->findAll();
            // affichage de la liste des employés
            return $this->render('pilote/listePilotes.html.twig',
                ['pilotes' => $listePilotes]);
        }
        // passage du formulaire au template pour affichage avec l'opération réalisée
        return $this->render('pilote/formPilote.html.twig',
            ['form' => $form->createView(),
                'operation' => 'Ajout']);

    }

    /**
     * @Route("/modif-pilote/{codeEmpAction}", name="modif_pilote")
     */
    public function modif(ManagerRegistry $doctrine, $codeEmpAction, Request $request)
    {

        // récupération du repository relatif à l'entité (classe) pilote
        $repository = $doctrine->getRepository(Pilote::class);
        // recherche de l'employé
        $pilote = $repository->find($codeEmpAction);

        // création du constructeur de formulaire en fournissant l'entité
        $formBuilder = $this->createFormBuilder($pilote);

        /* ajout successif des propriétés souhaitées de l'entité
        pour les champs de formulaire avec leur type */
        $formBuilder->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('points', TextType::class)
            ->add('ecurie', TextType::class)
            ->add('validation', SubmitType::class,
                ['label' => 'Valider les modifications']);

        // récupération du formulaire à partir du constructeur de formulaire
        $form = $formBuilder->getForm();
        /* traitement de la requête : Symfony récupère éventuellement les valeurs des
        champs de formulaire et alimente l'objet $pilote */
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        // le formulaire a été soumis et il est valide
        {
            // réécriture dans la base de données
            $em = $doctrine->getManager();
            $em->persist($pilote);
            $em->flush();
            // récupération du repository relatif à l'entité (classe) pilote
            $repository = $doctrine->getRepository(pilote::class);
            // recherche de tous les employés
            $listePilotes = $repository->findAll();
            // affichage de la liste des employés
            return $this->render('pilote/listePilotes.html.twig',
                ['pilotes' => $listePilotes]);
        }

        // passage du formulaire au template pour affichage avec l'opération réalisée
        return $this->render('pilote/formPilote.html.twig',
            ['form' => $form->createView(),
                'operation' => 'Modif']);

    }

    /**
     * @Route("/suppr-pilote/{codeEmpAction}", name="suppr_pilote")
     */
    public function suppr(ManagerRegistry $doctrine,
        $codeEmpAction, Request $request)
    {
        // récupération du repository relatif à l'entité (classe) Pilote
        $repository = $doctrine->getRepository(Pilote::class);
        // recherche du pilote
        $pilote = $repository->find($codeEmpAction);


        // création du constructeur de formulaire en fournissant l'entité
        $formBuilder = $this->createFormBuilder($pilote);

        /* ajout successif des propriétés souhaitées de l'entité
        pour les champs de formulaire avec leur type */
        $formBuilder
            ->add('nom', TextType::class,
                ['disabled' => true])
            ->add('prenom', TextType::class,
                ['disabled' => true])
            ->add('points', TextType::class,
                ['disabled' => true])
            ->add('ecurie', TextType::class,
                ['disabled' => true])
            ->add('suppression', SubmitType::class,
                ['label' => 'Supprimer ce pilote']);

        // récupération du formulaire à partir du constructeur de formulaire
        $form = $formBuilder->getForm();

        /* traitement de la requête : Symfony récupère éventuellement les valeurs des
        champs de formulaire et alimente l'objet $pilote */
        $form->handleRequest($request);

        if ($form->isSubmitted())
        // le formulaire a été soumis
        {
            // suppression dans la base de données
            $em = $doctrine->getManager();
            $em->remove($pilote);
            $em->flush();
            // récupération du repository relatif à l'entité (classe) Pilote
            $repository = $doctrine->getRepository(Pilote::class);
            // recherche de tous les employés
            $listePilotes = $repository->findAll();
            // affichage de la liste des employés
            return $this->render('pilote/listePiloteS.html.twig',
                ['pilotes' => $listePilotes]);
        }

        // passage du formulaire au template pour affichage avec l'opération réalisée
        return $this->render
        ('pilote/formPilote.html.twig',
            ['form' => $form->createView(),
                'operation' => 'Suppr']);
    }

    /**
     * @Route("/rempl-utilis")
     */
    public function remplissageUtilisateurs
    (ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher)
    {
        // récupération de l'Entity Manager
        $em = $doctrine->getManager();
        // création de l'utilisateur 1
        $user = new User();
        $user->setUsername("MSchumacher");
        $user->setNomComplet("Schumacher");
        $user->setPrenomComplet("Michael");
        $user->setType("S");
        // hachage du mot de passe en clair
        $hashedPassword =
            $passwordHasher->hashPassword($user, "Picsou1");
        $user->setPassword($hashedPassword);
        $em->persist($user);

        // création de l'utilisateur 2
        $user = new User();
        $user->setUsername("AProst");
        $user->setNomComplet("Prost");
        $user->setPrenomComplet("Alain");
        $user->setType("C");
        // hachage du mot de passe en clair
        $hashedPassword =
            $passwordHasher->hashPassword($user, "Donald2");
        $user->setPassword($hashedPassword);
        $em->persist($user);

        // création de l'utilisateur 3
        $user = new User();
        $user->setUsername("ASenna");
        $user->setNomComplet("Senna");
        $user->setPrenomComplet("Ayrton");
        $user->setType("S");
        // hachage du mot de passe en clair
        $hashedPassword =
            $passwordHasher->hashPassword($user, "Mickey3");

        $user->setPassword($hashedPassword);
        $em->persist($user);

        $em->flush();

        return new Response("3 utilisateurs insérés");
    }
}


//PAGE 132
?>