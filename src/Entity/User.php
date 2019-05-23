<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userfirstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="envoyer")
     */
    private $messages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Message", mappedBy="recevoir")
     */
    private $recevoirMessages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->recevoirMessages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUserfirstname(): ?string
    {
        return $this->userfirstname;
    }

    public function setUserfirstname(string $userfirstname): self
    {
        $this->userfirstname = $userfirstname;

        return $this;
    }

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setEnvoyer($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getEnvoyer() === $this) {
                $message->setEnvoyer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getRecevoirMessages(): Collection
    {
        return $this->recevoirMessages;
    }

    public function addRecevoirMessage(Message $recevoirMessage): self
    {
        if (!$this->recevoirMessages->contains($recevoirMessage)) {
            $this->recevoirMessages[] = $recevoirMessage;
            $recevoirMessage->addRecevoir($this);
        }

        return $this;
    }

    public function removeRecevoirMessage(Message $recevoirMessage): self
    {
        if ($this->recevoirMessages->contains($recevoirMessage)) {
            $this->recevoirMessages->removeElement($recevoirMessage);
            $recevoirMessage->removeRecevoir($this);
        }

        return $this;
    }
}
