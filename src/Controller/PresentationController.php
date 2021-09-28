<?php

namespace App\Controller;

use App\Entity\Presentation;
use App\Form\PresentationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PresentationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// FACULTATIF
class PresentationController extends AbstractController
{
    /**
     * @Route("/presentations", name="presentations_index")
     */
    public function index(PresentationRepository $repo)
    {
        $presentations = $repo->findAll();

        return $this->render('presentation/index.html.twig', [
            'presentations' => $presentations
        ]);
    }
    
    /**
     * Permet de créer un presentation
     * 
     * @Route("/presentations/new", name="presentations_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager){
        $presentation = new Presentation();
        
        $form = $this->createForm(PresentationType::class, $presentation);

        $form->handleRequest($request);

        return $this->render('presentation/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * Permet d'afficher le formulaire d'édition
     *
     * @Route("/presentations/{slug}/edit", name="presentations_edit")
     * 
     * 
     * 
     * @return Response
     */
    public function edit(Presentation $presentation, Request $request, EntityManagerInterface $manager){

        $form = $this->createForm(PresentationType::class, $presentation);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
        
            $manager->persist($presentation);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications du presentation <strong>{$presentation->getPRELibelle()}</strong> ont bien été enregistrées !"
            );

            return $this->redirectToRoute('presentations_show', [
                'slug' => $presentation
            ]);
        }

        return $this->render('presentation/edit.html.twig', [
            'form' => $form->createView(),
            'presentation' => $presentation
        ]);
    }

    /**
     * Permet d'afficher un seul presentation
     *
     * @Route("/presentations/{slug}", name="presentations_show")
     *
     * @return Response
     */
    public function show($slug, Presentation $presentation)
    {
        return $this->render('presentation/show.html.twig',[
            'presentation' => $presentation
        ]);
    }

    /**
     * Permet de supprimer un presentation
     *
     * @Route("/presentations/{slug}/delete", name="presentations_delete")
     * 
     * 
     * @param Presentation $presentation
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Presentation $presentation, EntityManagerInterface $manager) {
        $manager->remove($presentation);
        $manager->flush();

    $this->addFlash(
        'success',
        "La presentation <strong>{$presentation->getPRELibelle()}</strong> a bien été supprimée !"
    );

        return $this->redirectToRoute("presentations_index");
    }
}
