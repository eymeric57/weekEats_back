<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ListeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeRepository::class)]
#[ApiResource]
class Liste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'listes')]
    private ?User $utilisateur = null;

    /**
     * @var Collection<int, ShoppingItem>
     */
    #[ORM\OneToMany(targetEntity: ShoppingItem::class, mappedBy: 'liste')]
    private Collection $shoppingItems;

    public function __construct()
    {
        $this->shoppingItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, ShoppingItem>
     */
    public function getShoppingItems(): Collection
    {
        return $this->shoppingItems;
    }

    public function addShoppingItem(ShoppingItem $shoppingItem): static
    {
        if (!$this->shoppingItems->contains($shoppingItem)) {
            $this->shoppingItems->add($shoppingItem);
            $shoppingItem->setListe($this);
        }

        return $this;
    }

    public function removeShoppingItem(ShoppingItem $shoppingItem): static
    {
        if ($this->shoppingItems->removeElement($shoppingItem)) {
            // set the owning side to null (unless already changed)
            if ($shoppingItem->getListe() === $this) {
                $shoppingItem->setListe(null);
            }
        }

        return $this;
    }
}
