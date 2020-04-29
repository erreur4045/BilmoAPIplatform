<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpecsRepository")
 */
class Specs
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
    private $screenSize;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ram;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $battery;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photoSensor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $dualSim;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Phones", mappedBy="specs")
     */
    private $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScreenSize(): ?string
    {
        return $this->screenSize;
    }

    public function setScreenSize(string $screenSize): self
    {
        $this->screenSize = $screenSize;

        return $this;
    }

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(string $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getBattery(): ?string
    {
        return $this->battery;
    }

    public function setBattery(string $battery): self
    {
        $this->battery = $battery;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getPhotoSensor(): ?string
    {
        return $this->photoSensor;
    }

    public function setPhotoSensor(string $photoSensor): self
    {
        $this->photoSensor = $photoSensor;

        return $this;
    }

    public function getDualSim(): ?bool
    {
        return $this->dualSim;
    }

    public function setDualSim(bool $dualSim): self
    {
        $this->dualSim = $dualSim;

        return $this;
    }

    /**
     * @return Collection|Phones[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Phones $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
            $relation->setSpecs($this);
        }

        return $this;
    }

    public function removeRelation(Phones $relation): self
    {
        if ($this->relation->contains($relation)) {
            $this->relation->removeElement($relation);
            // set the owning side to null (unless already changed)
            if ($relation->getSpecs() === $this) {
                $relation->setSpecs(null);
            }
        }

        return $this;
    }
}
