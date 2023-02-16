<?php

namespace App\Controller;

//use App\Services\IDoNewUsers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/')]
    public function test():Response
    {
        return $this->render('main/main.html.twig');
}
}