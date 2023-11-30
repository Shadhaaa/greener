<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'required' => true,
            'attr' => ['class' => 'form-control'],
            'constraints' => [
                new Length(['max' => 255]), // Adjust max length as needed
            ],
        ])
        ->add('prenom', TextType::class, [
            'required' => true,
            'attr' => ['class' => 'form-control'],
            'constraints' => [
                new Length(['max' => 255]), // Adjust max length as needed
            ],
        ])
        ->add('email', EmailType::class, [
            'required' => true,
            'attr' => ['class' => 'form-control'],
            'constraints' => [
                new Email(),
            ],
        ])
        ->add('numeroMobile', TextType::class, [
            'required' => true,
            'attr' => ['class' => 'form-control'],
            'constraints' => [
                new Length(['max' => 12]), // Adjust max length as needed
                new Length(['min' => 8]), // Adjust min length as needed
                new Type('numeric')
            ],
        ])
        ->add('dateCreation', DateType::class, [
            'widget' => 'single_text',
            'required' => true,
            'constraints' => [
                new NotBlank(),
            ],
        ])
        ->add('description', TextareaType::class, [
            'required' => true,
            'attr' => ['class' => 'form-control'],
            'constraints' => [
                new Length(['max' => 1000]), // Adjust max length as needed
            ],
        ])
        ->add('status', choiceType::class, [
            'attr' => array('class' => 'form-control'),
            'choices' => [
                'Traitée' => 'Traitée',
                'En Cour' => 'En Cour',

            ],

            'multiple' => false,
            'label' => 'Statut'
        ])
        ->add('nomservcie', ChoiceType::class, [
            'attr' => ['class' => 'form-control'],
            'choices' => [
                'Service evenement' => 'Service evenement',
                'Service investissement' => 'Service investissement',
                'Service Communication' => 'Service Communication',
                'Service Produit' => 'Service Produit',
            ],
            'multiple' => false,
            'label' => 'Service',
            'constraints' => [
                new Choice(['choices' => [
                    'Service evenement',
                    'Service investissement',
                    'Service Communication',
                    'Service Produit',
                ]]),
            ],
        ]);

            /* ->add('imageFile', VichImageType::class, [
                'label' => 'Image de loffre ( des images uniquement)',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false
            ]); */
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
