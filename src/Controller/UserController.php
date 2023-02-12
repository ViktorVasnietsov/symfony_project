<?php

namespace App\Controller;

use App\Services\IDoFindUsers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(
        protected IDoFindUsers $doFindUsers
    )
    {

}

    #[Route('/findFriend', name: 'findOne',methods: ['POST'])]
    public function findOneUser(Request $request):Response
    {
        try {
            $user = $this->doFindUsers->findUser($request->request->get('email'));
            $template = $this->render('user/YourUser.html.twig',[
                'user'=>$user
            ]);
        }catch (\Exception $e){
            $template =  $this->render('error/error.html.twig',[
                'error'=>$e
            ]);
        }
        return $template;

    }

    #[Route('/findUsers', name: 'findUsers',methods: ['GET'])]
    public function findUsers():Response
    {
        return $this->render('user/findOneUser.html.twig',[
            'form_action'=>$this->generateUrl('findOne')
        ]);
    }

}