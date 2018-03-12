<?php

namespace App\Controller;

use App\Repository\MainEventRepository;
use App\Repository\PhotoRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomePageController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(MainEventRepository $eventRepository, PhotoRepository $photoRepository)
    {
        $event = $eventRepository->find(1);
        $photos = $photoRepository->findAll();

        if (!$event) {
            throw $this->createNotFoundException('There are no items in MainEvent');
        } elseif (!$photos) {
            throw $this->createNotFoundException('There are no photos in Photos');
        } elseif (count($photos != 8)) {

        }

        return $this->render('home/index.html.twig', [
            'event' => $event,
            'photos' => $photos,
        ]);
    }
}
