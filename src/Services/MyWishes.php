<?php
namespace App\Services;

use App\Entity\User;
use App\Entity\Wish;
use App\Services\IDoNewWishes;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class MyWishes implements IDoNewWishes
{
    protected ObjectManager $objectManager;
    protected  ObjectRepository $repository;

    public function __construct(protected ManagerRegistry $doctrine, protected Security $security)
    {
        $this->objectManager = $this->doctrine->getManager();
        $this->repository = $this->doctrine->getRepository(Wish::class);

    }
    public function newWish(string $wish):Wish
    {
        try{
            $user = $this->security->getUser();
            $newWish = new Wish($wish, $user);
            $this->save($newWish);
            return $newWish;
        }catch (\Exception){
            throw new \Exception('something went wrong with wishes :/');
        }
}

    public function activeWishesForUser(?UserInterface $user = null)
    {
        try {
            $user = $this->security->getUser();
            return $this->repository->findBy(['user'=>$user,'status'=>0]);
        }catch (\Exception){
            throw new \Exception('oops something wrong');
        }
}
    public function friendsWish($id)
    {
        try {
            $friend = $this->repository->findBy(['user' => $id]);
            return $friend;
        } catch (\Exception) {
            throw new \Exception('oops something wrong');
        }

    }

    public function doneWishes(?UserInterface $user = null)
    {
        try {
            $user = $this->security->getUser();
            return $this->repository->findBy(['user'=>$user,'status'=>1]);
        }catch (\Exception){
            throw new \Exception('oops something wrong');
        }
}

    public function deleteWish(int $id)
    {
        try {
            $wish = $this->repository->find($id);
            $this->objectManager->remove($wish);
            $this->objectManager->flush();
        }catch (\Exception){
            throw new \Exception('oops something wrong');
        }

}

    public function setWishDone(Wish $wish): static
    {
            $wish->setDone();
            $this->save($wish);
            return $this;
}
    public function setWishActive(Wish $wish): static
    {
            $wish->setActive();
            $this->save($wish);
            return $this;
}

    public function wishDone(int $id)
    {
        try {
            $wish = $this->repository->find($id);
            $this->setWishDone($wish);
        }catch (\Exception){
            throw new \Exception('oops something wrong');
        }
}
    public function wishActive(int $id)
    {
        try {
            $wish = $this->repository->find($id);
            $this->setWishActive($wish);
        }catch (\Exception){
            throw new \Exception('oops something wrong');
        }
}
    public function save(object $object)
    {
        $this->objectManager->persist($object);
        $this->objectManager->flush();
}
}