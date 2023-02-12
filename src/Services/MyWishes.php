<?php
namespace App\Services;

use App\Entity\Wish;
use App\Services\IDoNewWishes;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

class MyWishes implements IDoNewWishes
{
    protected ObjectManager $objectManager;
    protected  ObjectRepository $repository;

    public function __construct(protected ManagerRegistry $doctrine)
    {
        $this->objectManager = $this->doctrine->getManager();
        $this->repository = $this->doctrine->getRepository(Wish::class);

    }
    public function newWish(string $wish):Wish
    {
        try{
            $newWish = new Wish($wish);
            $this->save($newWish);
            return $newWish;
        }catch (\Exception){
            throw new \Exception('something went wrong with wishes :/');
        }
}

    public function allWishes(?Wish $wish = null)
    {
        try {
            return $this->repository->findAll();
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
    public function save(object $object)
    {
        $this->objectManager->persist($object);
        $this->objectManager->flush();
}
}