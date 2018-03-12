<?php

namespace App\Controller;


use App\Entity\Event;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    /**
     * @Route("/event/{id}", name="event", requirements={"\d+"})
     */
    public function index(Event $event)
    {
        if (!$event) {
            throw $this->createNotFoundException('There are no item in Event wit this ID');
        }

        return $this->render('event/index.html.twig', [
            'event' => $event,
        ]);
    }
}
