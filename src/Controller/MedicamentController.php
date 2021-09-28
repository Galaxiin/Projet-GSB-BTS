<?php

namespace App\Controller;

use App\Entity\Medicament;
use App\Form\MedicamentType;
use App\Repository\MedicamentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MedicamentController extends AbstractController
{
    /**
     * Permet d'afficher la liste des médicaments
     * 
     * @Route("/medicaments", name="medicaments_index")
     */
    public function index(MedicamentRepository $repo)
    {
        $medicaments = $repo->findAll();

        return $this->render('medicament/index.html.twig', [
            'medicaments' => $medicaments
        ]);
    }

    /**
     * Permet d'afficher le formulaire de création d'un médicament
     * 
     * @Route("/medicaments/new", name="medicaments_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager){
        $medicament = new Medicament();
        
        $form = $this->createForm(MedicamentType::class, $medicament);

        $form->handleRequest($request);

        //Vérifier si le formulaire est correct
        if($form->isSubmitted() && $form->isValid()){
            //Ajout de l'auteur (user) du médicament
            $medicament->setMED_Auteur($this->getUser());
            
            $manager->persist($medicament);
            $manager->flush();

            //Message flash de confirmation
            $this->addFlash(
                'success',
                "Le medicament <strong>{$medicament->getMEDNomCommercial()}</strong> a bien été enregistrée !"
            );

            //Redirection vers la liste
            return $this->redirectToRoute('medicaments_index');
        }

        return $this->render('medicament/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'edition d'un medicament
     * 
     * @Route("/medicaments/edit/{id}", name="medicaments_edit")
     *
     * @return Response
     */
    public function edit(Medicament $medicament, Request $request, EntityManagerInterface $manager){

        $form = $this->createForm(MedicamentType::class, $medicament);

        $form->handleRequest($request);

        //Verifier si le formulaire est correct
        if($form->isSubmitted() && $form->isValid()){
        
            $manager->persist($medicament);
            $manager->flush();

            //Message flash de confirmation
            $this->addFlash(
                'success',
                "Les modifications du médicament <strong>{$medicament->getMEDNomCommercial()}</strong> ont bien été enregistrées !"
            );

            //Redirection vers la liste
            return $this->redirectToRoute('medicament_index');
        }

        return $this->render('medicament/edit.html.twig', [
            'form' => $form->createView(),
            'medicament' => $medicament
        ]);
    }

    /**
     * Permet de supprimer un medicament
     *
     * @Route("/medicaments/{id}/delete", name="medicaments_delete")
     * 
     * 
     * @param Medicament $medicament
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Medicament $medicament, EntityManagerInterface $manager) {
        $manager->remove($medicament);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le médicament <strong>{$medicament->getMEDNomCommercial()}</strong> a bien été supprimée !"
        );

        //Redirection vers la liste
        return $this->redirectToRoute("medicaments_index");
    }

}