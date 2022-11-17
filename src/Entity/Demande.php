<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
class Demande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]

    private ?string $etat_cand = null;

    public function getId(): ?int
    {
        return $this->id;
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
}
