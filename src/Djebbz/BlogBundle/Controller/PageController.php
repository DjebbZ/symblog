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
            $form->handleRequest($request);

            if ($form->isValid()) {

                $message = \Swift_Message::newInstance()
                    ->setSubject('Contact enquiry from symblog')
                    ->setFrom('enquiries@symblog.co.uk')
                    ->setTo($this->container->getParameter('djebbz_blog.emails.contact_email'))
                    ->setBody($this->renderView('DjebbzBlogBundle:Page:contactEmail.txt.twig',
                        array('enquiry' => $enquiry)
                    ));
                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');

                return $this->redirect($this->generateUrl('DjebbzBlogBundle_contact'));
            }
        }
        return $this->render('DjebbzBlogBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}