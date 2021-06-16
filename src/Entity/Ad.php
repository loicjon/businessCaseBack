<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AdRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"get"}},
 *     attributes={
 *     "order"={"adPostingDate": "DESC"}
 *     },
 *     itemOperations={
 *         "get"={
 *             "normalization_context"={"groups"={"get"}}
 *         },
 *
 *         "put"={
 *             "normalization_context"={"groups"={"put"}}
 *         },
 *         "delete"={
 *             "normalization_context"={"groups"={"delete"}}
 *         }
 *     }
 * )
 * @ApiResource(formats={"jsonld"})
 * @ORM\Entity(repositoryClass=AdRepository::class)
 * @ApiFilter(RangeFilter::class,
 *     properties= {
 *     "price",
 *     "mileage",
 *     "age"})
 * @ApiFilter(SearchFilter::class,
 *     properties= {
 *     "title": "ipartial",
 *     "brand" : "exact",
 *     "brand.brandName": "ipartial",
 *     "model" : "exact",
 *     "model.modelName": "ipartial",
 *     "fuel": "exact",
 *     "picture": "exact",
 *     "picture.pictureName": "ipartial",
 *     "picture.pictureLink": "ipartial"
 *     })
 */
class Ad
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get")
     */
    private $mileage;

    /**
     * @ORM\Column(type="date")
     * @Groups("get")
     */
    private $adPostingDate;

    /**
     * @ORM\Column(type="text")
     * @Groups("get")
     */
    private $generalDescription;

    /**
     * @ORM\Column(type="text")
     * @Groups("get")
     */
    private $feature;

    /**
     * @ORM\ManyToOne(targetEntity=Garage::class, inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $garage;

    /**
     * @ORM\ManyToOne(targetEntity=Picture::class, inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity=Model::class, inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity=Fuel::class, inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fuel;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getMileage(): ?string
    {
        return $this->mileage;
    }

    public function setMileage(string $mileage): self
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getAdPostingDate(): ?\DateTimeInterface
    {
        return $this->adPostingDate;
    }

    public function setAdPostingDate(\DateTimeInterface $adPostingDate): self
    {
        $this->adPostingDate = $adPostingDate;

        return $this;
    }

    public function getGeneralDescription(): ?string
    {
        return $this->generalDescription;
    }

    public function setGeneralDescription(string $generalDescription): self
    {
        $this->generalDescription = $generalDescription;

        return $this;
    }

    public function getFeature(): ?string
    {
        return $this->feature;
    }

    public function setFeature(string $feature): self
    {
        $this->feature = $feature;

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(?Picture $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getFuel(): ?Fuel
    {
        return $this->fuel;
    }

    public function setFuel(?Fuel $fuel): self
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }
}
