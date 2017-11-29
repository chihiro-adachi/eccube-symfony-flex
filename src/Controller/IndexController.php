<?php

namespace Eccube\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\BaseInfo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(EntityManagerInterface $em)
    {
        $bi = $em->getRepository(BaseInfo::class)->find(1);

        return new Response('hello world');
    }
}