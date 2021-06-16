<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\FuelRepository;
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
 * @ORM\Entity(repositoryClass=FuelRepository::class)
 * @ApiFilter(SearchFilter::class,
 *     properties= {
 *     "type": "ipartial",
 *     })
 */
class Fuel
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
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Ad::class, mappedBy="fuel", orphanRemoval=true, fetch="EAGER")
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
            $ad->setFuel($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ads->removeElement($ad)) {
            // set the owning side to null (unless already changed)
            if ($ad->getFuel() === $this) {
                $ad->setFuel(null);
            }
        }

        return $this;
    }
}
