<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $matchDay = null;

    #[ORM\Column]
    private ?bool $isWinner = null;

    #[ORM\Column(length: 255)]
    private ?string $onPlay = null;

    #[ORM\Column]
    private ?int $visitorTeam = null;

    #[ORM\Column]
    private ?int $localTeam = null;


    #[ORM\OneToMany(targetEntity: Score::class, mappedBy: 'game', orphanRemoval: false)]
    private ?Collection $scores = null;

    public function __construct() {
        $this->scores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getMatchDay(): ?\DateTimeInterface
    {
        return $this->matchDay;
    }

    public function setMatchDay(\DateTimeInterface $matchDay): static
    {
        $this->matchDay = $matchDay;

        return $this;
    }

    public function isIsWinner(): ?bool
    {
        return $this->isWinner;
    }

    public function setIsWinner(bool $isWinner): static
    {
        $this->isWinner = $isWinner;

        return $this;
    }

    public function getOnPlay(): ?string
    {
        return $this->onPlay;
    }

    public function setOnPlay(string $onPlay): static
    {
        $this->onPlay = $onPlay;

        return $this;
    }


    public function getVisitorTeam(): ?int
    {
        return $this->visitorTeam;
    }

    public function setVisitorTeam(int $visitorTeam): static
    {
        $this->visitorTeam = $visitorTeam;

        return $this;
    }

    public function getLocalTeam(): ?int
    {
        return $this->localTeam;
    }

    public function setLocalTeam(int $localTeam): static
    {
        $this->localTeam = $localTeam;

        return $this;
    }
    /**
     * @return Collection<int, Team>
     */
    public function getScores(): Collection {
        return $this->scores;
    }

    public function addScores(Score $scores): static {
        if (!$this->scores->contains($scores)) {
            $this->scores->add($scores);
            $scores->setGame($this);
        }

        return $this;
    }

    public function removeScore(Score $scores): static {
        if ($this->scores->removeElement($scores)) {
            // set the owning side to null (unless already changed)
            if ($scores->getGame() === $this) {
                $scores->setGame(null);
            }
        }

        return $this;
    }
   
}
