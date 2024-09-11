<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
#[ApiResource]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\ManyToOne(inversedBy: 'ingredients')]
    private ?Category $category = null;

    /**
     * @var Collection<int, MealIngredient>
     */
    #[ORM\OneToMany(targetEntity: MealIngredient::class, mappedBy: 'ingredient')]
    private Collection $mealIngredients;

    public function __construct()
    {
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, MealIngredient>
     */
    public function getMealIngredients(): Collection
    {
        return $this->mealIngredients;
    }

    public function addMealIngredient(MealIngredient $mealIngredient): static
    {
        if (!$this->mealIngredients->contains($mealIngredient)) {
            $this->mealIngredients->add($mealIngredient);
            $mealIngredient->setIngredient($this);
        }

        return $this;
    }

    public function removeMealIngredient(MealIngredient $mealIngredient): static
    {
        if ($this->mealIngredients->removeElement($mealIngredient)) {
            // set the owning side to null (unless already changed)
            if ($mealIngredient->getIngredient() === $this) {
                $mealIngredient->setIngredient(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->label ;
    }


}
