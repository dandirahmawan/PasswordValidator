<?php

namespace Dand\PasswordValidator; // Adjust to your namespace

class PasswordValidator
{
    public function validate($password)
    {
        $rules = [
            'length' => strlen($password) >= 8,
            'number' => preg_match('/[0-9]/', $password),
            'letter' => preg_match('/[a-zA-Z]/', $password),
            'symbol' => preg_match('/[\W_]/', $password),
            'capital' => preg_match('/[A-Z]/', $password),
        ];

        return count(array_filter($rules)) === count($rules); // All rules must be satisfied
    }

    public function getErrorMessages($password)
    {
        $messages = [];

        if (strlen($password) < 8) {
            $messages[] = 'Password must be at least 8 characters long.';
        }

        if (!preg_match('/[0-9]/', $password)) {
            $messages[] = 'Password must contain at least one number.';
        }

        if (!preg_match('/[a-zA-Z]/', $password)) {
            $messages[] = 'Password must contain at least one letter.';
        }

        if (!preg_match('/[\W_]/', $password)) {
            $messages[] = 'Password must contain at least one symbol.';
        }

        if (!preg_match('/[A-Z]/', $password)) {
            $messages[] = 'Password must contain at least one capital letter.';
        }

        return $messages;
    }
}