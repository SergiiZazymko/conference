<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\MainEventRepository;
use App\Repository\SpeakerRepository;
use App\Repository\SponsorRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConferenceController extends Controller
{
    /**
     * @Route("/conference", name="conference")
     */
    public function index(
        MainEventRepository $mainEventRepository,
        SpeakerRepository $speakerRepository,
        SponsorRepository $sponsorRepository,
        EventRepository $eventRepository
)
    {
        $mainEvent = $mainEventRepository->find(1);
        $speakers = $speakerRepository->findAll();
        $platinumSponsors = $sponsorRepository->findByType(1);
        $goldSponsors = $sponsorRepository->findByType(2);
        $silverSponsors = $sponsorRepository->findByType(3);
        $bronzeSponsors = $sponsorRepository->findByType(4);
        $events = $eventRepository->findByStart();

        if (!$mainEvent) {
            throw $this->createNotFoundException('There are no items in MainEvent');
        } elseif (!$speakers) {
            throw $this->createNotFoundException('There are no items in Speaker');
        }

        return $this->render('conference/index.html.twig', [
            'event' => $mainEvent,
            'speakers' => $speakers,
            'platinumSponsors' => $platinumSponsors,
            'goldSponsors' => $goldSponsors,
            'silverSponsors' => $silverSponsors,
            'bronzeSponsors' => $bronzeSponsors,
            'events' => $events,
        ]);
    }
}
