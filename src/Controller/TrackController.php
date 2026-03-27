<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Repository\TrackRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Track;
use App\Entity\Album;
use App\Form\TrackType;
use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TrackController extends AbstractController
{
    #[Route('/tracks/show', name: 'app_show_tracks', methods: ['GET'])]
    public function show(TrackRepository $trackRepository): Response
    {


        return $this->render('track/index.html.twig', [
            'WishListTracks' => $trackRepository->findAll()
        ]);
    }

    #[Route('/tracks/new', name: 'app_new_track', methods: ['GET', 'POST'])]
    public function new(Request $request, ArtistRepository $artistRepository, AlbumRepository $albumRepository, EntityManagerInterface $entityManager): Response
    {

        $track = new Track();
        $CreateAddTrackForm = $this->createForm(TrackType::class, $track, [
            'action' => $this->generateUrl('app_new_track'),
        ]);
        $CreateAddTrackForm->handleRequest($request);

        if ($CreateAddTrackForm->isSubmitted() && $CreateAddTrackForm->isValid()) {

            // artists request
            $artistNamesRaw = $CreateAddTrackForm->get("artistNames")->getData();
            $artistNames = array_filter(array_map('trim', explode(',', $artistNamesRaw)));

            foreach ($artistNames as $name) {
                $artist = $artistRepository->findOneBy(['name' => $name]);
                if (!$artist) {
                    $artist = new Artist();
                    $artist->setName($name);
                    $entityManager->persist($artist);
                }

                $track->addArtist($artist);
            }

            // album request
            $albumFormData = $CreateAddTrackForm->get('album')->getData();
            $albumYearFormData = $CreateAddTrackForm->get('year')->getData();

            if ($albumFormData) {
                $album = $albumRepository->findOneBy(['name' => $albumFormData]);

                if (!$album) {
                    $album = new Album();
                    $album->setName($albumFormData)->setYear((int) $albumYearFormData);
                    $entityManager->persist($album);
                }
                $track->setAlbum($album);
            }

            $entityManager->persist($track);
            $entityManager->flush();

            return new JsonResponse(['status' => 'successfuly Added']);
        }

        $formConstruction = $this->renderView(
            '_partials/_form-modal.html.twig',
            [
                'trackForm' => $CreateAddTrackForm->createView(),
            ]
        );

        return new JsonResponse([
            'status' => 'form new created',
            'content' => $formConstruction,
        ]);
    }

    #[Route('/tracks/edit/{id}', name: 'app_edit_track', methods: ['GET', 'POST'], requirements: ['id' => '\\d+'])]
    public function edit(Track $track, Request $request, ArtistRepository $artistRepository, AlbumRepository $albumRepository, EntityManagerInterface $entityManager): Response
    {

        $CreateAddTrackForm = $this->createForm(TrackType::class, $track, [
            'action' => $this->generateUrl('app_edit_track', ['id' => $track->getId()])
        ]);

        $CreateAddTrackForm->handleRequest($request);

        if ($CreateAddTrackForm->isSubmitted() && $CreateAddTrackForm->isValid()) {

            // artists requeest
            $artistNamesRaw = $CreateAddTrackForm->get("artistNames")->getData();

            $artistNames = array_filter(array_map('trim', explode(',', $artistNamesRaw)));

            // Pour edit : d'abord vider les artistes existants
            foreach ($track->getArtists() as $existing) {
                $track->removeArtist($existing);
            }

            foreach ($artistNames as $name) {
                $artist = $artistRepository->findOneBy(['name' => $name]);
                if (!$artist) {
                    $artist = new Artist();
                    $artist->setName($name);
                    $entityManager->persist($artist);
                }

                $track->addArtist($artist);
            }

            // album request
            $albumFormData = $CreateAddTrackForm->get('album')->getData();


            if ($albumFormData) {
                $albumYearFormData = $CreateAddTrackForm->get('year')->getData();
                $album = $albumRepository->findOneBy(['name' => $albumFormData]);

                if (!$album) {
                    $album = new Album();
                    $album->setName($albumFormData)->setYear((int) $albumYearFormData);
                    $entityManager->persist($album);
                }
                $track->setAlbum($album);
            }

            $entityManager->persist($track);
            $entityManager->flush();

            return new JsonResponse(['status' => 'successfuly updated']);
        }

        $formConstruction = $this->renderView(
            '_partials/_form-modal.html.twig',
            [
                'trackForm' => $CreateAddTrackForm->createView(),
                'album' => $track->getAlbum(),
                'artists' => $track->getArtists(),
            ]
        );

        return new JsonResponse([
            'status' => 'form edit created',
            'content' => $formConstruction,
        ]);
    }

    #[Route('/tracks/delete/{id}', name: 'app_delete_track', methods: ['GET', 'POST'], requirements: ['id' => '\\d+'])]
    public function delete(Track $track, Request $request, EntityManagerInterface $entityManager): Response
    {

        if ($request->isMethod('POST')) {
            try {

                $entityManager->remove($track);
                $entityManager->flush();

                return new JsonResponse(['status' => 'successfuly deleted']);
            } catch (\Throwable $th) {
                return new JsonResponse(['status' => 'error track not deleted']);
            }
        }



        $modalConstruction = $this->renderView(
            '_partials/_confirm-delete-track-modal.html.twig',
            [
                'track' => $track,
            ]
        );

        return  new JsonResponse([
            'status' => 'delete modal created',
            'content' => $modalConstruction,
        ]);
    }
}
