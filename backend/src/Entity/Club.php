<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable:false)]
    private ?string $name;

    #[ORM\Column(length: 255)]
    private ?string $island = null;

    #[ORM\OneToOne(inversedBy: 'club')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: Team::class, mappedBy: 'club', orphanRemoval: true)]
    private Collection $id_teams;    

    public function __construct()
    {
        $this->id_teams = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getIsland(): ?string
    {
        return $this->island;
    }

    public function setIsland(string $island): static
    {
        $this->island = $island;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->id_teams;
    }

    public function addTeam(Team $idTeam): static
    {
        if (!$this->id_teams->contains($idTeam)) {
            $this->id_teams->add($idTeam);
            $idTeam->setIdClub($this);
        }

        return $this;
    }

    public function removeTeam(Team $idTeam): static
    {
        if ($this->id_teams->removeElement($idTeam)) {
            // set the owning side to null (unless already changed)
            if ($idTeam->getIdClub() === $this) {
                $idTeam->setIdClub(null);
            }
        }

        return $this;
    }
}
