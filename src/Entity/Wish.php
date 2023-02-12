<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use PharIo\Manifest\Type;
use phpDocumentor\Reflection\Types\Integer;

#[Orm\Entity]
#[Orm\Table(name: 'wishes')]

class Wish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'wishes')]
    #[ORM\JoinColumn(name: 'user_id',referencedColumnName: 'id')]
    private User $user;

    #[ORM\Column(type: 'string')]
    private string $wish;

    /**

     * @param string $wish
     */
    public function __construct(string $wish)
    {
//        $this->user = $user;
        $this->wish = $wish;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getWish(): string
    {
        return $this->wish;
    }

    /**
     * @param string $wish
     */
    public function setWish(string $wish): void
    {
        $this->wish = $wish;
    }

}