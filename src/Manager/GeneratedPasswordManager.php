<?php

namespace App\Manager;

use App\Entity\GeneratedPassword;
use App\Dto\PasswordGeneratorRequest;
use App\Service\PasswordGeneratorService;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class GeneratedPasswordManager
{
    public function __construct(
        readonly private ManagerRegistry $managerRegistry,
        readonly private PasswordGeneratorService $passwordGeneratorService,
    ) {
    }

    public function generateSavePassword(PasswordGeneratorRequest $request, int $maxAttempts = 1000): string
    {
        $attempts = 0;
        while ($attempts < $maxAttempts) {
            $password = $this->passwordGeneratorService->generatePassword($request);

            $generatedPassword = new GeneratedPassword();
            $generatedPassword->setPasswordHash(hash('sha256', $password));

            $entityManager = $this->managerRegistry->getManager();

            try {
                $entityManager->persist($generatedPassword);
                $entityManager->flush();
                return $password;
            } catch (UniqueConstraintViolationException $e) {
                $this->managerRegistry->resetManager();
                $attempts++;
            }
        }

        throw new \RuntimeException('Failed to generate unique password after ' . $maxAttempts . ' attempts');
    }
}
