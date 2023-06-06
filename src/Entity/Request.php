<?php

namespace App\Entity;

use App\Repository\RequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RequestRepository::class)]
class Request
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Adopter::class, mappedBy: 'requests')]
    private Collection $adopters;

    #[ORM\OneToMany(mappedBy: 'request', targetEntity: Message::class)]
    private Collection $messages;

    #[ORM\ManyToOne(inversedBy: 'requests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Anoucement $annoucement = null;

    #[ORM\ManyToMany(targetEntity: Dog::class, mappedBy: 'requests')]
    private Collection $dogs;

    public function __construct()
    {
        $this->adopters = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->dogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Adopter>
     */
    public function getAdopters(): Collection
    {
        return $this->adopters;
    }

    public function addAdopter(Adopter $adopter): self
    {
        if (!$this->adopters->contains($adopter)) {
            $this->adopters->add($adopter);
            $adopter->addRequest($this);
        }

        return $this;
    }

    public function removeAdopter(Adopter $adopter): self
    {
        if ($this->adopters->removeElement($adopter)) {
            $adopter->removeRequest($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setRequest($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getRequest() === $this) {
                $message->setRequest(null);
            }
        }

        return $this;
    }

    public function getAnnoucement(): ?Anoucement
    {
        return $this->annoucement;
    }

    public function setAnnoucement(?Anoucement $annoucement): self
    {
        $this->annoucement = $annoucement;

        return $this;
    }

    /**
     * @return Collection<int, Dog>
     */
    public function getDogs(): Collection
    {
        return $this->dogs;
    }

    public function addDog(Dog $dog): self
    {
        if (!$this->dogs->contains($dog)) {
            $this->dogs->add($dog);
            $dog->addRequest($this);
        }

        return $this;
    }

    public function removeDog(Dog $dog): self
    {
        if ($this->dogs->removeElement($dog)) {
            $dog->removeRequest($this);
        }

        return $this;
    }
}
