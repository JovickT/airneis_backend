<?php

namespace App\EventListener;

use App\Repository\ContactRepository;
use DateTime;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class GlobalDataSubscriber implements EventSubscriberInterface
{
    private $contactRepository;
    private $twig;

    public function __construct(ContactRepository $contactRepository, Environment $twig)
    {
        $this->contactRepository = $contactRepository;
        $this->twig = $twig;
    }

    function timeAgo($date) {
        $currentDate = new DateTime();
        $createdDate = new DateTime($date);
        $interval = $createdDate->diff($currentDate);
    
        $years = $interval->y;
        $months = $interval->m;
        $days = $interval->d;
    
        if ($years > 0) {
            return $years . ' ' . ($years === 1 ? 'year' : 'years') . ' ago';
        } elseif ($months > 0) {
            return $months . ' ' . ($months === 1 ? 'month' : 'months') . ' ago';
        } elseif ($days >= 7) {
            $weeks = floor($days / 7);
            return $weeks . ' ' . ($weeks === 1 ? 'week' : 'weeks') . ' ago';
        } else {
            return $days . ' ' . ($days === 1 ? 'day' : 'days') . ' ago';
        }
    }

    public function onKernelController(ControllerEvent $event)
    {
        // Ajouter un contrôle pour éviter les erreurs de type de réponse
        if (!$event->isMainRequest()) {
            return;
        }

        $infos = [];
        // Récupérer les contacts
        $contacts = $this->contactRepository->findAll();
        
            if(isset($contacts) && $contacts) {
                foreach ($contacts as $key => $contact) {
                    $info = [
                        'id' => $contact->getId(),
                        'email' => $contact->getEmail(),
                        'nom' => $contact->getNom(),
                        'prenom' => $contact->getPrenom(),
                        'message' => $contact->getMessage(),
                        'date' => $contact->getDate(),
                        'dispay_date' => $this->timeAgo($contact->getDate()->format('Y-m-d'))
                    ];
        
                    $infos[] = $info;
                }
            }
       
      
        // dd($contacts);
        // Ajouter les contacts en tant que variable globale Twig
        $this->twig->addGlobal('messages', $infos);
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
