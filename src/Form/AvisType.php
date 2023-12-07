<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('detailavisservice', TextType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                        'maxMessage' => 'The detailavisservice cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('noteservice', TextType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\Length([
                        'max' => 255,
                        'maxMessage' => 'The noteservice cannot be longer than {{ limit }} characters',
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
            ->add('iduser', TextType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Please enter a user ID',
                    ]),
                    new Assert\Length([
                        'max' => 255,
                        'maxMessage' => 'The user ID cannot be longer than {{ limit }} characters',
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
