<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idEntreprise')
            ->add('idParticipant')
            ->add('titreEvenement')
            ->add('dateEvenement')
            ->add('qrcode')
            ->add('imageEvenement')
            ->add('lieuEvenement')
            ->add('descriptionEvenement')
            ->add('liste_participants')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
