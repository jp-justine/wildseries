<?php

namespace App\Entity;

use App\Repository\WatchListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WatchListRepository::class)]
class WatchList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'watchLists')]
    #[ORM\JoinColumn(nullable: false)]
    private $user_id;

    #[ORM\ManyToOne(targetEntity: episode::class, inversedBy: 'watchLists')]
    #[ORM\JoinColumn(nullable: false)]
    private $episode_id;

    #[ORM\Column(type: 'boolean')]
    private $seen;

    #[ORM\Column(type: 'boolean')]
    private $love;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getEpisodeId(): ?episode
    {
        return $this->episode_id;
    }

    public function setEpisodeId(?episode $episode_id): self
    {
        $this->episode_id = $episode_id;

        return $this;
    }

    public function getSeen(): ?bool
    {
        return $this->seen;
    }

    public function setSeen(bool $seen): self
    {
        $this->seen = $seen;

        return $this;
    }

    public function getLove(): ?bool
    {
        return $this->love;
    }

    public function setLove(bool $love): self
    {
        $this->love = $love;

        return $this;
    }
}
