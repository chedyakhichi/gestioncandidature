<?php

namespace App\Entity;

use App\Repository\CandidatsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CandidatsRepository::class)]
class Candidats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"nom_cand is required")]
    private ?string $nom_cand = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"prenom_cand is required")]
    private ?string $prenom_cand = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"mail is required")]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"etat_cand is required")]
    private ?string $etat_cand = null;
    

    #[ORM\ManyToMany(targetEntity: Offres::class, mappedBy: 'Candidats')]
    private Collection $offres;

    public function __construct()
    {
        $this->offres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCand(): ?string
    {
        return $this->nom_cand;
    }

    public function setNomCand(string $nom_cand): self
    {
        $this->nom_cand = $nom_cand;

        return $this;
    }

    public function getPrenomCand(): ?string
    {
        return $this->prenom_cand;
    }

    public function setPrenomCand(string $prenom_cand): self
    {
        $this->prenom_cand = $prenom_cand;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getEtatCand(): ?string
    {
        return $this->etat_cand;
    }

    public function setEtatCand(string $etat_cand): self
    {
        $this->etat_cand = $etat_cand;

        return $this;
    }

    /**
     * @return Collection<int, Offres>
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offres $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres->add($offre);
            $offre->addCandidat($this);
        }

        return $this;
    }

    public function removeOffre(Offres $offre): self
    {
        if ($this->offres->removeElement($offre)) {
            $offre->removeCandidat($this);
        }

        return $this;
    }
}
