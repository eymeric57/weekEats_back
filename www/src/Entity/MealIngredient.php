<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MealIngredientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MealIngredientRepository::class)]
#[ApiResource]
class MealIngredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'mealIngredients')]
    private ?Meal $meal = null;

    #[ORM\ManyToOne(inversedBy: 'mealIngredients')]
    private ?IngredientMeasurements $ingredientMeasurement = null;

    #[ORM\ManyToOne(inversedBy: 'mealIngredients')]
    private ?Ingredient $ingredient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getMeal(): ?Meal
    {
        return $this->meal;
    }

    public function setMeal(?Meal $meal): static
    {
        $this->meal = $meal;
        return $this;
    }

    public function getIngredientMeasurement(): ?IngredientMeasurements
    {
        return $this->ingredientMeasurement;
    }

    public function setIngredientMeasurement(?IngredientMeasurements $ingredientMeasurement): static
    {
        $this->ingredientMeasurement = $ingredientMeasurement;
        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): static
    {
        $this->ingredient = $ingredient;
        return $this;
    }
    public function __toString(): string
    {
        return $this->quantity ;
    }
}