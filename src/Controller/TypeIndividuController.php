<?php

namespace App\Controller;

use App\Entity\TypeIndividu;
use App\Form\TypeIndividuType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TypeIndividuRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// FACULTATIF
class TypeIndividuController extends AbstractController
{
    /**
     * @Route("/type_individus", name="type_individus_index")
     */
    public function index(TypeIndividuRepository $repo)
    {
        $typeindividus = $repo->findAll();

        return $this->render('type_individu/index.html.twig', [
            'type_individus' => $typeindividus
        ]);
    }
    
    /**
     * Permet de créer un type d'individu
     * 
     * @Route("/type_individus/new", name="type_individus_create")
     * 
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager){
        $typeindividu = new TypeIndividu();
        
        $form = $this->createForm(TypeIndividuType::class, $typeindividu);

        $form->handleRequest($request);
        /* 
        if($form->isSubmitted() && $form->isValid()){
        
            $typeindividu->$this->getUser();
            
            $manager->persist($typeindividu);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le type d'individu <strong>{$typeindividu->getTINLibelle()}</strong> a bien été enregistrée !"
            );

            return $this->redirectToRoute('typeindividus_show', [
                'slug' => $typeindividu
            ]);
        */
        return $this->render('type_individu/new.html.twig', [
            'form' => $form->createView()
        ]);
        }

    /**
     * Permet d'afficher le formulaire d'édition
     *
     * @Route("/type_individus/{slug}/edit", name="type_individus_edit")
     * 
     * 
     * 
     * @return Response
     */
    public function edit(TypeIndividu $typeindividu, Request $request, EntityManagerInterface $manager){

        $form = $this->createForm(TypeIndividuType::class, $typeindividu);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
        
            $manager->persist($typeindividu);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications du type d'individu <strong>{$typeindividu->getTINLibelle()}</strong> ont bien été enregistrées !"
            );

            return $this->redirectToRoute('type_individus_show', [
                'slug' => $typeindividu
            ]);
        }

        return $this->render('type_individu/edit.html.twig', [
            'form' => $form->createView(),
            'type_individu' => $typeindividu
        ]);
    }

    /**
     * Permet d'afficher un seul type d'individu
     *
     * @Route("/type_individus/{slug}", name="type_individus_show")
     *
     * @return Response
     */
    public function show($slug, TypeIndividu $typeindividu)
    {
        return $this->render('type_individu/show.html.twig',[
            'type_individu' => $typeindividu
        ]);
    }

    /**
     * Permet de supprimer un type d'individu
     *
     * @Route("/type_individus/{slug}/delete", name="type_individus_delete")
     * 
     * 
     * @param TypeIndividu $typeindividu
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(TypeIndividu $typeindividu, EntityManagerInterface $manager) {
        $manager->remove($typeindividu);
        $manager->flush();

    $this->addFlash(
        'success',
        "Le type d'individu <strong>{$typeindividu->getTINLibelle()}</strong> a bien été supprimée !"
    );

        return $this->redirectToRoute("type_individus_index");
    }
}
