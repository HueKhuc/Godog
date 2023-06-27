<?php

namespace App\Entity;

use App\Repository\AdopterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdopterRepository::class)]
class Adopter extends User
{
    #[ORM\Column(length: 50, nullable: true)]
    /**
     * Summary of firstName.
     */
    private ?string $firstName = null;

    #[ORM\Column(length: 50, nullable: true)]
    /**
     * Summary of lastName.
     */
    private ?string $lastName = null;

    #[ORM\Column(length: 50, nullable: true)]
    /**
     * Summary of city.
     */
    private ?string $city = null;

    #[ORM\Column(length: 50, nullable: true)]
    /**
     * Summary of department.
     */
    private ?string $department = null;

    #[ORM\Column(length: 50, nullable: true)]
    /**
     * Summary of phone.
     */
    private ?string $phone = null;

    /**
     * @var Collection<int, Request>
     */
    #[ORM\OneToMany(mappedBy: 'adopter', targetEntity: Request::class)]
    private Collection $requests;

    /**
     * Summary of __construct.
     */
    public function __construct()
    {
        parent::__construct();
        $this->requests = new ArrayCollection();
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = parent::getRoles();
        $roles[] = 'ROLE_ADOPTER';

        return array_unique($roles);
    }

    /**
     * Summary of getFirstName.
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Summary of setFirstName.
     *
     * @return \App\Entity\Adopter
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Summary of getLastName.
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Summary of setLastName.
     *
     * @return \App\Entity\Adopter
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Summary of getCity.
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Summary of setCity.
     *
     * @return \App\Entity\Adopter
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Summary of getDepartment.
     */
    public function getDepartment(): ?string
    {
        return $this->department;
    }

    /**
     * Summary of setDepartment.
     *
     * @return \App\Entity\Adopter
     */
    public function setDepartment(string $department): self
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Summary of getPhone.
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Summary of setPhone.
     *
     * @return \App\Entity\Adopter
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, Request>
     */
    public function getRequests(): Collection
    {
        return $this->requests;
    }

    /**
     * Summary of addRequest.
     *
     * @param \App\Entity\Request $request
     *
     * @return \App\Entity\Adopter
     */
    public function addRequest(Request $request): self
    {
        if (!$this->requests->contains($request)) {
            $this->requests->add($request);
            $request->setAdopter($this);
        }

        return $this;
    }

    /**
     * Summary of removeRequest.
     *
     * @param \App\Entity\Request $request
     *
     * @return \App\Entity\Adopter
     */
    public function removeRequest(Request $request): self
    {
        if ($this->requests->removeElement($request)) {
            // set the owning side to null (unless already changed)
            if ($request->getAdopter() === $this) {
                $request->setAdopter(null);
            }
        }

        return $this;
    }

    public function hasAlreadyRequested(Announcement $announcement): bool
    {
        /** @var Request $request */
        foreach ($this->requests as $request) {
            if ($request->getAnnouncement()->getId() == $announcement->getId()) {
                return true;
            }
        }
        return false;
    }
}