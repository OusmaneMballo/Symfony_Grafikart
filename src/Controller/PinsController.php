<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpKernel\DataCollector\DumpDataCollector;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pin;

class PinsController extends AbstractController
{
    private $em;
    private $repository;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
        $this->repository=$em->getRepository(Pin::class);
    }

    /**
     * @Route("/", name="app_home")
     */
    public function index()
    {
        $pins=$this->repository->findAll();
        return $this->render('pins/index.html.twig', [
            'listPins' => $pins,
        ]);
    }

    /**
     * @Route("/pins/create", name="app_pins_create", methods={"GET|POST|PATCH"})
     */
    public function create(Request $request)
    {
        /*if($request->isMethod("POST"))
        {
            if($this->isCsrfTokenValid('pins_token', $request->request->get('token')))
            {
                $pin=new Pin();
                $pin->setTitre($request->request->get('title'));
                $pin->setDescription($request->request->get('desc'));
                $this->em->persist($pin);
                $this->em->flush();
                return $this->redirect($this->generateUrl('app_home'));
            }
        }*/
        //Creation de formulaire avec FormBulder

        /*$form=$this->createFormBuilder()
            ->add('title', TextType::class,
                ['attr'=>['autofocus'=>true],
                'required'=>false])
            ->add('description', TextareaType::class,
                ['attr'=>['rows'=>5,'cols'=>40]])
            ->add('submit', SubmitType::class, ['label'=>'Create pin'])
            ->getForm()
        ;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $pin=new Pin();
            $data=$form->getData();
            $pin->setTitre($data['title']);
           // $pin->setTitre($form->get('title')->getData());
            $pin->setDescription($data['description']);
            $this->em->persist($pin);
            $this->em->flush();
            return $this->redirect($this->generateUrl('app_home'));
        }
        return $this->render('pins/create.html.twig',
            ['monFormulaire'=>$form->createView()]);*/

        //Autre methode...

        $pin=new Pin;
        $form=$this->createFormBuilder($pin)
            ->add('titre', TextType::class,
                ['attr'=>['autofocus'=>true],
                    'required'=>false])
            ->add('description', TextareaType::class,
                ['attr'=>['rows'=>5,'cols'=>40]])
            ->getForm()
        ;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            //$this->em->persist($form->getData());
            $this->em->persist($pin);
            $this->em->flush();
            return $this->redirectToRoute('app_pins_show', ['id'=>$pin->getId()]);
        }
        return $this->render('pins/create.html.twig',
            ['monFormulaire'=>$form->createView()]);

    }

    /**
     * @Route("/pins/{id<[0-9]+>}", name="app_pins_show")
     */
    public function show(int $id)
    {
        $pin=$this->repository->find($id);
        if(is_null($pin))
        {
            throw $this->createNotFoundException('Oups! Pin '.$id.' not found!...');
        }

        return $this->render('pins/show.html.twig',['pin'=>$pin]);
    }
}
