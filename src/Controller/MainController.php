<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

     #[Route('/test', name:'main_test')]

    public function test()
    {

        return $this->render('main/test.html.twig', );
    }

}