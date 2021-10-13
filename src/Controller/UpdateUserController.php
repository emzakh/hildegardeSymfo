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
        $user = $this->getUser();     
        $user->setFirstName($request->get('firstName'));
        $user->setLastName($request->get('lastName'));
        $user->setPresentation($request->get('presentation'));
      
            $manager->persist($user);
            $manager->flush(); 
            return $user;
    }
}
