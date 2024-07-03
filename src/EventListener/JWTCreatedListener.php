<?php 

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $payload = $event->getData();
        $user = $event->getUser();
        
        // Ajoutez les données personnalisées au payload
        $payload['userId'] = $user->getIdClient();

        $event->setData($payload);
    }
}
