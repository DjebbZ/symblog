<?php

namespace Djebbz\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use  Djebbz\BlogBundle\Entity\Enquiry;
use  Djebbz\BlogBundle\Form\EnquiryType;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('DjebbzBlogBundle:Page:index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('DjebbzBlogBundle:Page:about.html.twig');
    }

    public function contactAction()
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                return $this->redirect($this->generateUrl('DjebbzBlogBundle_contact'));
            }
        }
        return $this->render('DjebbzBlogBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}