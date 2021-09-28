<?php

namespace App\Form;


use App\Entity\Dosage;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class DosageType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('DOS_Code', IntegerType::class, $this->getConfiguration("Code", "Donnez un code"))
            ->add('DOS_Quantite', IntegerType::class, $this->getConfiguration("Quantité", "Tapez la quantité"))
            ->add('DOS_Unite', IntegerType::class, $this->getConfiguration("Unité", "Entrez l'unité"))      
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dosage::class,
        ]);
    }
}
