<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *     "get"={
 *      "access_control"="is_granted('ROLE_USER')",
 *      "normalization_context"={"groups"={"users_read"}}
 *     },
 *     "post"={
 *      "access_control"="is_granted('ROLE_USER')",
 *      "normalization_context"={"groups"={"users_read"}},
 *      "_context"={"groups"={"users_read"}}
 *      }
 *     },
 *     itemOperations={
 *         "get",
 *         "delete"
 *     },
 *     attributes={"pagination_enabled"=true})
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
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Distibutor", inversedBy="relation")
     * @Groups("users_read")
     */
    private $distibutor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
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

    public function getDistibutor()
    {
        return $this->distibutor;
    }

    public function setDistibutor(?Distibutor $distibutor): self
    {
        $this->distibutor = $distibutor;

        return $this;
    }
}
