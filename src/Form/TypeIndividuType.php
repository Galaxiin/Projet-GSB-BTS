<?php

namespace App\Form;


use App\Entity\TypeIndividu;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class TypeIndividuType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('TIN_Code', IntegerType::class, $this->getConfiguration("Code", "Donnez un code"))
            ->add('TIN_Libelle', TextType::class, $this->getConfiguration("Type d'individu", "Tapez votre type d'individu"))  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TypeIndividu::class,
        ]);
    }
}
