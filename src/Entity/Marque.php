<?php

namespace App\Entity;

use App\Entity\Produit;
use App\Entity\Categorie;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=MarqueRepository::class)
 */
class Marque
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="marque")
     */
    private $produit;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, mappedBy="marques")
     */
    private $categories;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    public function __construct()
    {
        $this->produit = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

// ====================================================== //
// ===================== MAGIC FUNCTION ================= //
// ====================================================== //
public function __toString()
{
    return $this->nom;
}

    public function getId(): ?int
    {
        return $this->id;
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
            $produit->setMarque($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produit->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getMarque() === $this) {
                $produit->setMarque(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->categories->contains($categorie)) {
            $this->categories[] = $categorie;
            $categorie->addMarque($this);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): self
    {
        if ($this->categories->removeElement($categorie)) {
            $categorie->removeMarque($this);
        }

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

}
