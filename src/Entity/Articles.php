<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 */
class Articles
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
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="e")
     */
    private $category_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $designation;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_url;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Scans", mappedBy="article_id", cascade={"persist"})
     */
    private $scans;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Marks", mappedBy="article_id", orphanRemoval=true)
     */
    private $marks;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    public function __construct()
    {
        $this->created_date = new \DateTime();
        $this->scans = new ArrayCollection();
        $this->marks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ? string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCategoryId(): ?Categories
    {
        return $this->category_id;
    }

    public function setCategoryId(?Categories $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): self
    {
        $this->image_url = $image_url;

        return $this;
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
            $scan->setArticleId($this);
        }

        return $this;
    }

    public function removeScan(Scans $scan): self
    {
        if ($this->scans->contains($scan)) {
            $this->scans->removeElement($scan);
            // set the owning side to null (unless already changed)
            if ($scan->getArticleId() === $this) {
                $scan->setArticleId(null);
            }
        }

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->created_date;
    }

    public function setCreatedDate(\DateTimeInterface $created_date): self
    {
        $this->created_date = $created_date;

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
            $mark->setArticleId($this);
        }

        return $this;
    }

    public function removeMark(Marks $mark): self
    {
        if ($this->marks->contains($mark)) {
            $this->marks->removeElement($mark);
            // set the owning side to null (unless already changed)
            if ($mark->getArticleId() === $this) {
                $mark->setArticleId(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->id . " - " . $this->designation;
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
}
