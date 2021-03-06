<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Form\PinType;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PinsController extends AbstractController
{

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }


    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(PinRepository $repository): Response
    {
        $pins = $repository->findBy([], ['updatedAt' => 'DESC']);

        return $this->render('pins/index.html.twig', compact('pins'));
    }


    #[Route('/pins/{id<[0-9]+>}', name: 'app_pins_show', methods: ['GET'])]
    public function show(Pin $pin): Response
    {
        return $this->render('pins/show.html.twig', compact('pin'));
    }

    #[Route('/pins/create', name: 'app_pins_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {

        $pin = new Pin();
        $form = $this->createForm(PinType::class, $pin);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($pin);
            $this->manager->flush();
            return $this->redirectToRoute('app_pins_show', ['id' => $pin->getId()]);
        }

        return $this->render(
            'pins/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }



    #[Route('/pins/{id<[0-9]+>}/edit', name: 'app_pins_edit', methods: ['GET', 'PUT'])]
    public function edit(Pin $pin, Request $request): Response
    {
        $form = $this->createForm(PinType::class, $pin, ['method' => 'PUT']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->flush();
            return $this->redirectToRoute('app_pins_show', ['id' => $pin->getId()]);
        }

        return $this->render(
            'pins/edit.html.twig',
            [
                'pin' => $pin,
                'form' => $form->createView()
            ]
        );
    }


    #[Route('/pins/{id<[0-9]+>}/delete', name: 'app_pins_delete', methods: ['DELETE'])]
    function delete(Pin $pin, Request $request): Response
    {
        if($this->isCsrfTokenValid('pin_delete_' . $pin->getId(), $request->request->get('csrf_token'))){
            $this->manager->remove($pin);
            $this->manager->flush();
        }
        return $this->redirectToRoute('app_home');
    }
}
