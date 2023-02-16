<?php

namespace App\Controller;

use App\Services\IDoWishes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/w')]

class WishController extends AbstractController
{

    public function __construct(
        protected IDoWishes $doWishes
    )
    {
    }

    #[Route('/newWish',name:'newWish', methods: ['POST'])]
    public function newWish(Request $request):Response
    {
        $wish = $this->doWishes->newWish($request->request->get('wish'));
        return $this->render('wish/ok.html.twig',[
            'wish'=> $wish,
        ]);
    }
    #[Route('/friendsWish{id}', name: 'friendsWish',methods: ['GET'])]
    public function getFriendsWish($id):Response
    {
        $wishes = $this->doWishes->friendsWish($id);
        return $this->render('user/friendsWishes.html.twig',[
            'wishes'=>$wishes
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
        $activeWishes = $this->doWishes->activeWishesForUser();
        $doneWishes = $this->doWishes->doneWishes();
        return $this->render('wish/allWishes.html.twig',[
            'a_wishes'=>$activeWishes,
            'd_wishes'=>$doneWishes,
        ]);
    }

    #[Route('/dellWishes{id}',name:'dell_wishes',methods: ['GET'])]
    public function dellWishes($id):Response
    {
            $this->doWishes->deleteWish($id);
            return $this->redirect('/w/allWishes');
    }

    #[Route('/doneWishes{id}',name:'done_wishes',methods: ['GET'])]
    public function doneWishes($id):Response
    {
            $this->doWishes->wishDone($id);
            return $this->redirect('/w/allWishes');
    }

    #[Route('/activeWishes{id}',name:'activate_wishes',methods: ['GET'])]
    public function activateWishes($id):Response
    {
            $this->doWishes->wishActive($id);
            return $this->redirect('/w/allWishes');
    }
}