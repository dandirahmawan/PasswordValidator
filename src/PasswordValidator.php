<?php

namespace Dand\PasswordValidator; // Adjust to your namespace

class PasswordValidator
{
    public function validate($password, $hashpassword, $additionalInfo)
    {
        $rules = [
            'length' => strlen($password) >= 8,
            'number' => preg_match('/[0-9]/', $password),
            'letter' => preg_match('/[a-zA-Z]/', $password),
            'symbol' => preg_match('/[\W_]/', $password),
            'capital' => preg_match('/[A-Z]/', $password),
        ];

        if (count(array_filter($rules)) !== count($rules)) {
            return false;
        };

        for ($i = 0;$i<count($hashpassword);$i++) {
            if (password_verify($password, $hashpassword[$i])) {
                return false;
            } 
        }
        
        for ($i = 0; $i < count($additionalInfo); $i++) {
            $info = $additionalInfo[$i];
            if (stripos($info["value"], $password) !== false) {
                return false;
            }
        }
        
        return true; // All rules must be satisfied
    }

    public function getErrorMessages($password, $hashpassword, $additionalInfo)
    {
        $messages = "";

        if (strlen($password) < 8) {
            $messages = 'Katasandi setidaknya memiliki panjang 8 karakter dengan 1 simbol, huruf besar dan angka';
        }

        if (!preg_match('/[0-9]/', $password)) {
            $messages = 'Katasandi setidaknya memiliki panjang 8 karakter dengan 1 simbol, huruf besar dan angka';
        } else if (!preg_match('/[a-zA-Z]/', $password)) {
            $messages = 'Katasandi setidaknya memiliki panjang 8 karakter dengan 1 simbol, huruf besar dan angka';
        } else if (!preg_match('/[\W_]/', $password)) {
            $messages = 'Katasandi setidaknya memiliki panjang 8 karakter dengan 1 simbol, huruf besar dan angka';
        }else if (!preg_match('/[A-Z]/', $password)) {
            $messages = 'Katasandi setidaknya memiliki panjang 8 karakter dengan 1 simbol, huruf besar dan angka';
        }

        for ($i = 0;$i<count($hashpassword);$i++) {
            if (password_verify($password, $hashpassword[$i])) {
                $messages = 'Kata sandi tidak boleh sama dengan '.count($hashpassword).' kata sandi terakhir';
            } 
        }
        
        for ($i = 0; $i < count($additionalInfo); $i++) {
            $info = $additionalInfo[$i];
            if (stripos($info["value"], $password) !== false) {
                $messages = 'Kata sandi tidak boleh memiliki kesamaan dengan ' . $info["name"];
            }
        }

        return $messages;
    }
}