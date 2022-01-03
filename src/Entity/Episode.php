<?php

namespace App\Entity;

use App\Repository\EpisodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpisodeRepository::class)]
class Episode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: season::class, inversedBy: 'episodes')]
    #[ORM\JoinColumn(nullable: false)]
    private $season_id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'integer')]
    private $number;

    #[ORM\Column(type: 'text')]
    private $synopsis;

    #[ORM\OneToMany(mappedBy: 'episode_id', targetEntity: WatchList::class)]
    private $watchLists;

    #[ORM\OneToMany(mappedBy: 'episode_id', targetEntity: Comment::class)]
    private $comments;

    public function __construct()
    {
        $this->watchLists = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeasonId(): ?season
    {
        return $this->season_id;
    }

    public function setSeasonId(?season $season_id): self
    {
        $this->season_id = $season_id;

        return $this;
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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * @return Collection|WatchList[]
     */
    public function getWatchLists(): Collection
    {
        return $this->watchLists;
    }

    public function addWatchList(WatchList $watchList): self
    {
        if (!$this->watchLists->contains($watchList)) {
            $this->watchLists[] = $watchList;
            $watchList->setEpisodeId($this);
        }

        return $this;
    }

    public function removeWatchList(WatchList $watchList): self
    {
        if ($this->watchLists->removeElement($watchList)) {
            // set the owning side to null (unless already changed)
            if ($watchList->getEpisodeId() === $this) {
                $watchList->setEpisodeId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setEpisodeId($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getEpisodeId() === $this) {
                $comment->setEpisodeId(null);
            }
        }

        return $this;
    }
}
