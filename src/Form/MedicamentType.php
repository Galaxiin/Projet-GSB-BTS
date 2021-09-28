<?php

namespace App\Form;

use App\Entity\Famille;
use App\Entity\Medicament;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class MedicamentType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'MED_DepotLegal',
                TextType::class, $this->getConfiguration("DEPOT LEGAL", " "))
            ->add(
                'MED_NomCommercial',
                TextType::class, $this->getConfiguration("NOM COMMERCIAL", " "))
            ->add(
                'MED_Composition',
                TextType::class, $this->getConfiguration("COMPOSITION", " "))
            ->add(
                'MED_Effets',
                TextType::class, $this->getConfiguration("EFFETS", ""))
            ->add(
                'MED_ContreIndic',
                TextType::class, $this->getConfiguration("CONTRE INDICATION", ""))
            ->add(
                'MED_PrixEchantillon',
                MoneyType::class, $this->getConfiguration("PRIX ECHANTILLON", ""))

            ->add('MED_Famille',
                EntityType::class, [
                'class' => Famille::class,
                'choice_label' => 'FAM_Libelle',
                'required' => true,
                'label' => "FAMILLE"
            ])
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medicament::class,
        ]);
    }
}
