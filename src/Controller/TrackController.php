<?php

namespace App\Controller;

use App\Repository\TrackRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Track;
use App\Form\TrackType;
use Doctrine\ORM\EntityManagerInterface;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TrackController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function show(TrackRepository $trackRepository): Response
    {


        return $this->render('track/index.html.twig', [
            'WishListTracks' => $trackRepository->findAll()
        ]);
    }

    #[Route('/tracks/new', name: 'app_new_track', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $track = new Track();
        $CreateAddTrackForm = $this->createForm(TrackType::class, $track);
        $CreateAddTrackForm->handleRequest($request);

        if ($CreateAddTrackForm->isSubmitted() && $CreateAddTrackForm->isValid()) {
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
    public function edit(Track $track, Request $request, EntityManagerInterface $entityManager): Response
    {

        $CreateAddTrackForm = $this->createForm(TrackType::class, $track);
        $CreateAddTrackForm->handleRequest($request);

        if ($CreateAddTrackForm->isSubmitted() && $CreateAddTrackForm->isValid()) {
            $entityManager->persist($track);
            $entityManager->flush();

            return new JsonResponse(['status' => 'successfuly updated']);
        }

        $formConstruction = $this->renderView(
            '_partials/_form-modal.html.twig',
            [
                'trackForm' => $CreateAddTrackForm->createView(),
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
