<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\Vehicule;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Libellet')
            ->add('Catégorie' , EntityType::class,[
                'class'=> Categorie::class,
                'choice_label' => 'username',
                'placeholder' => 'Choisir Catégorie',
                'required' => true
            ])
            ->add('Prix')
            ->add('Description')
            ->add('Image')
            ->add('Production mentuelle')
            ->add('Stock actuelle')
            ->add('Pollution par piéce')
            ->add('Véhicules(distance totale dans un mois)' , EntityType::class,[
                'class'=> Vehicule::class,
                'choice_label' => 'Vehicule',
                'placeholder' => 'Choisir Vehicule',
                'required' => true
            ])
            ->add('Distabnce par mois')
            ->add('Energies(Consommation par totale mois)' , EntityType::class,[
                'class'=> Vehicule::class,
                'choice_label' => 'Vehicule',
                'placeholder' => 'Choisir Vehicule',
                'required' => true
            ])
            ->add('consommation par mois')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
