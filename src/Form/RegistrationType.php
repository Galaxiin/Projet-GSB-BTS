<?php

namespace App\Form;


use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class, $this->getConfiguration("Nom", "Votre nom de famille ..."))
            ->add('Prenom', TextType::class, $this->getConfiguration("Prenom", "Votre prénom ..."))
            ->add('email', EmailType::class, $this->getConfiguration("Email", "Votre adresse email"))
            ->add('password', PasswordType::class, $this->getConfiguration("Mot de passe", "Choissisez un bon mot de passe !"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
