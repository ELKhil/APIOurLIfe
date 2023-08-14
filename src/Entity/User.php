<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[ORM\Column(type: 'string', length: 180)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 180)]
    private $lastname;


    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string' )]
    private $imageProfil;

    #[ORM\Column(type: 'integer' )]
    private $stars;

    #[ORM\Column(type:'string', length:100)]
    private $resetToken='';

    /**
     * @return string
     */
    public function getResetToken(): string
    {
        return $this->resetToken;
    }

    /**
     * @param string $resetToken
     * @return User
     */
    public function setResetToken(string $resetToken): User
    {
        $this->resetToken = $resetToken;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    #[ORM\Column(type: 'boolean')]
    private $active;



    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Commentaire::class)]
    private $commentaires;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Post::class)]
    private $posts;

    #[ORM\OneToMany(mappedBy: 'sentFrom', targetEntity: Message::class)]
    private Collection $messageSent;

    #[ORM\OneToMany(mappedBy: 'sentTo', targetEntity: Message::class)]
    private Collection $messagesReceived;

    #[ORM\ManyToOne(targetEntity: SchollBranch::class,inversedBy: 'students')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SchollBranch $SchoolBranch = null;





    public function __construct()
    {

        $this->commentaires = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->messageSent = new ArrayCollection();
        $this->messagesReceived = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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
        $this->password = $password;

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
     * @return mixed
     */
    public function getImageProfil()
    {
        return $this->imageProfil;
    }

    /**
     * @param mixed $imageProfil
     * @return User
     */
    public function setImageProfil($imageProfil)
    {
        $this->imageProfil = $imageProfil;
        return $this;
    }

    /**
     * @return mixed
     */

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setUser($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getUser() === $this) {
                $commentaire->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setUser($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * @param mixed $stars
     * @return User
     */
    public function setStars($stars)
    {
        $this->stars = $stars;
        return $this;
    }
    public function getFullName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessageSent(): Collection
    {
        return $this->messageSent;
    }

    public function addMessageSent(Message $messageSent): static
    {
        if (!$this->messageSent->contains($messageSent)) {
            $this->messageSent->add($messageSent);
            $messageSent->setSentFrom($this);
        }

        return $this;
    }

    public function removeMessageSent(Message $messageSent): static
    {
        if ($this->messageSent->removeElement($messageSent)) {
            // set the owning side to null (unless already changed)
            if ($messageSent->getSentFrom() === $this) {
                $messageSent->setSentFrom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessagesReceived(): Collection
    {
        return $this->messagesReceived;
    }

    public function addMessagesReceived(Message $messagesReceived): static
    {
        if (!$this->messagesReceived->contains($messagesReceived)) {
            $this->messagesReceived->add($messagesReceived);
            $messagesReceived->setSentTo($this);
        }

        return $this;
    }

    public function removeMessagesReceived(Message $messagesReceived): static
    {
        if ($this->messagesReceived->removeElement($messagesReceived)) {
            // set the owning side to null (unless already changed)
            if ($messagesReceived->getSentTo() === $this) {
                $messagesReceived->setSentTo(null);
            }
        }

        return $this;
    }

    public function getSchoolBranch(): ?SchollBranch
    {
        return $this->SchoolBranch;
    }

    public function setSchoolBranch(?SchollBranch $SchoolBranch): static
    {
        $this->SchoolBranch = $SchoolBranch;

        return $this;
    }


}
