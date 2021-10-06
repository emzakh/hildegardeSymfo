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

class UpdateAvatar extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

   public function __invoke(Request $request, UserRepository $userRepo)
   {
    $data = $userRepo->findBy(['id']);
    if(count($data) > 0){
        $currentUser = $data[0];
    }else{        
        die('user doesnt exist');
    }
    $uploadedFile = $request->files->get('picture');
    if(!$uploadedFile){
         die('You need a file upload');
    }else{
         $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
         // this is needed to safely include the file name as part of the URL
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

         $currentUser->setPicture($newFilename);
    }

    

    $currentUser->setId($request->request->get('id'));
  
    $this->manager->persist($currentUser);
    $this->manager->flush();
  
 
    return $currentUser;
   }
}