<?php

namespace App\Form;



use App\Entity\Composant;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ComposantType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CMP_Code', IntegerType::class, $this->getConfiguration("Code", "Donnez un code"))
            ->add('CMP_Libelle', TextType::class, $this->getConfiguration("Composant", "Entrez le composant"))    
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Composant::class,
        ]);
    }
}
