<?php

namespace App\DataFixtures;

use App\Entity\Day;
use App\Entity\Event;
use App\Entity\MainEvent;
use App\Entity\Photo;
use App\Entity\Room;
use App\Entity\Speaker;
use App\Entity\Sponsor;
use App\Entity\SponsorType;
use App\Entity\Ticket;
use App\Entity\Type;
use App\Repository\DayRepository;
use App\Repository\RoomRepository;
use App\Repository\SpeakerRepository;
use App\Repository\SponsorTypeRepository;
use App\Repository\TypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class App extends Fixture
{
    public function __construct(
        SponsorTypeRepository $sponsorTypeRepository,
        TypeRepository $typeRepository,
        SpeakerRepository $speakerRepository,
        DayRepository $dayRepository,
        RoomRepository $roomRepository
    )
    {
        $this->sponsorTypeRepository = $sponsorTypeRepository;
        $this->typeRepository = $typeRepository;
        $this->speakerRepository = $speakerRepository;
        $this->dayRepository = $dayRepository;
        $this->roomRepository = $roomRepository;
    }

    public function load(ObjectManager $manager)
    {

        $mainIvent = new MainEvent();
        $mainIvent->setName('PHP fwdays\'18');
        $mainIvent->setDate(new \DateTime('2018-06-10'));
        $mainIvent->setDescription('Конференція для PHP розробників');
        $manager->persist($mainIvent);

        $speakers = [
            [
                'name' => 'Андрій Лісточкін',
                'company' => 'OneReach',
                'position' => 'Product Developer',
                'image' => 'Listochin_230.png',
            ],
            [
                'name' => 'Юлія Пучніна',
                'company' => 'Freelancer',
                'position' => 'JavaScript Developer',
                'image' => 'Pucnina_230.jpg',
            ],
            [
                'name' => 'Катерина Лизогубова',
                'company' => 'AltexSoft',
                'position' => 'JavaScript Software Engineer',
                'image' => 'Lizogubova.jpg',
            ],
        ];

        foreach ($speakers as $speaker) {
            $item = new Speaker();
            $item->setName($speaker['name']);
            $item->setCompany($speaker['company']);
            $item->setPosition($speaker['position']);
            $item->setImage($speaker['image']);
            $item->setUpdatedAt(new \DateTime('now'));
            $manager->persist($item);
        }

        $days = ['Перший', 'Другий', 'Третій', ];

        foreach ($days as $day) {
            $item = new Day();
            $item->setName($day);
            $manager->persist($item);
        }

        $rooms = ['Біла кімната', 'Зелена кімната', 'Жовта кімната', 'Синя кімната', 'Блакитна кімната',];

        foreach ($rooms as $room) {
            $item = new Room();
            $item->setName($room);
            $manager->persist($item);
        }

        $types = ['Відкриття', 'Доповідь', 'Доповідь дня', 'Закриття', 'Афтерпаті',];

        foreach ($types as $type) {
            $item = new Type();
            $item->setName($type);
            $manager->persist($item);
        }

        for ($i = 0; $i < 8; $i++) {
            $photo = new Photo();
            $photo->setImage("gallery_image_{$i}.jpg");
            $photo->setUpdatedAt(new \DateTime('now'));
            $manager->persist($photo);
        }

        $sponsorTypes = ['Platinum', 'Gold', 'Silver', 'Bronze',];

        foreach ($sponsorTypes as $type) {
            $item = new SponsorType();
            $item->setName($type);
            $manager->persist($item);
        }

        $tickets = [
            [
                'name' => 'Один день',
                'description' => 'Квиток на один день',
                'price' => 1000,
            ],
            [
                'name' => 'Два дні',
                'description' => 'Квиток на два дні',
                'price' => 2000,
            ],
            [
                'name' => 'Три дні',
                'description' => 'Квиток на три дні',
                'price' => 3000,
            ],
        ];

        foreach ($tickets as $ticket) {
            $item = new Ticket();
            $item->setName($ticket['name']);
            $item->setDescription($ticket['description']);
            $item->setPrice($ticket['price']);
            $manager->persist($item);
        }

        $manager->flush();

        $sponsors = [
            [
                'name' => 'grammarly',
                'site' => 'https://www.grammarly.com/',
                'image' => 'Grammarly.png',
            ],
            [
                'name' => 'epam',
                'site' => 'https://www.epam.com/',
                'image' => 'automation-920.png',
            ],
            [
                'name' => 'WiX Engineering',
                'site' => 'https://www.wix.engineering/',
                'image' => 'download.png',
            ],
            [
                'name' => 'ITEA',
                'site' => 'https://itea.ua/',
                'image' => 'itea.png',
            ],
        ];

        foreach ($sponsors as $sponsor) {
            $item = new Sponsor();
            $item->setName($sponsor['name']);
            $item->setSite($sponsor['site']);
            $item->setType($this->sponsorTypeRepository->find(random_int(1, 4)));
            $item->setImage($sponsor['image']);
            $manager->persist($item);
        }

        //Event 1
        $event = new Event();
        $event->setName('Front-end Microservices Architecture');
        $event->setType($this->typeRepository->find(2));
        $event->setSpeaker($this->speakerRepository->find(1));
        $event->setStart(new \DateTime('2018-06-10 10:00:00'));
        $event->setDurability(120);
        $event->addDay($this->dayRepository->findByName('Перший')[0]);
        $event->addDay($this->dayRepository->findByName('Другий')[0]);
        $event->setRoom($this->roomRepository->find(1));
        $manager->persist($event);

        //Event 2
        $event = new Event();
        $event->setName('React: дорога к просветлению');
        $event->setType($this->typeRepository->find(3));
        $event->setSpeaker($this->speakerRepository->find(3));
        $event->setStart(new \DateTime('2018-06-12 11:00:00'));
        $event->setDurability(40);
        $event->addDay($this->dayRepository->findByName('Третій')[0]);
        $event->setRoom($this->roomRepository->find(3));
        $manager->persist($event);

        //Event 3
        $event = new Event();
        $event->setName('Creating virtual worlds in the browser');
        $event->setType($this->typeRepository->find(2));
        $event->setSpeaker($this->speakerRepository->find(2));
        $event->setStart(new \DateTime('2018-06-10 13:00:00'));
        $event->setDurability(180);
        $event->addDay($this->dayRepository->findByName('Перший')[0]);
        $event->addDay($this->dayRepository->findByName('Другий')[0]);
        $event->addDay($this->dayRepository->findByName('Третій')[0]);
        $event->setRoom($this->roomRepository->find(5));
        $manager->persist($event);

        //Event 4
        $event = new Event();
        $event->setName('Відкриття');
        $event->setType($this->typeRepository->find(1));
        $event->setStart(new \DateTime('2018-06-10 09:00:00'));
        $event->setDurability(30);
        $event->addDay($this->dayRepository->findByName('Перший')[0]);
        $event->setRoom($this->roomRepository->find(3));
        $manager->persist($event);

        //Event 5
        $event = new Event();
        $event->setName('Закриття');
        $event->setType($this->typeRepository->find(4));
        $event->setStart(new \DateTime('2018-06-12 18:00:00'));
        $event->setDurability(30);
        $event->addDay($this->dayRepository->findByName('Третій')[0]);
        $event->setRoom($this->roomRepository->find(4));
        $manager->persist($event);

        //Event 5
        $event = new Event();
        $event->setName('Афтерпаті');
        $event->setType($this->typeRepository->find(5));
        $event->setStart(new \DateTime('2018-06-12 19:00:00'));
        $event->setDurability(180);
        $event->addDay($this->dayRepository->findByName('Третій')[0]);
        $event->setRoom($this->roomRepository->find(2));
        $manager->persist($event);

        $manager->flush();
    }
}
