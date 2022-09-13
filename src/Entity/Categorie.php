<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Marque::class, inversedBy="categories")
     */
    private $marques;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="categorie")
     */
    private $produit;
// ====================================================== //
// ===================== CONSTRUCTEUR =================== //
// ====================================================== //
    public function __construct()
    {
        $this->marques = new ArrayCollection();
        $this->produits = new ArrayCollection();
    }
// ====================================================== //
// ===================== MAGIC FUNCTION ================= //
// ====================================================== //
    public function __toString()
    {
        return $this->nom;
    }
// ====================================================== //
// ===================== GETTER-SETTER ================== //
// ====================================================== //
    public function getId(): ?int
    {
        return $this->id;
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



    /**
     * @return Collection<int, Marque>
     */
    public function getMarques(): Collection
    {
        return $this->marques;
    }

    public function addMarque(Marque $marque): self
    {
        if (!$this->marques->contains($marque)) {
            $this->marques[] = $marque;
        }

        return $this;
    }

    public function removeMarque(Marque $marque): self
    {
        $this->marques->removeElement($marque);

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
            $produit->setCategorie($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produit->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getCategorie() === $this) {
                $produit->setCategorie(null);
            }
        }

        return $this;
    }


}
