<?php

namespace App\Entity;

use App\Repository\SaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=SaisonRepository::class)
 */
class Saison
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numSaison;

    /**
     * @ORM\ManyToOne(targetEntity=Serie::class, inversedBy="saisons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $serie;

    /**
     * @ORM\OneToMany(targetEntity=Episode::class, mappedBy="saison", orphanRemoval=true)
     */
    private $episodes;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Gedmo\Slug(fields={"numSaison","anneeDeb","anneeFin"})
     */
    private $slugSaison;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $anneeDeb;

    /**
     * @ORM\Column(type="integer")
     */
    private $anneeFin;

    public function __construct()
    {
        $this->episodes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSaison(): ?int
    {
        return $this->numSaison;
    }

    public function setNumSaison(int $numSaison): self
    {
        $this->numSaison = $numSaison;

        return $this;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * @return Collection|Episode[]
     */
    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }

    public function addEpisode(Episode $episode): self
    {
        if (!$this->episodes->contains($episode)) {
            $this->episodes[] = $episode;
            $episode->setSaison($this);
        }

        return $this;
    }

    public function removeEpisode(Episode $episode): self
    {
        if ($this->episodes->contains($episode)) {
            $this->episodes->removeElement($episode);
            // set the owning side to null (unless already changed)
            if ($episode->getSaison() === $this) {
                $episode->setSaison(null);
            }
        }

        return $this;
    }

    public function getSlugSaison(): ?string
    {
        return $this->slugSaison;
    }

    public function setSlugSaison(string $slug): self
    {
        $this->slugSaison = $slug;

        return $this;
    }

    public function __toString(){
      return "Saison ". $this->numSaison;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAnneeDeb(): ?int
    {
        return $this->anneeDeb;
    }

    public function setAnneeDeb(int $anneeDeb): self
    {
        $this->anneeDeb = $anneeDeb;

        return $this;
    }

    public function getAnneeFin(): ?int
    {
        return $this->anneeFin;
    }

    public function setAnneeFin(int $anneeFin): self
    {
        $this->anneeFin = $anneeFin;

        return $this;
    }
}
