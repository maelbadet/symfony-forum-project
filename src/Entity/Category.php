<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $role_access = null;

    /**
     * @var Collection<int, Board>
     */
    #[ORM\ManyToMany(targetEntity: Board::class, mappedBy: 'category')]
    private Collection $boards;

    public function __construct()
    {
        $this->boards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRoleAccess(): ?string
    {
        return $this->role_access;
    }

    public function setRoleAccess(string $role_access): static
    {
        $this->role_access = $role_access;

        return $this;
    }

    /**
     * @return Collection<int, Board>
     */
    public function getBoards(): Collection
    {
        return $this->boards;
    }

    public function addBoard(Board $board): static
    {
        if (!$this->boards->contains($board)) {
            $this->boards->add($board);
            $board->addCategory($this);
        }

        return $this;
    }

    public function removeBoard(Board $board): static
    {
        if ($this->boards->removeElement($board)) {
            $board->removeCategory($this);
        }

        return $this;
    }
}
