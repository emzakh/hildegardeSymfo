<?php

namespace App\Form;

use App\Entity\Produits;
use App\Form\ApplicationType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends ApplicationType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => "Nom",
                'attr' => [
                    'placeholder'=>'Nom du produit'
                ]
            ])
            ->add('nomlatin', TextType::class, $this->getConfiguration('Nom Latin', 'Nom latin du produit'))
            ->add('categorie',ChoiceType::class,[
                'choices' => [
                    'Jardin'=>'Jardin',
                    'Potager'=>'Potager',
                    'Epices'=>'Epices'
                ]
            ])
            ->add('effets', TextType::class, $this->getConfiguration('Introduction','Donnez une description globale de l\'annonce'))
            ->add('description', TextareaType::class, $this->getConfiguration('Description','Description du produit'))

            ->add('saison', TextareaType::class, $this->getConfiguration('Saison','Saison du produit'))

            ->add('cultivation', TextareaType::class, $this->getConfiguration('Cultivation','Cultivation du produit'))
            
            ->add('conservation', TextareaType::class, $this->getConfiguration('Conservation','Conservation du produit'))
            ->add('apport', TextareaType::class, $this->getConfiguration('Apport','Apport du produit'))
            ->add('vitamine', TextareaType::class, $this->getConfiguration('Vitamine','Vitamine du produit'))
            ->add('bebe', TextareaType::class, $this->getConfiguration('Bebe','Bebe du produit'))
            ->add('nutriscore', TextareaType::class, $this->getConfiguration('Nutriscore','Nutriscore du produit'))
            ->add('image', FileType::class, [
                'label' => "Image du produit (jpg, png, gif)",

            ])



        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
