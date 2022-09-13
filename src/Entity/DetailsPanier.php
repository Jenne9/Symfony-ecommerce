<?php

namespace App\Entity;

use App\Repository\DetailsPanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailsPanierRepository::class)
 */
class DetailsPanier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomProduit;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTotalHt;

    /**
     * @ORM\Column(type="float")
     */
    private $tva;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTotalTtc;


    /**
     * @ORM\ManyToOne(targetEntity=Panier::class, inversedBy="detailsPaniers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Panier;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): self
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixTotalHt(): ?float
    {
        return $this->prixTotalHt;
    }

    public function setPrixTotalHt(float $prixTotalHt): self
    {
        $this->prixTotalHt = $prixTotalHt;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(float $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getPrixTotalTtc(): ?float
    {
        return $this->prixTotalTtc;
    }

    public function setPrixTotalTtc(float $prixTotalTtc): self
    {
        $this->prixTotalTtc = $prixTotalTtc;

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->Panier;
    }

    public function setPanier(?Panier $Panier): self
    {
        $this->Panier = $Panier;

        return $this;
    }

    /**
     * Get the value of isPayed
     */ 
    public function getIsPayed()
    {
        return $this->isPayed;
    }

    /**
     * Set the value of isPayed
     *
     * @return  self
     */ 
    public function setIsPayed($isPayed)
    {
        $this->isPayed = $isPayed;

        return $this;
    }
}
