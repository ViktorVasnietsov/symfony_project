<?php

namespace App\Controller;

use App\Services\IDoNewWishes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{

    public function __construct(
        protected IDoNewWishes $doNewWishes
    )
    {
    }

    #[Route('/newWish',name:'newWish', methods: ['POST'])]
    public function newWish(Request $request):Response
    {
        $wish = $this->doNewWishes->newWish($request->request->get('wish'));
        return $this->render('wish/ok.html.twig',[
            'wish'=> $wish,
        ]);
    }

    #[Route('/Wish', methods: ['GET'])]
    public function wish():Response
    {
        return $this->render('wish/wish.html.twig',[
            'form_action'=>$this->generateUrl('newWish')
        ]);
    }
    #[Route('/allWishes',name:'allWishes', methods: ['GET'])]
    public function allWishes():Response
    {
        $allWishes = $this->doNewWishes->allWishes();
        return $this->render('wish/allWishes.html.twig',[
            'wishes'=>$allWishes,
        ]);
    }

    #[Route('/dellWishes{id}',name:'dell_wishes',methods: ['GET'])]
    public function dellWishes($id):Response
    {
            $this->doNewWishes->deleteWish($id);
            return $this->redirect('/allWishes');
//            return $this->render('wish/allWishes.html.twig',[
//                'form_action'=>$this->generateUrl('allWishes')
//            ]);
    }
}