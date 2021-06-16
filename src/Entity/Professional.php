<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\ProfessionalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *        normalizationContext={"groups"={"get"}},
 *     itemOperations={
 *         "get"={
 *             "normalization_context"={"groups"={"get"}}
 *         },
 *         "put"={
 *             "normalization_context"={"groups"={"put"}}
 *         },
 *         "delete"={
 *             "normalization_context"={"groups"={"delete"}}
 *         }
 *     }
 * )
 * @ApiResource(formats={"jsonld"})
 * @ORM\Entity(repositoryClass=ProfessionalRepository::class)
 * @ApiFilter(SearchFilter::class,
 *     properties= {
 *     "corporateName": "ipartial",
 *     })
 */
class Professional
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("get")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get")
     */
    private $corporateName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get")
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get")
     */
    private $siretNumer;

    /**
     * @ORM\OneToMany(targetEntity=Garage::class, mappedBy="professional", orphanRemoval=true, fetch="EAGER")
     * @ApiSubresource()
     * @Groups("get")
     */
    private $garages;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="professionals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->garages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCorporateName(): ?string
    {
        return $this->corporateName;
    }

    public function setCorporateName(string $corporateName): self
    {
        $this->corporateName = $corporateName;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSiretNumer(): ?string
    {
        return $this->siretNumer;
    }

    public function setSiretNumer(string $siretNumer): self
    {
        $this->siretNumer = $siretNumer;

        return $this;
    }

    /**
     * @return Collection|Garage[]
     */
    public function getGarages(): Collection
    {
        return $this->garages;
    }

    public function addGarage(Garage $garage): self
    {
        if (!$this->garages->contains($garage)) {
            $this->garages[] = $garage;
            $garage->setProfessional($this);
        }

        return $this;
    }

    public function removeGarage(Garage $garage): self
    {
        if ($this->garages->removeElement($garage)) {
            // set the owning side to null (unless already changed)
            if ($garage->getProfessional() === $this) {
                $garage->setProfessional(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
