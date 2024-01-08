<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Groups(['front'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $tagline = null;

    #[ORM\Column(length: 255)]
    private ?string $cover = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $releaseDate = null;

    #[ORM\Column]
    private ?int $tmdbId = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[Groups(['front'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $taglineFr = null;

    #[ORM\Column(length: 255)]
    private ?string $titleFr = null;

    #[ORM\OneToMany(mappedBy: 'movie', targetEntity: History::class)]
    private Collection $histories;

    #[ORM\Column]
    private ?bool $displayed = null;

    #[ORM\Column]
    private ?int $nbTimesSelected = null;

    #[ORM\Column(nullable: true)]
    private ?array $similarMovies = null;

    public function __construct()
    {
        $this->histories = new ArrayCollection();
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

    public function getTagline(): ?string
    {
        return $this->tagline;
    }

    public function setTagline(string $tagline): static
    {
        $this->tagline = $tagline;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): static
    {
        $this->cover = $cover;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getTmdbId(): ?int
    {
        return $this->tmdbId;
    }

    public function setTmdbId(int $tmdbId): static
    {
        $this->tmdbId = $tmdbId;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTaglineFr(): ?string
    {
        return $this->taglineFr;
    }

    public function setTaglineFr(string $taglineFr): static
    {
        $this->taglineFr = $taglineFr;

        return $this;
    }

    public function getTitleFr(): ?string
    {
        return $this->titleFr;
    }

    public function setTitleFr(string $titleFr): static
    {
        $this->titleFr = $titleFr;

        return $this;
    }

    /**
     * @return Collection<int, History>
     */
    public function getHistories(): Collection
    {
        return $this->histories;
    }

    public function addHistory(History $history): static
    {
        if (!$this->histories->contains($history)) {
            $this->histories->add($history);
            $history->setMovie($this);
        }

        return $this;
    }

    public function removeHistory(History $history): static
    {
        if ($this->histories->removeElement($history)) {
            // set the owning side to null (unless already changed)
            if ($history->getMovie() === $this) {
                $history->setMovie(null);
            }
        }

        return $this;
    }

    public function isDisplayed(): ?bool
    {
        return $this->displayed;
    }

    public function setDisplayed(bool $displayed): static
    {
        $this->displayed = $displayed;

        return $this;
    }

    public function getNbTimesSelected(): ?int
    {
        return $this->nbTimesSelected;
    }

    public function setNbTimesSelected(int $nbTimesSelected): static
    {
        $this->nbTimesSelected = $nbTimesSelected;

        return $this;
    }

    public function getSimilarMovies(): ?array
    {
        return $this->similarMovies;
    }

    public function setSimilarMovies(?array $similarMovies): static
    {
        $this->similarMovies = $similarMovies;

        return $this;
    }
}
