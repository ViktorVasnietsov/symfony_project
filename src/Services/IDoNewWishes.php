<?php
namespace App\Services;

interface IDoNewWishes
{
    public function newWish(string $wish);

    public function allWishes();

    public function deleteWish(int $id);
}