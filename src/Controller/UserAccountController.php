<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\PasswordUpdate;
use App\Entity\Role;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserAccountController extends AbstractController
{
    /**
     * Permet d'afficher la liste de tous les utilisateurs
     * 
     * @Route("/users", name="users_index")
     */
    public function index(UserRepository $repo)
    {
        $users = $repo->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * Permet d'afficher le formulaire de création d'un utilisateur
     * 
     * @Route("/users/new", name="users_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager,  UserPasswordEncoderInterface $encoder){
        $user = new User();
        $role = new Role();
        
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        //Vérifier si le formulaire est correct
        if($form->isSubmitted() && $form->isValid()){
            //Ajout d'un role dans sa collection des roles
            foreach($user->getRolesUser() as $role) {
                $role->addUser($user);
                $manager->persist($role);
            }

            //Encodage du mot de passe
            $password = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $manager->persist($user);
            $manager->flush();

            //Message flash de confirmation
            $this->addFlash(
                'success',
                "L'utilisateur <strong>{$user->getFullName()}</strong> a bien été enregistrée !"
            );

            //Redirection vers la liste
            return $this->redirectToRoute('users_index');
        }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'édition
     *
     * @Route("/users/edit/{id}", name="users_edit")
     * 
     * @return Response
     */
    public function edit(User $user, Request $request, EntityManagerInterface $manager){

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        //Vérifier si le formulaire est correct
        if($form->isSubmitted() && $form->isValid()){
            //Enregistrement d'un role dans sa collection des roles si ya
            foreach($user->getRolesUser() as $role) {
                $role->setUser($user);
                $manager->persist($role);
            }
            
            $manager->persist($user);
            $manager->flush();

            //Message flash de confirmation
            $this->addFlash(
                'success',
                "Les modifications de l'utilisateur <strong>{$user->getFullName()}</strong> ont bien été enregistrées !"
            );

            //Redirection vers la liste
            return $this->redirectToRoute('users_index');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * Permet de supprimer un user
     *
     * @Route("/users/delete/{id}", name="users_delete")
     * 
     * @param User $user
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(user $user, EntityManagerInterface $manager) {
        $manager->remove($user);
        $manager->flush();

        //Message flash de confirmation
        $this->addFlash(
            'success',
            "L'utilisateur' <strong>{$user->getFullName()}</strong> a bien été supprimée !"
        );

        //Redirection vers la liste
        return $this->redirectToRoute("users_index");
    }


    /**
     * Permet d'afficher le formulaire de connexion
     * 
     * @Route("/login", name="account_login")
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();
        
        return $this->render('account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);

        //Redirection vers la liste
        return $this->redirectToRoute('medicaments_index');
    }

    /**
     * Permet de se déconnecter
     * 
     * @Route("/logout", name="account_logout")
     * 
     * @return void
     */
    public function logout() {
        // .. rien !
    }

    /**
     * Permet d'afficher le formualire de modification du mot de passe
     *
     * @Route("/account/password-update", name="account_password")
     * 
     * @return Response
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager) {
        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        $form->handleRequest($request);

        //Vérifier si le formulaire est correct
        if($form->isSubmitted() && $form->isValid()) {
            // Vérifier que le oldPasword du formulaire soit le même que le password de l'user
            if (!password_verify($passwordUpdate->getOldPassword(), $user->getpassword())){
            // Gérer l'erreur
            $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapé n'est pas votre mot de passe actuel !"));
            } else {
                $newPassword = $passwordUpdate->getNewPassword();
                $password = $encoder->encodePassword($user, $newPassword);

                $user->setPassword($password);

                $manager->persist($user);
                $manager->flush();

                //Message flash de confirmation
                $this->addFlash(
                    'success',
                    "Votre mot de passe a bien été modifié !"
                );
                
                //Redirection vers la liste
                return $this->redirectToRoute('medicaments_index');
            }
        }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
