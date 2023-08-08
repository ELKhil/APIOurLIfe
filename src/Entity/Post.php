<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', nullable: true)]
    private $media;

    #[ORM\Column(type: 'string', nullable: true)]
    private $typemedia;

    #[ORM\Column(type: 'text', nullable: true)]
    private $contenu;

    #[ORM\Column(type: 'integer', name: 'like_commentaire')]
    private $like;

    #[ORM\Column(type: 'integer')]
    private $dislike;

    #[ORM\Column(type: 'boolean')]
    private $active ;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Commentaire::class)]
    private $commentaires;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;



    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }



    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Post
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param mixed $media
     * @return Post
     */
    public function setMedia($media)
    {
        $this->media = $media;
        return $this;
    }




    /**
     * @return mixed
     */
    public function getTypemedia()
    {
        return $this->typemedia;
    }

    /**
     * @param mixed $typemedia
     * @return Post
     */
    public function setTypemedia($typemedia)
    {
        $this->typemedia = $typemedia;
        return $this;
    }



    /**
     * @return mixed|null
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     * @return Post
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }




    /**
     * @return mixed
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * @param mixed $like
     * @return Post
     */
    public function setLike($like)
    {
        $this->like = $like;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDislike()
    {
        return $this->dislike;
    }

    /**
     * @param mixed $dislike
     * @return Post
     */
    public function setDislike($dislike)
    {
        $this->dislike = $dislike;
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
     * @return Post
     */
    public function setActive($active)
    {
        $this->active = $active;
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
            $commentaire->setPost($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getPost() === $this) {
                $commentaire->setPost(null);
            }
        }

        return $this;
    }



}
