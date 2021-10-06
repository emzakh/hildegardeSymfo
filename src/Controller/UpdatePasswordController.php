<?php

namespace App\Controller;

use App\Entity\PasswordUpdate;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UpdatePasswordController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function __invoke(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
    
        $user = $this->getUser(); 
            $password = $request->request->get('newPassword');
            // die(dump($password));
            return $password;
            // $hash = $encoder->encodePassword($user,$password);
            // $user->setPassword($hash);
            // $manager->persist($user);
            // $manager->flush(); 
            // return true;
    }
}
