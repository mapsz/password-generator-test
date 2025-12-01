<?php

namespace App\Service;

class PasswordGeneratorService
{
    public function generatePassword(
        int $length,
        bool $useUppercase,
        bool $useLowercase,
        bool $useNumbers,
    ): string {
        $chars = '';

        $useUppercase && $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $useLowercase && $chars .= 'abcdefghijklmnopqrstuvwxyz';
        $useNumbers && $chars .= '0123456789';

        $password = '';
        $charsLength = strlen($chars);

        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, $charsLength - 1)];
        }

        return $password;
    }
}
