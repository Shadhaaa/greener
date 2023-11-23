<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Energie;
use App\Entity\Produit;
use App\Entity\Vehicule;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelletProduit')
            ->add('Categorie' , EntityType::class,[
                'class'=> Categorie::class,
                'choice_label' => 'libellet',
                'required' => true
            ])
            ->add('image', FileType::class, [
                'label' => 'image',
                'required' => false,
            ])
            ->add('Prix')
            ->add('Description')
            ->add('Production_mentuelle')
            ->add('Stock_actuelle')
            ->add('typeVehicule', EntityType::class, [
                'class' => Vehicule::class,
                'choice_label' => 'LibelletVehicule'
            ])
            ->add('distanceVehicule')
            ->add('typeEnergie' , EntityType::class,[
                'class'=> Energie::class,
                'choice_label' => 'libelletEnergie',
            ])
            ->add('consommationrnEnergie')
            ->add('Pollution_par_piece')
            
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
