<?php

namespace App\Controller;

use App\Entity\UserImgModify;
use App\Entity\PasswordUpdate;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UpdateUserController extends AbstractController
{ 
    /**
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param EntityManagerInterface $manager     
     * @return Response
     */
    public function __invoke(Request $request, EntityManagerInterface $manager, User $user)
    {
    
        $user = $this->getUser(); 
        $user->setFirstName($request->request->get('firstName'));
        $user->setLastName($request->request->get('lastName'));
        $user->setPresentation($request->request->get('presentation'));
 
            // die(dump($password));
            // return $password;
            $manager->persist($user);
            $manager->flush(); 
            return $user;
    }





}
