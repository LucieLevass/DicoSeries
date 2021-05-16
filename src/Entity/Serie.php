<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=SerieRepository::class)
 */
class Serie
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
    private $titreVF;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreVO;

    /**
     * @ORM\OneToMany(targetEntity=Saison::class, mappedBy="serie", orphanRemoval=true)
     */
    private $saisons;

    /**
     * @ORM\OneToMany(targetEntity=Episode::class, mappedBy="serie", orphanRemoval=true)
     */
    private $episodes;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Gedmo\Slug(fields={"titreVF"})
     */
    private $slugSerie;

    /**
     * @ORM\Column(type="integer")
     */
    private $anneeDeb;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $anneeFin;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="series")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="series")
     */
    private $pays;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="series")
     */
    private $genres;

    public function __construct()
    {
        $this->saisons = new ArrayCollection();
        $this->episodes = new ArrayCollection();
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreVF(): ?string
    {
        return $this->titreVF;
    }

    public function setTitreVF(string $titreVF): self
    {
        $this->titreVF = $titreVF;

        return $this;
    }

    public function getTitreVO(): ?string
    {
        return $this->titreVO;
    }

    public function setTitreVO(string $titreVO): self
    {
        $this->titreVO = $titreVO;

        return $this;
    }

    /**
     * @return Collection|Saison[]
     */
    public function getSaisons(): Collection
    {
        return $this->saisons;
    }

    public function addSaison(Saison $saison): self
    {
        if (!$this->saisons->contains($saison)) {
            $this->saisons[] = $saison;
            $saison->setSerie($this);
        }

        return $this;
    }

    public function removeSaison(Saison $saison): self
    {
        if ($this->saisons->contains($saison)) {
            $this->saisons->removeElement($saison);
            // set the owning side to null (unless already changed)
            if ($saison->getSerie() === $this) {
                $saison->setSerie(null);
            }
        }

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
            $episode->setSerie($this);
        }

        return $this;
    }

    public function removeEpisode(Episode $episode): self
    {
        if ($this->episodes->contains($episode)) {
            $this->episodes->removeElement($episode);
            // set the owning side to null (unless already changed)
            if ($episode->getSerie() === $this) {
                $episode->setSerie(null);
            }
        }

        return $this;
    }

    public function getSlugSerie(): ?string
    {
        return $this->slugSerie;
    }

    public function setSlugSerie(string $slug): self
    {
        $this->slugSerie = $slug;

        return $this;
    }

    public function __toString(){
      return $this->titreVF;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->genres->contains($genre)) {
            $this->genres->removeElement($genre);
        }

        return $this;
    }
}
