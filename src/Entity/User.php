<?php

namespace App\Entity;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]

class User
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(length: 30)]
    private string $login;


    #[ORM\Column(length: 20)]
    private string $password;

/**
* @param string $login
* @param string $password
*/
    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->codePassword($password);
    }

/**
* @return int
*/
    public function getId(): int
    {
        return $this->id;
    }

/**
* @param int $id
*/
    public function setId(int $id): void
    {
        $this->id = $id;
    }

/**
* @return string
*/
    public function getLogin(): string
    {
        return $this->login;
    }

/**
* @param string $login
*/
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

/**
* @return string
*/
    public function getPassword(): string
    {
        return $this->password;
    }

    public function codePassword(string $password): void
    {
        $this->password = md5($password);
    }

}