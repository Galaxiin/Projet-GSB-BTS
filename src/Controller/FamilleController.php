<?php

namespace App\Controller;


use App\Entity\Famille;
use App\Form\FamilleType;
use App\Repository\FamilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FamilleController extends AbstractController
{
    /**
     * Permet d'afficher la liste des familles
     * 
     * @Route("/familles", name="familles_index")
     */
    public function index(FamilleRepository $repo)
    {
        $repo = $this->getDoctrine()->getRepository(Famille::class);
        $familles = $repo->findAll();

        return $this->render('famille/liste.html.twig', [
            'familles' => $familles
        ]);
    }

    /**
     * Permet d'afficher le formulaire de création d'une famille
     * 
     * @Route("/familles/new", name="familles_create")
     * 
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager){
        $famille = new Famille();
        
        $form = $this->createForm(FamilleType::class, $famille);

        $form->handleRequest($request);

        //Vérifier si le formulaire est correct
        if ($form->isSubmitted() && $form->isValid()) {
            
            $famille->setFAMAuteur($this->getUser());

            $manager->persist($famille);
            $manager->flush();

            //Message flash de confirmation
            $this->addFlash(
                'success',
                "La famille {$famille->getFAMLibelle()} a bien été créée"
            );
            
            //Redirection vers la liste
            return $this->redirectToRoute('familles_index');          
        }

        return $this->render('famille/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'édition
     *
     * @Route("/familles/{FAM_Libelle}/edit", name="familles_edit")
     * 
     * 
     * @return Response
     */
    public function edit(Famille $famille, Request $request, EntityManagerInterface $manager){

        $form = $this->createForm(FamilleType::class, $famille);

        $form->handleRequest($request);

        //Vérifier si le formulaire est correct
        if($form->isSubmitted() && $form->isValid()){
        
            $manager->persist($famille);
            $manager->flush();

            //Message flash de confirmation
            $this->addFlash(
                'success',
                "Les modifications de la famille <strong>{$famille->getFAMLibelle()}</strong> ont bien été enregistrées !"
            );

            //Redirection vers la liste
            return $this->redirectToRoute('familles_index');
        }

        return $this->render('famille/edit.html.twig', [
            'form' => $form->createView(),
            'famille' => $famille
        ]);
    }

    /**
     * Permet de supprimer un famille
     *
     * @Route("/familles/{FAM_Code}/delete", name="familles_delete")
     * 
     * @param Famille $famille
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Famille $famille, EntityManagerInterface $manager) {
        $manager->remove($famille);
        $manager->flush();

        //Message flash de confirmation
        $this->addFlash(
            'success',
            "La famille <strong>{$famille->getFAMLibelle()}</strong> a bien été supprimée !"
        );

        //Redirection vers la liste
        return $this->redirectToRoute("familles_index");
    }
}
