<?php

namespace Joker\JokeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('JokerJokeBundle:Home:index.html.twig');
    }
}
