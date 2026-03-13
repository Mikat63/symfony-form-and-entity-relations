<?php

namespace App\Entity;

use App\Repository\TrackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TrackRepository::class)]
class Track
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'Le titre doit avoir au moins 3 caractères',
        maxMessage: 'Le titre doit avoir 255 caractères max',
    )]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'tracks')]
    private ?Album $album = null;

    /**
     * @var Collection<int, Artist>
     */
    #[ORM\ManyToMany(targetEntity: Artist::class, inversedBy: 'tracks')]
    private Collection $artists;

    /**
     * @var Collection<int, Genre>
     */
    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'tracks')]
    private Collection $genres;

    public function __construct()
    {
     
        $this->artists = new ArrayCollection();
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): static
    {
        $this->album = $album;
        return $this;
    }


    /**
     * @return Collection<int, Artist>
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): static
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        $this->artists->removeElement($artist);

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->genres->removeElement($genre);

        return $this;
    }
}
