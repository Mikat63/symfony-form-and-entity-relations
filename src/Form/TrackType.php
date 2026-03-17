<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Genre;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add(
                'artists',
                TextType::class,
                [
                    'required' => true
                ]
            )
            ->add(
                'album',
                TextType::class,
                ['required' => false]
            )

            ->add(
                'year',
                TextType::class,
                [
                    'required' => false,
                    'mapped' => false
                ]
            )

            ->add(
                'genres',
                TextType::class,
                [
                    'required' => true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
