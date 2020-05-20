<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\DataCollector\DumpDataCollector;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pin;

class PinsController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }

    /**
     * @Route("/")
     */
    public function index()
    {

        $pinReposi=$this->em->getRepository(Pin::class);

         $pin=new Pin();
         /*$pin->setTitre("Titre2");
        $pin->setDescription("Article2");
        $this->em->persist($pin);
        $this->em->flush();*/
        $pins=$pinReposi->findAll();

        return $this->render('pins/index.html.twig', [
            'listPins' => $pins,
        ]);
    }
}
