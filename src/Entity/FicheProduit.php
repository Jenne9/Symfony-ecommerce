<?php

namespace App\Entity;

use App\Repository\FicheProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=FicheProduitRepository::class)
 */
class FicheProduit
{
// ====================================================== //
// ===================== PROPRIETES ===================== //
// ====================================================== //
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $format;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pellicule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mesure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $autofocus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $iso;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $obturation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poids;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dimension;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $couleur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $flash;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $amplificateur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hautParleur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $equaliseur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $impedance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rendement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pavillon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filtre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vitesse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cellule;

    /**
     * @ORM\OneToOne(targetEntity=Produit::class, cascade={"persist", "remove"})
     */
    private $produit;

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getPellicule(): ?string
    {
        return $this->pellicule;
    }

    public function setPellicule(?string $pellicule): self
    {
        $this->pellicule = $pellicule;

        return $this;
    }

    public function getMesure(): ?string
    {
        return $this->mesure;
    }

    public function setMesure(?string $mesure): self
    {
        $this->mesure = $mesure;

        return $this;
    }

    public function getAutofocus(): ?string
    {
        return $this->autofocus;
    }

    public function setAutofocus(?string $autofocus): self
    {
        $this->autofocus = $autofocus;

        return $this;
    }

    public function getIso(): ?string
    {
        return $this->iso;
    }

    public function setIso(?string $iso): self
    {
        $this->iso = $iso;

        return $this;
    }

    public function getObturation(): ?string
    {
        return $this->obturation;
    }

    public function setObturation(?string $obturation): self
    {
        $this->obturation = $obturation;

        return $this;
    }

    public function getPoids(): ?string
    {
        return $this->poids;
    }

    public function setPoids(?string $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getDimension(): ?string
    {
        return $this->dimension;
    }

    public function setDimension(?string $dimension): self
    {
        $this->dimension = $dimension;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getFlash(): ?string
    {
        return $this->flash;
    }

    public function setFlash(?string $flash): self
    {
        $this->flash = $flash;

        return $this;
    }

    public function getAmplificateur(): ?string
    {
        return $this->amplificateur;
    }

    public function setAmplificateur(?string $amplificateur): self
    {
        $this->amplificateur = $amplificateur;

        return $this;
    }

    public function getHautParleur(): ?string
    {
        return $this->hautParleur;
    }

    public function setHautParleur(?string $hautParleur): self
    {
        $this->hautParleur = $hautParleur;

        return $this;
    }

    public function getEqualiseur(): ?string
    {
        return $this->equaliseur;
    }

    public function setEqualiseur(?string $equaliseur): self
    {
        $this->equaliseur = $equaliseur;

        return $this;
    }

    public function getImpedance(): ?string
    {
        return $this->impedance;
    }

    public function setImpedance(?string $impedance): self
    {
        $this->impedance = $impedance;

        return $this;
    }

    public function getRendement(): ?string
    {
        return $this->rendement;
    }

    public function setRendement(?string $rendement): self
    {
        $this->rendement = $rendement;

        return $this;
    }

    public function getPavillon(): ?string
    {
        return $this->pavillon;
    }

    public function setPavillon(?string $pavillon): self
    {
        $this->pavillon = $pavillon;

        return $this;
    }

    public function getFiltre(): ?string
    {
        return $this->filtre;
    }

    public function setFiltre(?string $filtre): self
    {
        $this->filtre = $filtre;

        return $this;
    }

    public function getVitesse(): ?string
    {
        return $this->vitesse;
    }

    public function setVitesse(?string $vitesse): self
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    public function getCellule(): ?string
    {
        return $this->cellule;
    }

    public function setCellule(?string $cellule): self
    {
        $this->cellule = $cellule;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
