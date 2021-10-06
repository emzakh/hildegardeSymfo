<?php

namespace App\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtCreatedSubscriber {

    public function updateJwtData(JWTCreatedEvent $event){
        // récup l'utilisateur (pour avoir le firstName et la lastName )
        $user = $event->getUser();
        

        $data = $event->getData(); // récup un tableau qui contient les données de base sur l'utilisateur dans le token

        $data['id'] = $user->getId();
        $data['firstName'] = $user->getFirstName();
        $data['lastName'] = $user->getLastName();
        $data['picture'] = $user->getPicture();
        $data['presentation'] = $user->getPresentation();
        $data['email'] = $user->getEmail();

     

        $event->setData($data); // on repasse le tableau data modifié au EventData

    }



}