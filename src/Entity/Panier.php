<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
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
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $transporteur;

    /**
     * @ORM\Column(type="float")
     */
    private $transporteurPrix;

    /**
     * @ORM\Column(type="text")
     */
    private $adresseLivraison;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPayed = false;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $information;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=DetailsPanier::class, mappedBy="Panier")
     */
    private $detailsPaniers;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Paniers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="float")
     */
    private $sousTotalHT;

    /**
     * @ORM\Column(type="float")
     */
    private $tva;

    /**
     * @ORM\Column(type="float")
     */
    private $sousTotalTTC;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $StripeCheckoutSession;

    public function __construct()
    {
        $this->detailsPaniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getNomUser(): ?string
    {
        return $this->nomUser;
    }

    public function setNomUser(string $nomUser): self
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    public function getTransporteur(): ?string
    {
        return $this->transporteur;
    }

    public function setTransporteur(string $transporteur): self
    {
        $this->transporteur = $transporteur;

        return $this;
    }

    public function getTransporteurPrix(): ?float
    {
        return $this->transporteurPrix;
    }

    public function setTransporteurPrix(float $transporteurPrix): self
    {
        $this->transporteurPrix = $transporteurPrix;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->adresseLivraison;
    }

    public function setAdresseLivraison(string $adresseLivraison): self
    {
        $this->adresseLivraison = $adresseLivraison;

        return $this;
    }

    public function isIsPayed(): ?bool
    {
        return $this->isPayed;
    }

    public function setIsPayed(bool $isPayed): self
    {
        $this->isPayed = $isPayed;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(?string $information): self
    {
        $this->information = $information;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, DetailsPanier>
     */
    public function getDetailsPaniers(): Collection
    {
        return $this->detailsPaniers;
    }

    public function addDetailsPanier(DetailsPanier $detailsPanier): self
    {
        if (!$this->detailsPaniers->contains($detailsPanier)) {
            $this->detailsPaniers[] = $detailsPanier;
            $detailsPanier->setPanier($this);
        }

        return $this;
    }

    public function removeDetailsPanier(DetailsPanier $detailsPanier): self
    {
        if ($this->detailsPaniers->removeElement($detailsPanier)) {
            // set the owning side to null (unless already changed)
            if ($detailsPanier->getPanier() === $this) {
                $detailsPanier->setPanier(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    public function getSousTotalHT(): ?float
    {
        return $this->sousTotalHT;
    }

    public function setSousTotalHT(float $sousTotalHT): self
    {
        $this->sousTotalHT = $sousTotalHT;

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

    public function getSousTotalTTC(): ?float
    {
        return $this->sousTotalTTC;
    }

    public function setSousTotalTTC(float $sousTotalTTC): self
    {
        $this->sousTotalTTC = $sousTotalTTC;

        return $this;
    }

    public function getStripeCheckoutSession(): ?string
    {
        return $this->StripeCheckoutSession;
    }

    public function setStripeCheckoutSession(?string $StripeCheckoutSession): self
    {
        $this->StripeCheckoutSession = $StripeCheckoutSession;

        return $this;
    }
}
