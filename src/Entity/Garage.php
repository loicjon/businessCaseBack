<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\GarageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"get"}},
 *     collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_ADMIN')"}},

 *     itemOperations={
 *         "get"={
 *             "normalization_context"={"groups"={"get"}},
 *             "roles: IS_AUTHENTICATED_FULLY",
 *             "security"="is_granted('ROLE_SUPERADMIN') or object.owner == user",
 *         },
 *         "put"={
 *             "normalization_context"={"groups"={"put"}},
 *             "security"="is_granted('ROLE_SUPERADMIN') or object.owner == user",
 *         },
 *         "delete"={
 *             "normalization_context"={"groups"={"delete"}},
 *             "security"="is_granted('ROLE_SUPERADMIN') or object.owner == user",
 *         }
 *     }
 * )
 * @ApiResource(formats={"jsonld"})
 * @ORM\Entity(repositoryClass=GarageRepository::class)
 * @ApiFilter(SearchFilter::class,
 *     properties= {
 *     "garageName": "ipartial",
 *     })
 */
class Garage
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
    private $garageName;

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
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get")
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get")
     */
    private $town;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity=Professional::class, inversedBy="garages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $professional;

    /**
     * @ORM\OneToMany(targetEntity=Ad::class, mappedBy="garage", orphanRemoval=true, fetch="EAGER")
     * @ApiSubresource()
     * @Groups("get")
     */
    private $ads;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGarageName(): ?string
    {
        return $this->garageName;
    }

    public function setGarageName(string $garageName): self
    {
        $this->garageName = $garageName;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getProfessional(): ?Professional
    {
        return $this->professional;
    }

    public function setProfessional(?Professional $professional): self
    {
        $this->professional = $professional;

        return $this;
    }

    /**
     * @return Collection|Ad[]
     */
    public function getAds(): Collection
    {
        return $this->ads;
    }

    public function addAd(Ad $ad): self
    {
        if (!$this->ads->contains($ad)) {
            $this->ads[] = $ad;
            $ad->setGarage($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ads->removeElement($ad)) {
            // set the owning side to null (unless already changed)
            if ($ad->getGarage() === $this) {
                $ad->setGarage(null);
            }
        }

        return $this;
    }
}
