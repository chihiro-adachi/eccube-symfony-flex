<?php

namespace Eccube\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\BaseInfo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(EntityManagerInterface $em)
    {
        // レポジトリの取得サンプル
        $BaseInfo = $em->getRepository(BaseInfo::class)->find(1);

        // ダミーの値
        $Page = new \stdClass();
        $Page->author = null;
        $Page->description = null;
        $Page->keyword = null;
        $Page->meta_robots = null;
        $Page->Head = null;
        $Page->Header = null;
        $Page->ContentsTop = null;
        $Page->SideLeft = null;
        $Page->ColumnNum = 1;
        $Page->MainTop = null;
        $Page->MainBottom = null;
        $Page->SideRight = null;
        $Page->ContentsBottom = null;
        $Page->Footer = null;

        return $this->render('index.html.twig', [
            'BaseInfo' => $BaseInfo,
            'Page' => $Page
        ]);
    }
}