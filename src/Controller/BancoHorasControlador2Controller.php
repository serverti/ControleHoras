<?php

namespace App\Controller;

use App\Entity\BancoHoras;
use App\Form\BancoHoras1Type;
use App\Repository\BancoHorasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/bancohoras')]
final class BancoHorasControlador2Controller extends AbstractController
{
    #[Route(name: 'app_banco_horas_controlador2_index', methods: ['GET'])]
    public function index(BancoHorasRepository $bancoHorasRepository): Response
    {
        return $this->render('banco_horas_controlador2/index.html.twig', [
            'banco_horas' => $bancoHorasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_banco_horas_controlador2_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bancoHora = new BancoHoras();
        $form = $this->createForm(BancoHoras1Type::class, $bancoHora);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bancoHora);
            $entityManager->flush();

            return $this->redirectToRoute('app_banco_horas_controlador2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('banco_horas_controlador2/new.html.twig', [
            'banco_hora' => $bancoHora,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_banco_horas_controlador2_show', methods: ['GET'])]
    public function show(BancoHoras $bancoHora): Response
    {
        return $this->render('banco_horas_controlador2/show.html.twig', [
            'banco_hora' => $bancoHora,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_banco_horas_controlador2_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BancoHoras $bancoHora, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BancoHoras1Type::class, $bancoHora);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_banco_horas_controlador2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('banco_horas_controlador2/edit.html.twig', [
            'banco_hora' => $bancoHora,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_banco_horas_controlador2_delete', methods: ['POST'])]
    public function delete(Request $request, BancoHoras $bancoHora, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bancoHora->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($bancoHora);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_banco_horas_controlador2_index', [], Response::HTTP_SEE_OTHER);
    }
}
