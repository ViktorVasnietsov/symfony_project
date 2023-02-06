<?php

namespace App\Controller;

use App\Services\IDoNewUsers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    public function __construct(
        protected IDoNewUsers $doNewUsers
    )
    {
        
    }
    #[Route('/test')]
    public function test():Response
    {
        return new Response('test page');
}
#[Route('/new',methods: ['POST'])]
    public function newUser(Request $request):Response
    {
        $login = $request->request->get('login');
        $password = $request->request->get('password');
        $this->doNewUsers->newUser($login,$password);
        return new Response('OK');

}
}