<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class Avis1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('detailavisservice', TextType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control'],
                'label' => 'description',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Please enter a user ID',
                    ]),
                    new Assert\Length([
                        'max' => 255,
                        'maxMessage' => 'The description cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('noteservice', RangeType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 10, // Set the max value according to your needs
                    'step' => 1,  // Set the step according to your needs
                    'class' => 'form-range'
                ],
                'empty_data' => 5, // Default value when the form is empty
                'data' => 5, // Initial value of the field
                'label' => 'Note Service',
                'required' => false,
                'constraints' => [
                    new Assert\Range([
                        'min' => 0,
                        'max' => 10,
                        'notInRangeMessage' => 'The noteservice must be between {{ min }} and {{ max }}',
                    ]),
                ],
            ])
            ->add('service', ChoiceType::class, [
                'attr' => array('class' => 'form-control'),
                'choices' => [
                    'Service evenement' => 'Service evenement',
                    'Service investissement' => 'Service investissement',
                    'Service Communication' => 'Service Communication',
                    'Service Produit' => 'Service Produit'
                ],
                'multiple' => false,
                'label' => 'Service',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Please select a service',
                    ]),
                ],
            ])
            ->add('iduser', IntegerType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control', 'type'=> 'number'],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Please enter a user ID',
                    ]),
                    new Assert\Type([
                        'type' => 'numeric',
                        'message' => 'The user ID must be a number',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}