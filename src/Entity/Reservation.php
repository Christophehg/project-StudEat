<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[Vich\Uploadable]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]

    private ?string $Title = null;

    #[Vich\UploadableField(mapping: 'reservation_images', fileNameProperty: 'imageName')]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]
    #[Assert\File(extensions: ['png','jpg'],extensionsMessage: 'Merci upload que des fichiers .png ou .jpg')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]
    #[Assert\PositiveOrZero(message:'Vous ne pouvez pas mettre de nombre négatif')]


    private ?int $Slots = null;

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

    private ?string $Zipcode = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]

    private ?string $City = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]

    private ?string $Description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]

    private ?string $Ingredient = null;

    #[ORM\Column(nullable: true)]
    private ?bool $status = false;

    #[ORM\Column(nullable: true)]
    private ?int $Takedslots = 0;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getSlots(): ?int
    {
        return $this->Slots;
    }

    public function setSlots(int $Slots): self
    {
        $this->Slots = $Slots;

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

    public function getZipcode(): ?string
    {
        return $this->Zipcode;
    }

    public function setZipcode(string $Zipcode): self
    {
        $this->Zipcode = $Zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getIngredient(): ?string
    {
        return $this->Ingredient;
    }

    public function setIngredient(string $Ingredient): self
    {
        $this->Ingredient = $Ingredient;

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
     * Get the value of Takedslots
     */ 
    public function getTakedslots()
    {
        return $this->Takedslots;
    }

    /**
     * Set the value of Takedslots
     *
     * @return  self
     */ 
    public function setTakedslots($Takedslots)
    {
        $this->Takedslots = $Takedslots;

        return $this;
    }
}
