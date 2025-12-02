<?php

namespace App\Controller;

use App\Form\GeneratedPasswordType;
use App\Dto\PasswordGeneratorRequest;
use App\Manager\GeneratedPasswordManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class GeneratedPasswordController extends AbstractController
{
    #[Route('/', name: 'app_generated_password')]
    public function index(
        Request $request,
        GeneratedPasswordManager $generatedPasswordManager,
    ): Response {
        $form = $this->createForm(GeneratedPasswordType::class);
        $form->handleRequest($request);

        $generatedPassword = null;

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var PasswordGeneratorRequest $data */
            $data = $form->getData();
            try {
                $generatedPassword = $generatedPasswordManager->generateSavePassword($data);
            } catch (\RuntimeException $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('generated_password/index.html.twig', [
            'form' => $form,
            'generatedPassword' => $generatedPassword,
        ]);
    }
}
