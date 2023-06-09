<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\DogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: DogRepository::class)]
#[Vich\Uploadable]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
    ]
)]
class Dog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $background = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isTolerant = null;

    #[ORM\Column]
    private ?bool $isLof = null;

    #[ORM\ManyToMany(targetEntity: Request::class, inversedBy: 'dogs')]
    private Collection $requests;

    #[ORM\OneToMany(mappedBy: 'dog', targetEntity: Picture::class, cascade: ['persist', 'remove'])]
    private Collection $pictures;

    #[ORM\ManyToMany(targetEntity: Race::class, mappedBy: 'dogs')]
    private Collection $races;

    #[ORM\ManyToOne(inversedBy: 'dogs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Announcement $announcement = null;

    #[ORM\Column]
    private ?bool $isAdopted = null;

    public function __construct()
    {
        $this->requests = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->races = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(string $background): self
    {
        $this->background = $background;

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

    public function getIsTolerant(): ?bool
    {
        return $this->isTolerant;
    }

    public function setIsTolerant(bool $isTolerant): self
    {
        $this->isTolerant = $isTolerant;

        return $this;
    }

    public function getIsLof(): ?bool
    {
        return $this->isLof;
    }

    public function setIsLof(bool $isLof): self
    {
        $this->isLof = $isLof;

        return $this;
    }

    /**
     * @return Collection<int, Request>
     */
    public function getRequests(): Collection
    {
        return $this->requests;
    }

    public function addRequest(Request $request): self
    {
        if (!$this->requests->contains($request)) {
            $this->requests->add($request);
        }

        return $this;
    }

    public function removeRequest(Request $request): self
    {
        $this->requests->removeElement($request);

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setDog($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getDog() === $this) {
                $picture->setDog(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Race>
     */
    public function getRaces(): Collection
    {
        return $this->races;
    }

    public function addRace(Race $race): self
    {
        if (!$this->races->contains($race)) {
            $this->races->add($race);
            $race->addDog($this);
        }

        return $this;
    }

    public function removeRace(Race $race): self
    {
        if ($this->races->removeElement($race)) {
            $race->removeDog($this);
        }

        return $this;
    }

    public function getAnnouncement(): ?Announcement
    {
        return $this->announcement;
    }

    public function setAnnouncement(?Announcement $announcement): self
    {
        $this->announcement = $announcement;

        return $this;
    }

    public function getIsAdopted(): ?bool
    {
        return $this->isAdopted;
    }

    public function setIsAdopted(bool $isAdopted): self
    {
        $this->isAdopted = $isAdopted;

        return $this;
    }
}
