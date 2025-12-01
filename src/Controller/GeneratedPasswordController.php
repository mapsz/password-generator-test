<?php

namespace App\Controller;

use App\Dto\PasswordGeneratorRequest;
use App\Form\GeneratedPasswordType;
use App\Service\PasswordGeneratorService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class GeneratedPasswordController extends AbstractController
{
    #[Route('/', name: 'app_generated_password')]
    public function index(
        Request $request,
        PasswordGeneratorService $passwordGeneratorService,
    ): Response {
        $form = $this->createForm(GeneratedPasswordType::class);
        $form->handleRequest($request);

        $generatedPassword = null;

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var PasswordGeneratorRequest $data */
            $data = $form->getData();
            $generatedPassword = $passwordGeneratorService->generatePassword($data);
        }

        return $this->render('generated_password/index.html.twig', [
            'form' => $form,
            'generatedPassword' => $generatedPassword,
        ]);
    }
}
