<?php

namespace App\Controller;

use App\Entity\Proprety;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PropretyController extends AbstractController
{
    private $em;
    private $repository;

    public function __construct(EntityManagerInterface $emi)
    {
        $this->em=$emi;
        $this->repository=$emi->getRepository(Proprety::class);
    }

    /**
     * @Route("/proprety", name="app_proprety_index")
     */
    public function index()
    {
        $proprety=new Proprety();
        $proprety->setDescription("Un studio pour celibataire")
            ->setAdresse("Oust-foir")
            ->setBedrooms(1)
            ->setCity("Yoff")
            ->setFloor(4)
            ->setHeat(1)
            ->setPostal('23543')
            ->setPrice(200000)
            ->setRooms(2)
            ->setSold(true)
            ->setSurface(14)
            ->setTitle('Studio')
            ->setCreatedAt(new \DateTime());
        $this->em->persist($proprety);
        $this->em->flush();

        return $this->redirect($this->generateUrl('app_home'));
    }
}
