<?php

namespace BOMO\RedirectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;

use BOMO\RedirectBundle\Form\Type\RedirectType;

class DefaultController extends Controller
{
    /**
     * @Route("/redirects", name="redirect_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/redirect/new", name="redirect_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $form = $this->createForm(new RedirectType());

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/redirect", name="redirect_create")
     * @Method("POST")
     * @Template("BOMORedirectBundle:Default:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(new RedirectType());

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                ->getManager()
                ;

            $em->persist($form->getData());
            $em->flush();

            return $this->redirect($this->generateUrl('redirect_index'));
        }

        return array(
            'form' => $form->createView(),
        );
    }
}
