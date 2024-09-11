<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    /**
     * @var Collection<int, Planing>
     */
    #[ORM\ManyToMany(targetEntity: Planing::class, mappedBy: 'types')]
    private Collection $planings;

    public function __construct()
    {
        $this->planings = new ArrayCollection();
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
            $planing->addType($this);
        }

        return $this;
    }

    public function removePlaning(Planing $planing): static
    {
        if ($this->planings->removeElement($planing)) {
            $planing->removeType($this);
        }

        return $this;
    }
}
