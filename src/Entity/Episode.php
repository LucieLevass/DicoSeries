<?php

namespace App\Entity;

use App\Repository\EpisodeRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=EpisodeRepository::class)
 */
class Episode
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
    private $numEpisode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreVF;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreVO;

    /**
     * @ORM\ManyToOne(targetEntity=Saison::class, inversedBy="episodes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $saison;

    /**
     * @ORM\ManyToOne(targetEntity=Serie::class, inversedBy="episodes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $serie;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Gedmo\Slug(fields={"titreVF"})
     */
    private $slugEpisode;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resume;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDiffVO;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDiffVF;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumEpisode(): ?int
    {
        return $this->numEpisode;
    }

    public function setNumEpisode(int $numEpisode): self
    {
        $this->numEpisode = $numEpisode;

        return $this;
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

    public function getSaison(): ?Saison
    {
        return $this->saison;
    }

    public function setSaison(?Saison $saison): self
    {
        $this->saison = $saison;

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

    public function getSlugEpisode(): ?string
    {
        return $this->slugEpisode;
    }

    public function setSlugEpisode(string $slug): self
    {
        $this->slugEpisode = $slug;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getDateDiffVO(): ?\DateTimeInterface
    {
        return $this->dateDiffVO;
    }

    public function setDateDiffVO(/*\DateTimeInterface*/ $dateDiffVO): self
    {
        $this->dateDiffVO = $dateDiffVO;

        return $this;
    }

    public function getDateDiffVF(): ?\DateTimeInterface
    {
        return $this->dateDiffVF;
    }

    public function setDateDiffVF(?\DateTimeInterface $dateDiffVF): self
    {
        $this->dateDiffVF = $dateDiffVF;

        return $this;
    }
}
