<?php

namespace App\Entity;

use App\Repository\BreederRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BreederRepository::class)]
class Breeder extends User
{

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'breeder', targetEntity: announcement::class)]
    private Collection $announcements;

    public function __construct()
    {
        parent::__construct();
        $this->announcements = new ArrayCollection();
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = parent::getRoles();
        $roles[] = 'ROLE_BREEDER';

        return array_unique($roles);
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

    /**
     * @return Collection<int, announcement>
     */
    public function getannouncements(): Collection
    {
        return $this->announcements;
    }

    public function addannouncement(announcement $announcement): self
    {
        if (!$this->announcements->contains($announcement)) {
            $this->announcements->add($announcement);
            $announcement->setBreeder($this);
        }

        return $this;
    }

    public function removeannouncement(announcement $announcement): self
    {
        if ($this->announcements->removeElement($announcement)) {
            // set the owning side to null (unless already changed)
            if ($announcement->getBreeder() === $this) {
                $announcement->setBreeder(null);
            }
        }

        return $this;
    }
}