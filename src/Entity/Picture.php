<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\PictureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"get"}},
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
 * @ORM\Entity(repositoryClass=PictureRepository::class)
 * @ApiFilter(SearchFilter::class,
 *     properties= {
 *     "pictureName": "ipartial",
 *     })
 */
class Picture
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
    private $pictureName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get")
     */
    private $pictureLink;

    /**
     * @ORM\OneToMany(targetEntity=Ad::class, mappedBy="picture", orphanRemoval=true, fetch="EAGER")
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

    public function getPictureName(): ?string
    {
        return $this->pictureName;
    }

    public function setPictureName(string $pictureName): self
    {
        $this->pictureName = $pictureName;

        return $this;
    }

    public function getPictureLink(): ?string
    {
        return $this->pictureLink;
    }

    public function setPictureLink(string $pictureLink): self
    {
        $this->pictureLink = $pictureLink;

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
            $ad->setPicture($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ads->removeElement($ad)) {
            // set the owning side to null (unless already changed)
            if ($ad->getPicture() === $this) {
                $ad->setPicture(null);
            }
        }

        return $this;
    }
}
