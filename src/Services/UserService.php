<?php

namespace App\Services;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

class UserService implements IDoNewUsers
{
    protected ObjectManager $entityManager;
    protected ObjectRepository $userRepository;
    public function __construct(protected ManagerRegistry $doctrine)
    {
        $this->entityManager = $doctrine->getManager();
        $this->userRepository = $this->doctrine->getRepository(User::class);
}

    public function newUser(string $login, string $password):User
    {
        try {
            $user = new User($login, $password);
            $this->save($user);
            return $user;
        }catch (\Exception){
            throw new \Exception('something went wrong');
        }
}

    public function save(object $object)
    {
        $this->entityManager->persist($object);
        $this->entityManager->flush();
}
}