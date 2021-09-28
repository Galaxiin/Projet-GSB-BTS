<?php

namespace App\Form;


use App\Entity\Presentation;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PresentationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('PRE_Code', IntegerType::class, $this->getConfiguration("Code", "Donnez un code"))
            ->add('PRE_Libelle', TextareaType::class, $this->getConfiguration("Presentation", "Donnez une présentation/contenant du médicament (ex: ampoule, flacon, suppositoire...)"))  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Presentation::class,
        ]);
    }
}
