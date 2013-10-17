<?php

namespace BOMO\RedirectBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectSubscriber implements EventSubscriberInterface
{
    static public function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(
                array('checkRedirect', 0),
            ),
        );
    }

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function checkRedirect(GetResponseEvent $event)
    {
        try {
            $url = $this->em
                ->getRepository('BOMORedirectBundle:Redirect')
                ->getFromSource($event->getRequest()->getPathInfo())
                ;
            
            $reponse = new RedirectResponse($event->getRequest()->getUriForPath($url->getUrlTarget()), $url->getCode());
                
            $event->setResponse($reponse);

        } catch (\Doctrine\Orm\NoResultException $exception) {
            return;
            
        }
    }
}
