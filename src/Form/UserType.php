<?php

namespace App\Form;

use App\Entity\User;
use App\Form\RoleType;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class, $this->getConfiguration("Nom", "Entre le nom"))
            ->add('Prenom', TextType::class, $this->getConfiguration("Prenom", "Entrez le prenom"))
            ->add('Email', TextType::class, $this->getConfiguration("Email", "Donnez un email"))
            ->add('RolesUser', CollectionType::class, [
                'entry_type' => RoleType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('Password', TextType::class, $this->getConfiguration("Mot de passe", "Entrez le mot de passe"))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
