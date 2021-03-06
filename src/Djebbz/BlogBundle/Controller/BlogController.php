<?php

namespace Djebbz\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $blog = $em->getRepository('DjebbzBlogBundle:Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post with id ' . $id);
        }

        return $this->render('DjebbzBlogBundle:Blog:show.html.twig',
            array('blog' => $blog)
        );
    }
}