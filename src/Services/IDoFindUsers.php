<?php

namespace App\Services;

interface IDoFindUsers
{
    public function findUser(string $email);
}