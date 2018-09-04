<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RatersRepository")
 */
class Raters
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Marks", mappedBy="rater_id")
     */
    private $marks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Scans", mappedBy="raters_id")
     */
    private $scans;


    public function __construct()
    {
        $this->a = new ArrayCollection();
        $this->marks = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->scans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection|Marks[]
     */
    public function getMarks(): Collection
    {
        return $this->marks;
    }

    public function addMark(Marks $mark): self
    {
        if (!$this->marks->contains($mark)) {
            $this->marks[] = $mark;
            $mark->setRaterId($this);
        }

        return $this;
    }

    public function removeMark(Marks $mark): self
    {
        if ($this->marks->contains($mark)) {
            $this->marks->removeElement($mark);
            // set the owning side to null (unless already changed)
            if ($mark->getRaterId() === $this) {
                $mark->setRaterId(null);
            }
        }
    }

    /**
     * @return Collection|Scans[]
     */
    public function getScans(): Collection
    {
        return $this->scans;
    }

    public function addScan(Scans $scan): self
    {
        if (!$this->scans->contains($scan)) {
            $this->scans[] = $scan;
            $scan->setRatersId($this);
        }

        return $this;
    }

    public function removeScan(Scans $scan): self
    {
        if ($this->scans->contains($scan)) {
            $this->scans->removeElement($scan);
            // set the owning side to null (unless already changed)
            if ($scan->getRatersId() === $this) {
                $scan->setRatersId(null);
            }
        }

        return $this;
    }

    public function __toString() {
            return $this->id . " - " . $this->firstname . " " . $this->lastname;
    }

}
