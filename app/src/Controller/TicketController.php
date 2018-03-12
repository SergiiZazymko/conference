<?php

namespace App\Controller;

use App\Repository\TicketRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TicketController extends Controller
{
    /**
     * @Route("/ticket", name="ticket")
     */
    public function index(TicketRepository $ticketRepository)
    {
        $tickets = $ticketRepository->findAll();

        if (!$tickets) {
            throw $this->createNotFoundException('There are no items in Ticket');
        }

        return $this->render('ticket/index.html.twig', [
            'tickets' => $tickets,
        ]);
    }
}
