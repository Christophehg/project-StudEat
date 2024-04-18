<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity('username',message:"Ce Pseudo est déjà utilisé!")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    private $passwordHasher;

    public function __construct(UserPasswordHasher $passwordHasher){
        $this->passwordHasher = $passwordHasher;
    }
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]
    #[Assert\Length(min:5,max:50,minMessage:"Le Pseudo est trop court",maxMessage:"Le Pseudo est trop long")]
    private ?string $username = null;
    
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]
    // #[Assert\Length(min:6,max:25,minMessage:"Le mot de passe est trop court",maxMessage:"Le mot de passe est trop long")]
    private ?string $password = null;

    
    #[ORM\Column]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]
    #[Assert\Length(min:10,max:12,minMessage:"Le numéro est trop court",maxMessage:"Le numéro est trop long")]
    #[Assert\Regex(
        pattern: '/^[0-9]+$/i',
        htmlPattern: '^[0-9]+$',message:"Vous ne pouvez pas entre autres choses que des chiffres"
    )]
    private ?string $phone = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]
    private ?string $lastName = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]
    private ?string $firstName = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Ce champ ne peut pas être vide")]
    #[Assert\Email(message: 'L\'e-mail {{ value }} n\'est pas un e-mail valide.',)]
    private ?string $email = null;


    #[ORM\Column(nullable: true)]

    private ?bool $status_reservation = null;
    #[ORM\Column(nullable: true)]

    private ?int $idreservasion = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $this->passwordHasher->hashPassword($this, $password);

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of lastName
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */ 
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of firstName
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */ 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set the value of passwordHasher
     *
     * @return  self
     */ 
    public function setPasswordHasher($passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;

        return $this;
    }

    /**
     * Get the value of status_reservation
     */ 
    public function getStatus_reservation()
    {
        return $this->status_reservation;
    }

    /**
     * Set the value of status_reservation
     *
     * @return  self
     */ 
    public function setStatus_reservation($status_reservation)
    {
        $this->status_reservation = $status_reservation;

        return $this;
    }

    /**
     * Get the value of idreservasion
     */ 
    public function getIdreservasion()
    {
        return $this->idreservasion;
    }

    /**
     * Set the value of idreservasion
     *
     * @return  self
     */ 
    public function setIdreservasion($idreservasion)
    {
        $this->idreservasion = $idreservasion;

        return $this;
    }
}
