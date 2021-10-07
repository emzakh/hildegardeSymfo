<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class UpdateUserController extends AbstractController
{ 
    /**
     * @param Request $request
     * @param EntityManagerInterface $manager     
     * @return Response
     */
             
     

    public function __invoke(Request $request, EntityManagerInterface $manager, UserRepository $user)
    {
      
        $content = $request->getContent();
        return new Response($content->get('firstName'));
    }

    // public function __invoke(Request $request, EntityManagerInterface $manager, UserRepository $user)    
    // {        
    //     $user = $this->getUser();     
    //     $user->setFirstName($request->request->get('firstName'));
    //     $user->setLastName($request->request->get('lastName'));
    //     $user->setPresentation($request->request->get('presentation'));

     
    //     // $user->setFirstName('Jean-Michel');
    //     // $user->setLastName('Michon');
    //     // $user->setPresentation('O bladi O blada Olala La kekw');
      
    //         $manager->persist($user);
    //         $manager->flush(); 
    //         return $user;
    // }
}
