<?php

namespace Djebbz\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('DjebbzBlogBundle:Page:index.html.twig');
    }
}