<?php

namespace App\Controller;


use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TP5Controller extends AbstractController
{
    /**
     * @Route("/tp5", name="tp5")
     */
    public function index(): Response
    {
        $tab[0] = "Les Etats-Unis vont exiger des tests, le port du masque et un traçage pour les voyageurs en provenance de l’étranger a ajouté la Maison-Blanche, lors de l’annonce de la fin du « Travel Ban », entré en vigueur il y a un an et demi.";
        $tab[1] = "Covid-19 : après 20 mois de restrictions, les Etats-Unis laisseront entrer 'début novembre' tous les voyageurs internationaux entièrement vaccinés";
        $tab[2] = "Après dix-huit mois d'interdiction, la Maison-Blanche a annoncé ce lundi qu'elle autorise à partir de début novembre l'entrée aux Etats-Unis des voyageurs vaccinés en provenance de l'Union européenne et du Royaume-Uni.";
        $tab[3] = "Le président de la République a fait cette annonce, lundi, dans le cadre d’une réception consacrée à la mémoire des harkis ayant combattu aux côtés de l’armée française durant la guerre d’Algérie.";
        
        $activeHome = 'active';

        return $this->render('tp5/index.html.twig', [
            'news' => $tab,
            'activeHome' => $activeHome,
        ]);
    }

    /**
     * @Route("/tp5/contact", name="tp5-contact")
     */
    public function contact(): Response
    {
        $activeContact = "active";

        return $this->render('tp5/contact.html.twig', [
            'activeContact' => $activeContact,
        ]);
    }

    /**
     * @Route("/tp5/about", name="tp5-about")
     */
    public function about(): Response
    {
        $activeAbout = "active";

        return $this->render('tp5/about.html.twig', [
            'activeAbout' => $activeAbout,
        ]);
    }



    //Route Gestion Wish
    /**
     * @Route("/tp5/wish", name="tp5-wish")
     */
    public function wish(WishRepository $repo): Response
    {
        $tab = $repo->findAll();

        return $this->render('tp5/wish.html.twig', [
            'tab' => $tab,
        ]);
    }

    /**
     * @Route("/tp5/detail/{id}", name="tp5-detail")
     */
    public function detail(Wish $wish): Response
    {
        return $this->render('tp5/detail.html.twig', [
            'wish' => $wish,
        ]);
    }

    /**
     * @Route("/tp5/delete/{id}", name="tp5-delete")
     */
    public function delete(Wish $wish, EntityManagerInterface $em): Response
    {
        // $em = $this->getDoctrine()->getManager();
        $em->remove($wish);
        $em->flush();
        return $this->redirectToRoute('tp5-wish');
    }

    /**
     * @Route("/tp5/addWish", name="tp5-add")
     */
    public function ajouter(Request $request): Response
    {
        $wish = new Wish();
        // associe obj personne au Form.
        $formWish = $this->createForm(WishType::class,$wish);
        // hydraté $personne en fct du formulaire
        $formWish->handleRequest($request);

        // si le form est validé.
        if ($formWish->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($wish);
            $em->flush();
            // je redirige
            return $this->redirectToRoute('tp5-wish');
        }

        return $this->render('tp5/ajouter.html.twig',
            ['formWish'=> $formWish->createView()]);
    }
}
