<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UploadUserController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

   public function __invoke(Request $request)
   {
       $data = new User();
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

            $data->setPicture($newFilename);
       }

       

       $data->setFirstName($request->request->get('firstName'));
       $data->setLastName($request->request->get('lastName'));
       $data->setEmail($request->request->get('email'));
       $data->setPassword($request->request->get('password'));
       $data->setPresentation($request->request->get('presentation'));
       $this->manager->persist($data);
       $this->manager->flush();
     
    
       return $data;

   }
}
