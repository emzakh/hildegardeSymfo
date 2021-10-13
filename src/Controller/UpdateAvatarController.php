<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UpdateAvatarController extends AbstractController
{   

   /**
     * @param Request $request
     * @param EntityManagerInterface $manager     
     * @return Response
     */ 
    public function __invoke(Request $request, EntityManagerInterface $manager, UserRepository $userRepo)  
   {             
    $user = $this->getUser();   
    // return $user;
    $id = $request->get('id');
    $user = $userRepo->find($id);
    $uploadedFile = $request->files->get('picture'); 
    if(!$uploadedFile){
         die('You need a file upload');
    }else{        
         $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
         $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
         $newFilename = $safeFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
         try{
             $uploadedFile->move(
                 $this->getParameter('uploads_directory'),
                 $newFilename
             );
         }
         catch (FileException $e){
             return $e->getMessage();
         }  
         $user->setPicture($newFilename);
    }   

    $manager->persist($user);
    $manager->flush();
  
 
    return $user;
   }
}
