<?php
namespace App\Services;

use App\Entity\User;
use Doctrine\DBAL\Driver\PDO\Exception;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class UserService implements IDoFindUsers
{
    protected ObjectManager $objectManager;
    protected ObjectRepository $repository;

    public function __construct(protected ManagerRegistry $doctrine)
    {
        $this->objectManager = $this->doctrine->getManager();
        $this->repository = $this->doctrine->getRepository(User::class);
    }

    public function findUser(string $email)
    {
        try {
            $user = $this->repository->findOneBy(['email' => $email]);
            return $user;
        } catch (\Exception) {
            throw new Exception('User not found');
        }
    }
}