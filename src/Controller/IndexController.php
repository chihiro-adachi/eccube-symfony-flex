<?php

namespace Eccube\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\BaseInfo;
use Eccube\Form\Type\BaseInfoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        // $this->getDoctrine()でよい
        // コンストラクタインジェクションのサンプルとして
        $this->em = $em;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        // レポジトリの取得サンプル
        $BaseInfo = $this->em->getRepository(BaseInfo::class)->find(1);

        $form = $this->createForm(BaseInfoType::class, $BaseInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $BaseInfo = $form->getData();
            $this->em->persist($BaseInfo);
            $this->em->flush();

            //$this->addFlash('message', '登録しました。');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
            'BaseInfo' => $BaseInfo,
            'Page' => $this->createPage(),
        ]);
    }

    private function createPage() {
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

        return $Page;
    }
}