<?php

namespace App\Controller;

use App\Entity\Composant;
use App\Form\ComposantType;
use App\Repository\ComposantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ComposantController extends AbstractController
{
    /**
     * Permet d'afficher la liste de tous les compossants
     * 
     * @Route("/composants", name="composants_index")
     * 
     */
    public function index(ComposantRepository $repo)
    {
        $composants = $repo->findAll();

        return $this->render('composant/index.html.twig', [
            'composants' => $composants
        ]);
    }

    /**
     * Permet d'afficher le formulaire de création d'un composant
     * 
     * @Route("/composants/new", name="composants_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager){
        $composant = new Composant();
        
        $form = $this->createForm(ComposantType::class, $composant);

        $form->handleRequest($request);

        //Vérifier si le formulaire est correct
        if($form->isSubmitted() && $form->isValid()){
        
            $composant->setCMPAuteur($this->getUser());
            
            $manager->persist($composant);
            $manager->flush();

            //Message flash de confirmation
            $this->addFlash(
                'success',
                "Le composant <strong>{$composant->getCMPLibelle()}</strong> a bien été enregistrée !"
            );

            //Redirection vers la liste
            return $this->redirectToRoute('composants_index');
        }

        return $this->render('composant/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'édition
     *
     * @Route("/composants/edit/{id}", name="composants_edit")
     * 
     * @return Response
     */
    public function edit(Composant $composant, Request $request, EntityManagerInterface $manager){

        $form = $this->createForm(ComposantType::class, $composant);

        $form->handleRequest($request);

        //Vérifier si le formulaire est correct
        if($form->isSubmitted() && $form->isValid()){
        
            $manager->persist($composant);
            $manager->flush();

            //Message flash de confirmation
            $this->addFlash(
                'success',
                "Les modifications du composant <strong>{$composant->getCMPLibelle()}</strong> ont bien été enregistrées !"
            );

            //Redirection vers la liste
            return $this->redirectToRoute('composants_index');
        }

        return $this->render('composant/edit.html.twig', [
            'form' => $form->createView(),
            'composant' => $composant
        ]);
    }

    /**
     * Permet de supprimer un composant
     *
     * @Route("/composants/delete/{id}", name="composants_delete")
     * 
     * @param Composant $composant
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Composant $composant, EntityManagerInterface $manager) {
        $manager->remove($composant);
        $manager->flush();

        //Message flash de confirmation
        $this->addFlash(
            'success',
            "Le composant <strong>{$composant->getCMPLibelle()}</strong> a bien été supprimée !"
        );

        //Redirection vers la liste
        return $this->redirectToRoute("composants_index");
    }
}