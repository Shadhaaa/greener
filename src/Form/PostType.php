<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('idEntreprise')
            ->add('titre')
            ->add('typedecontenu', ChoiceType::class, [
                'choices' => [
                    'Event' => 'event',
                    'Product' => 'product',
                    'News' => 'news',
                ],
                'placeholder' => 'Select content type',
            ])
            ->add('contenu')
            ->add('date' )
            ->add('image', FileType::class, [
                'label' => 'Upload an image',
                'mapped' => false, 
                'required' => false, 
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
