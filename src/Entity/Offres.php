<?php

namespace App\Entity;

use App\Repository\OffresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OffresRepository::class)]
class Offres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique :true)]
    #[Assert\NotBlank(message:"titre is required")]
    private ?string $titre = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"description is required")]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"date_offre is required")]
    private ?string $date_offre = null;

    #[ORM\ManyToMany(targetEntity: Candidats::class, inversedBy: 'offres')]
    private Collection $Candidats;

    public function __construct()
    {
        $this->Candidats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateOffre(): ?string
    {
        return $this->date_offre;
    }

    public function setDateOffre(string $date_offre): self
    {
        $this->date_offre = $date_offre;

        return $this;
    }

    /**
     * @return Collection<int, Candidats>
     */
    public function getCandidats(): Collection
    {
        return $this->Candidats;
    }

    public function addCandidat(Candidats $candidat): self
    {
        if (!$this->Candidats->contains($candidat)) {
            $this->Candidats->add($candidat);
        }

        return $this;
    }

    public function removeCandidat(Candidats $candidat): self
    {
        $this->Candidats->removeElement($candidat);

        return $this;
    }
}
