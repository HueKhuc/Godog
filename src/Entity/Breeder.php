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

    #[ORM\OneToMany(mappedBy: 'breeder', targetEntity: Anoucement::class)]
    private Collection $annoucements;

    public function __construct()
    {
        parent::__construct();
        $this->annoucements = new ArrayCollection();
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
     * @return Collection<int, Anoucement>
     */
    public function getAnnoucements(): Collection
    {
        return $this->annoucements;
    }

    public function addAnnoucement(Anoucement $annoucement): self
    {
        if (!$this->annoucements->contains($annoucement)) {
            $this->annoucements->add($annoucement);
            $annoucement->setBreeder($this);
        }

        return $this;
    }

    public function removeAnnoucement(Anoucement $annoucement): self
    {
        if ($this->annoucements->removeElement($annoucement)) {
            // set the owning side to null (unless already changed)
            if ($annoucement->getBreeder() === $this) {
                $annoucement->setBreeder(null);
            }
        }

        return $this;
    }
}