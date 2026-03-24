<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Track;
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
        // artists
        $track = $options['data'];
        $artistString = "";

        if ($track instanceof Track) {
            $artists = $track->getArtists()->toArray();

            if ($artists) {
                $artistString = implode(", ", $artists);
            }
        }

        // album
        $album = $options["data"]->getAlbum();

        if ($album) {
            $albumName = $album->getName();
            $year = $album->getYear();
        } else {
            $albumName = '';
            $year = "";
        }

        $builder
            ->add('name', TextType::class)


            ->add(
                'artistNames',
                TextType::class,
                [
                    'mapped' => false,
                    'required' => true,
                    'attr' => ['placeholder' => 'Ex: Daft Punk, Gesaffelstein'],
                    'data' => $artistString,
                ]
            )

            ->add(
                'album',
                TextType::class,
                [
                    'mapped' => false,
                    'data' => $albumName,
                    'required' => false,
                    'attr' => ['placeholder' => 'Ex: Hybrid Theory'],

                ]
            )

            ->add(
                'year',
                TextType::class,
                [
                    'required' => false,
                    'mapped' => false,
                    'data' => $year,
                ]
            )

            ->add(
                'genres',
                EntityType::class,
                [
                    'class' => Genre::class,
                    'choice_label' => 'name',
                    'multiple' => true,
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
