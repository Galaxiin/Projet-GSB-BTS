<?php

namespace App\Form;


use App\Entity\Famille;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class FamilleType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('FAM_Code', IntegerType::class, $this->getConfiguration("Code de la famille", "Entrez le code"))
            ->add('FAM_Libelle', TextType::class, $this->getConfiguration("Nom de la famille", "Entrez la famille"))    
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Famille::class,
        ]);
    }
}
