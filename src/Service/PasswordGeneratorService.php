<?php

namespace App\Service;

use App\Dto\PasswordGeneratorRequest;

class PasswordGeneratorService
{
    private const string LOWERCASE_CHARS = 'abcdefghijklmnopqrstuvwxyz';
    private const string UPPERCASE_CHARS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private const string NUMBER_CHARS = '0123456789';

    public function generatePassword(PasswordGeneratorRequest $request): string
    {
        $charsTypes = [];

        $request->useLowercase && $charsTypes[] = self::LOWERCASE_CHARS;
        $request->useUppercase && $charsTypes[] = self::UPPERCASE_CHARS;
        $request->useNumbers && $charsTypes[] = self::NUMBER_CHARS;

        // Add required characters
        $password = '';
        foreach ($charsTypes as &$chars) {
            $password .= $this->pickRandomChar($chars);
        }

        $charsToUse = implode('', $charsTypes);
        $remainingLength = $request->length - strlen($password);

        // Add remaining characters
        for ($i = 0; $i < $remainingLength; $i++) {
            $password .= $this->pickRandomChar($charsToUse);
        }

        return str_shuffle($password);
    }

    private function pickRandomChar(string &$chars): string
    {
        $randomIndex = random_int(0, strlen($chars) - 1);
        $selectedChar = $chars[$randomIndex];
        $chars = substr_replace($chars, '', $randomIndex, 1);

        return $selectedChar;
    }
}
