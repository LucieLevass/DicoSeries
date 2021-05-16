<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusRepository::class)
 */
class Status
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomStatus;

    /**
     * @ORM\OneToMany(targetEntity=Serie::class, mappedBy="status")
     */
    private $series;

    public function __construct()
    {
        $this->series = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStatus(): ?string
    {
        return $this->nomStatus;
    }

    public function setNomStatus(string $nomStatus): self
    {
        $this->nomStatus = $nomStatus;

        return $this;
    }

    /**
     * @return Collection|Serie[]
     */
    public function getSeries(): Collection
    {
        return $this->series;
    }

    public function addSeries(Serie $series): self
    {
        if (!$this->series->contains($series)) {
            $this->series[] = $series;
            $series->setStatus($this);
        }

        return $this;
    }

    public function removeSeries(Serie $series): self
    {
        if ($this->series->contains($series)) {
            $this->series->removeElement($series);
            // set the owning side to null (unless already changed)
            if ($series->getStatus() === $this) {
                $series->setStatus(null);
            }
        }

        return $this;
    }

    public function __toString(){
      return $this->nomStatus;
    }
}
