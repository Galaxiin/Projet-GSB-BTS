<?php

namespace App\Controller;

use App\Entity\Dosage;
use App\Form\DosageType;
use App\Repository\DosageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// FACULTATIF
class DosageController extends AbstractController
{
    /**
     * @Route("/dosages", name="dosages_index")
     */
    public function index(DosageRepository $repo)
    {
        $dosages = $repo->findAll();

        return $this->render('dosage/index.html.twig', [
            'dosages' => $dosages
        ]);
    }
    
    /**
     * Permet de créer un dosage
     * 
     * @Route("/dosages/new", name="dosages_create")
     * 
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager){
        $dosage = new Dosage();
        
        $form = $this->createForm(DosageType::class, $dosage);

        $form->handleRequest($request);

        return $this->render('dosage/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'édition
     *
     * @Route("/dosages/{slug}/edit", name="dosages_edit")
     * 
     * 
     * 
     * @return Response
     */
    public function edit(Dosage $dosage, Request $request, EntityManagerInterface $manager){

        $form = $this->createForm(DosageType::class, $dosage);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
        
            $manager->persist($dosage);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications du dosage <strong>{$dosage->getDOSCode()}</strong> ont bien été enregistrées !"
            );

            return $this->redirectToRoute('dosages_show', [
                'slug' => $dosage
            ]);
        }

        return $this->render('dosage/edit.html.twig', [
            'form' => $form->createView(),
            'dosage' => $dosage
        ]);
    }

    /**
     * Permet d'afficher un seul dosage
     *
     * @Route("/dosages/{slug}", name="dosages_show")
     *
     * @return Response
     */
    public function show($slug, Dosage $dosage)
    {
        return $this->render('dosage/show.html.twig',[
            'dosage' => $dosage
        ]);
    }

    /**
     * Permet de supprimer un dosage
     *
     * @Route("/dosages/{slug}/delete", name="dosages_delete")
     * 
     * 
     * @param Dosage $dosage
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Dosage $dosage, EntityManagerInterface $manager) {
        $manager->remove($dosage);
        $manager->flush();

    $this->addFlash(
        'success',
        "Le dosage <strong>{$dosage->getDOSCode()}</strong> a bien été supprimée !"
    );

        return $this->redirectToRoute("dosages_index");
    }
}
