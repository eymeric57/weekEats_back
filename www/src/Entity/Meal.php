<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MealRepository::class)]
#[ApiResource]
class Meal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?bool $isActive = true;

    #[ORM\ManyToOne(inversedBy: 'meals')]
    private ?User $utilisateur = null;

    /**
     * @var Collection<int, Planing>
     */
    #[ORM\ManyToMany(targetEntity: Planing::class, inversedBy: 'meals')]
    private Collection $planings;

    /**
     * @var Collection<int, MealIngredient>
     */
    #[ORM\OneToMany(targetEntity: MealIngredient::class, mappedBy: 'meal')]
    private Collection $mealIngredients;


    public function __construct()
    {
        $this->planings = new ArrayCollection();
        $this->mealIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
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
     * @return Collection<int, Planing>
     */
    public function getPlanings(): Collection
    {
        return $this->planings;
    }

    public function addPlaning(Planing $planing): static
    {
        if (!$this->planings->contains($planing)) {
            $this->planings->add($planing);
        }

        return $this;
    }

    public function removePlaning(Planing $planing): static
    {
        $this->planings->removeElement($planing);

        return $this;
    }

    /**
     * @return Collection<int, MealIngredient>
     */
    public function getMealIngredients(): Collection
    {
        return $this->mealIngredients;
    }
    public function __toString(): string
    {
        return $this->label ;
    }

   
}
