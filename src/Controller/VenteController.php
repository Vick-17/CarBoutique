<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Entity\Reclam;
use App\Entity\MailNews;
use App\Form\ReclamType;
use App\Form\ArticleType;
use App\Form\MailNewsType;
use App\Entity\ArticleVoiture;
use App\Form\SearchAnnonceType;
use App\Repository\MailNewsRepository;
use Symfony\Component\Mime\Email;
use App\Repository\TypeRepository;
use App\Repository\UserRepository;
use App\Repository\MarqueRepository;
use App\Repository\ModeleRepository;
use App\Repository\ReclamRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticleVoitureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class VenteController extends AbstractController
{

    #[Route('/', name: 'app_vente')]
    public function index(ArticleVoitureRepository $articlevoitureRepository, TypeRepository $typeRepo,
                          Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {

        $articlevoitures = $articlevoitureRepository->findBy([], ['id' => 'DESC'], 6);
        $type = $typeRepo->findBy([], ['id' => 'DESC'], 3);


        if (!$articlevoitures ) {
            $articlevoitures = new MailNews();
        }

        $form = $this->createForm(MailNewsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            if ($contact == !null) {
                $this->addFlash('error', 'Mail déjà inscrit');
            }

            $manager->persist($contact);
            $manager->flush();

            $email = (new Email())
                ->from('CarBoutique@gmail.com')
                ->to($contact->getEmailUser())
                ->subject('Time for Symfony Mailer!')
                ->text('Sending emails is fun again!')
                ->html('<p>Merci de votre inscription au newsletter</p>');

            $mailer->send($email);
        }
        return $this->render('vente/index.html.twig', [
            'controller_name' => 'VenteController',
            'articlevoitures' => $articlevoitures,
            'types' => $type,
            'formNews' => $form->createView(),
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route("/vente/fav", name: "ListFav" )]
    public function fav(ArticleVoitureRepository $articleRepo)
    {

        $annonceFav = $articleRepo->getFavById($this->getUser()->getId());

        return $this->render('vente/fav.html.twig', [
            'favoris' => $annonceFav
        ]);
    }


    #[Route('/vente/Apropos', name: 'App_propos')]
    public function Apropos()
    {
        return $this->render('/vente/Apropos.html.twig');
    }

    #[Route('/vente/FAQ', name: 'App_faq')]
    public function faq()
    {

        return $this->render('/vente/FAQ.html.twig');
    }

    #[Route('/vente/reclam', name: 'App_reclam')]
    public function reclam(ReclamRepository $reclamrepo, UserRepository $userepo)
    {

        $reclam = $reclamrepo->findAll();


        return $this->render('/vente/reclam.html.twig', [
            'reclams' => $reclam,
        ]);
    }


    #[Route('/vente/Recents', name: 'App_Recent')]
    public function recents(ArticleVoitureRepository $articlevoitureRepository, MarqueRepository $marqueRepository,
                            ModeleRepository         $modeleRepository, UserRepository $userRepository)
    {
        $annonce = $articlevoitureRepository->findBy([], ['id' => 'DESC'], 6);
        $Marque = $marqueRepository->findBy([], ['id' => 'DESC'], 6);
        $Modele = $modeleRepository->findBy([], ['id' => 'DESC'], 6);
        $User = $userRepository->findBy([], ['id' => 'DESC'], 6);

        return $this->render('/vente/Recents.html.twig', [
            'annonces' => $annonce,
            'marques' => $Marque,
            'modeles' => $Modele,
            'users' => $User,
        ]);
    }

    #[Route('/vente/AnnonceAdmin', name: "App_AnnAdmin")]
    public function AnonceAdmin(ArticleVoitureRepository $articlevoitureRepository)
    {
        $annonce = $articlevoitureRepository->findAll();

        return $this->render('vente/AnnonceAdmin.html.twig', [
            'annonces' => $annonce,
        ]);
    }

    #[Route('/api/Marque/{id}')]
    public function getModelesByMarque(Marque $marque): JsonResponse
    {
        $options = [];
        foreach ($marque->getModeles() as $modele) {
            $options[$modele->getId()] = $modele->getName();
        }

        return $this->json($options);
    }

    #[Route("/vente/liste", name: "liste_Voitures")]
    public function Liste(ArticleVoitureRepository $articlevoitureRepository, Request $request)
    {
        $articlevoitures = $articlevoitureRepository->findBy([], ['id' => 'DESC']);

        $form = $this->createForm(SearchAnnonceType::class);
        $search = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articlevoitures = $articlevoitureRepository->search(
                $search->get('mots')->getData(),
                $search->get('marque')->getData(),
                $search->get('modele')->getData(),
                $search->get('type')->getData(),
                $search->get('transmission')->getData(),
                $search->get('place')->getData(),
                $search->get('energie')->getData(),
            );
        }
        return $this->render('vente/liste.html.twig', [
            'articlevoitures' => $articlevoitures,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/vente/Admin', name: 'App_Admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function admin(): Response
    {
        return $this->render('vente/Admin.html.twig', [
            'controller_name' => 'VenteController',
        ]);
    }

    #[Route('/vente/ListeUser', name: 'App_UserListe')]
    #[IsGranted('ROLE_ADMIN')]
    public function ListeUtilisateur(UserRepository $userepository): Response
    {

        $utilisateurs = $userepository->findBy([], ['id' => 'DESC']);


        return $this->render('vente/ListeUser.html.twig', [
            'controller_name' => 'VenteController',
            'Users' => $utilisateurs,
        ]);
    }

    #[Route('vente/Profil', name: 'App_Profil')]
    public function InfoUtilisateur(UserRepository           $InfoUserepository,
                                    ArticleVoitureRepository $articlevoitureRepository): Response
    {
        $id = $this->getUser()->getId();
        $InfoUser = $InfoUserepository->find($id);
        $myArticles = $articlevoitureRepository->findAllArticleVoitureByID($id);
        return $this->render('vente/Profil.html.twig', [
            'controller_name' => 'VenteController',
            'InfoUsers' => $InfoUser,
            'myArticles' => $myArticles
        ]);
    }

    #[Route('vente/ProfilUser/{id}', name: 'App_ProfilUser')]
    public function InfoUtilisateurUser(UserRepository $InfoUserepository, ArticleVoitureRepository $articlevoitureRepository, $id): Response
    {
        $InfoUser = $InfoUserepository->find($id);
        $myArticles = $articlevoitureRepository->findAllArticleVoitureByID($id);
        return $this->render('vente/ProfilUser.html.twig', [
            'controller_name' => 'VenteController',
            'InfoUsers' => $InfoUser,
            'myArticles' => $myArticles
        ]);
    }

    #[Route("/vente/contact", name: "App_contact")]
    #[IsGranted('ROLE_USER')]
    public function contact(Reclam $reclam = null, Request $request, ReclamRepository $reclamRep,
                            EntityManagerInterface $manager): Response
    {
        if (!$reclam) {
            $reclam = new Reclam();
        }

        $form = $this->createForm(ReclamType::class, $reclam);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            if (!$reclam->getId()) {
                $reclam->setCreatedAt(new \DateTime());
            }

            $reclam->setUser($this->getUser());

            $reclamRep->save($reclam, true);
            $contact = $form->getData();
            $manager->persist($contact);
            $manager->flush();

            return $this->redirectToRoute('app_vente');
        }

        return $this->render('vente/contact.html.twig', [
            'formReclam' => $form->createView()
        ]);
    }

    //formulaire Article

    #[Route("/vente/create", name: "blog_create")]
    #[Route("/vente/{id}/edit", name: "blog_edit")]
    #[IsGranted('ROLE_USER')]
    public function form(ArticleVoiture $articlevoitures = null, Request $request,
                         ArticleVoitureRepository $articleVoitureRepository, EntityManagerInterface $manager, MailerInterface $mailer,
    MailNewsRepository $mailRepo): Response
    {
        if (!$articlevoitures) {
            $articlevoitures = new ArticleVoiture();
        }


        $mailNews = $mailRepo->findMailUser();

        $form = $this->createForm(ArticleType::class, $articlevoitures);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            if (!$articlevoitures->getId()) {
                $articlevoitures->setCreatedAt(new \DateTime());
            }


            $articlevoitures->setUser($this->getUser());

            $articleVoitureRepository->save($articlevoitures, true);
            $contact = $form->getData();
            $manager->persist($contact);
            $manager->flush();

            foreach (
                $mailNews as $value
            ) {
                $email = (new Email())
                    ->from('hello@example.com')
                    ->to($value['EmailUser'])
                    ->subject('Une nouvelle annonces et disponible')
                    ->text('Bonjour, un nouvelle annonces et disponible sur notre site, suis le lien pour la consultée')
                    ->html('<p>Une nouvelle annonce est disponible</p>');

                $mailer->send($email);
            }

            return $this->redirectToRoute('vente_show', ['id' => $articlevoitures->getId()
            ]);
        }

        return $this->render('vente/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $articlevoitures->getId() !== null
        ]);
    }

    #[Route("/vente/Categorie", name: "vente_Categorie")]
    public function goCat(TypeRepository $TypeRepository, ArticleVoitureRepository $articleVoitureRepo): response
    {

        $type = $TypeRepository->findAll();

        return $this->render('vente/Categorie.html.twig', [
            'types' => $type
        ]);
    }

    #[Route("/vente/{id}/ListCat", name: "vente_listCat")]
    public function ListeCat(ArticleVoitureRepository $Articlerepo, $id): Response
    {
        $type = $Articlerepo->findType($id);

        return $this->render('vente/listCat.html.twig', [
            'types' => $type

        ]);
    }



    // #[Route("/vente/payment", name: "vente_payment")]
    // public function payment(Request $request, ArticleVoitureRepository $annonceRepo)
    // {
    //     // Récupération des données du formulaire
    //     $token = $request->request->get('token');
    //     $amount = $annonceRepo->findPrice('');

    //     // Création de l'instance StripeClient
    //     $stripe = new StripeClient(
    //         'sk_test_51MECoHAL2tAEpmdhP2HdYSIstw5AwkH7yLmcCpFU8wp2l8el8ljp7JduXA8KzyI1PuXOgUUukNoWNPVWJQNSDFQc006LLuzMME', // clé secrète Stripe
    //         '2022-12-15' // la date de coupe de connaissances de l'Assistant
    //     );

    //     // Création du paiement
    //     $charge = $stripe->charges->create([
    //         'amount' => $amount,
    //         'currency' => 'eur',
    //         'description' => 'Paiement sur notre site web',
    //         'source' => $token,
    //     ]);

    //     // Traitement du paiement
    //     if ($charge->status === 'succeeded') {
    //         // Paiement réussi, traitement des données...
    //     } else {
    //         // Paiement échoué, affichage d'un message d'erreur...
    //     }

    //     return $this->render('payment/payment.html.twig', [
    //         'charge' => $charge,
    //     ]);
    // }


    #[Route("/vente/{id}", name: "vente_show")]
    public function show(ArticleVoitureRepository $articlevoitureRepository, $id): Response
    {
        $articlevoitures = $articlevoitureRepository->find($id);
        


        return $this->render('vente/cardachat.html.twig', [
            'articlevoitures' => $articlevoitures
        ]);
    }

    #[Route("/vente/Favori/{id}", name: "app_fav")]
    public function favovi (int $id, ArticleVoitureRepository $articleRepo)
    {
        if($this->getUser()){
            $user = $this->getUser();
        }else{
            $user =null;
        }
        $annonces = $articleRepo->findOneBy(['id'=>$id]);
        $annonces->addUser($user);
        $articleRepo->save($annonces, true);


        return $this->redirectToRoute("app_vente",['id' => $annonces->getId()
        ]);
    }

    /*    #[Route('/vente/deleteUser/{id}', methods: ['GET', 'DELETE'], name: 'blog_deleteUser')]
        public function deleteUser(UserRepository $userRepo, $id, EntityManagerInterface $em): Response
        {

            $user = $userRepo->findOneBy(['id' => $id]);
            $userRepo->remove($user, true);
            $em->remove($user);
            $em->flush();

            return $this->redirectToRoute('app_vente');
        }*/


    #[Route('/vente/delete/{id}', methods: ['GET', 'DELETE'], name: 'blog_delete')]
    public function delete(ArticleVoitureRepository $articleVoitureRepository, $id): Response
    {
        $articlevoitures = $articleVoitureRepository->find($id);

        $articleVoitureRepository->remove($articlevoitures, true);

        return $this->redirectToRoute('app_vente');
    }

    #[Route('/vente/deleteReclam/{id}', methods: ['GET', 'DELETE'], name: 'detelete_reclam')]
    public function deleteReclam(reclamRepository $reclamRepo, $id): Response
    {
        $reclam = $reclamRepo->find($id);

        $reclamRepo->remove($reclam, true);

        return $this->redirectToRoute('App_reclam');
    }
}