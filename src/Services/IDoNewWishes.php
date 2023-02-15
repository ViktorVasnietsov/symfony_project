<?php
namespace App\Services;

use App\Entity\Wish;
use Symfony\Component\Security\Core\User\UserInterface;

interface IDoNewWishes
{
    public function newWish(string $wish);

    public function activeWishesForUser();
    public function doneWishes();

    public function deleteWish(int $id);

    public function wishDone(int $id);

    public function wishActive(int $id);

    public function friendsWish($id);
}