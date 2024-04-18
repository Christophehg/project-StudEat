<?php

namespace App\Entity;

use App\Repository\TopdealRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Mime\Message;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: TopdealRepository::class)]
#[Vich\Uploadable]
class Topdeal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]
    private ?string $brandName = null;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.

    #[Vich\UploadableField(mapping: 'bonplan_images', fileNameProperty: 'imageName')]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]
    #[Assert\File(extensions: ['png','jpg'],extensionsMessage: 'Merci upload que des fichiers .png ou .jpg')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]
    private ?string $productName = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]

    private ?string $description = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]

    private ?string $adress = null;

    #[ORM\Column(length: 5)]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]
    #[Assert\Regex(
        pattern: '/^[0-9]+$/i',
        htmlPattern: '^[0-9]+$',message:"Vous ne pouvez pas entre autres choses que des chiffres"
    )]
    #[Assert\Length(max:5,maxMessage:"Vous ne pouvez pas mettre plus de 5 chiffres.")]

    private ?string $zipCode = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]

    private ?string $city = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]

    private ?string $storeName = null;
    
    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]
    #[Assert\Regex(
        pattern: '/^[0-9]+[.]+[0-9]+|[0-9]+$/i',
        htmlPattern: '^[0-9]+[.]+[0-9]+|[0-9]+$',message:"Vous ne pouvez pas entre autres choses que des chiffres"
    )]

    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?bool $status = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrandName(): ?string
    {
        return $this->brandName;
    }

    public function setBrandName(string $brandName): self
    {
        $this->brandName = $brandName;

        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStoreName(): ?string
    {
        return $this->storeName;
    }

    public function setStoreName(string $storeName): self
    {
        $this->storeName = $storeName;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
}
