<?php

namespace App\Controller;

use App\Entity\Recettes;
use App\Repository\UserRepository;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UploadRecetteController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

   public function __invoke(Request $request, UserRepository $repo, ProduitsRepository $repoproduit)
   {
       $data = new Recettes();
       $uploadedFile = $request->files->get('imgRecette');
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

            $data->setImgRecette($newFilename);
       }       
 
       $data->setTitre($request->request->get('titre'));
       $data->setDescription($request->request->get('description'));
       $data->setEtapes($request->request->get('etapes'));
       $data->setDate(new \DateTime());
       $data->setPreptime($request->request->get('preptime'));
       $data->setCooktime($request->request->get('cooktime'));
       $data->setPortion($request->request->get('portion'));
       $data->setTypes($request->request->get('types'));
       
       $ingredients = $request->request->get('ingredients');
       $ingredientsIds = explode(',', $ingredients);   
       $ingredients = $repoproduit->findBy(['id' => $ingredientsIds]); 

       foreach ($ingredients as $ingredient) {
       $data->addIngredient($ingredient);
       } 
  
       $data->setAuthor($this->getUser());       
       $this->manager->persist($data);
       $this->manager->flush();
     
    
       return $data;

   }
}
