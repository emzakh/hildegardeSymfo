<?php

namespace App\Entity;

use App\Repository\CommentairesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommentairesRepository::class)
 * @ORM\HasLifecycleCallbacks()
 *
 */
class Commentaires
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(min=2, max=500, minMessage="Le commentaire doit faire plus de 2 caractères", maxMessage="Le commentaire ne peut pas faire plus de 500 caractères")
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rating;

    /**
     * @ORM\ManyToOne(targetEntity=Recettes::class, inversedBy="commentaires")
     */
    private $recette;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commentaires")
     */
    private $author;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\PrePersist
     */

    public function prePersist()
    {
        if(empty($this->createdAt))
        {
            $this->createdAt = new \DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getRecette(): ?Recettes
    {
        return $this->recette;
    }

    public function setRecette(?Recettes $recette): self
    {
        $this->recette = $recette;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


}