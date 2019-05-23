<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
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
    private $sujet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $corps;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="messages")
     */
    private $envoyer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="recevoirMessages")
     */
    private $recevoir;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Message", inversedBy="repondreMessage")
     */
    private $repond;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="repond")
     */
    private $repondreMessage;

    public function __construct()
    {
        $this->recevoir = new ArrayCollection();
        $this->repondreMessage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getCorps(): ?string
    {
        return $this->corps;
    }

    public function setCorps(string $corps): self
    {
        $this->corps = $corps;

        return $this;
    }

    public function getEnvoyer(): ?User
    {
        return $this->envoyer;
    }

    public function setEnvoyer(?User $envoyer): self
    {
        $this->envoyer = $envoyer;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getRecevoir(): Collection
    {
        return $this->recevoir;
    }

    public function addRecevoir(User $recevoir): self
    {
        if (!$this->recevoir->contains($recevoir)) {
            $this->recevoir[] = $recevoir;
        }

        return $this;
    }

    public function removeRecevoir(User $recevoir): self
    {
        if ($this->recevoir->contains($recevoir)) {
            $this->recevoir->removeElement($recevoir);
        }

        return $this;
    }

    public function getRepond(): ?self
    {
        return $this->repond;
    }

    public function setRepond(?self $repond): self
    {
        $this->repond = $repond;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getRepondreMessage(): Collection
    {
        return $this->repondreMessage;
    }

    public function addRepondreMessage(self $repondreMessage): self
    {
        if (!$this->repondreMessage->contains($repondreMessage)) {
            $this->repondreMessage[] = $repondreMessage;
            $repondreMessage->setRepond($this);
        }

        return $this;
    }

    public function removeRepondreMessage(self $repondreMessage): self
    {
        if ($this->repondreMessage->contains($repondreMessage)) {
            $this->repondreMessage->removeElement($repondreMessage);
            // set the owning side to null (unless already changed)
            if ($repondreMessage->getRepond() === $this) {
                $repondreMessage->setRepond(null);
            }
        }

        return $this;
    }
}
