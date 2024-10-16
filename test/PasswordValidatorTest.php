<?php

namespace Tests\Feature;

use Dand\PasswordValidator\PasswordValidator;
use Illuminate\Hashing\BcryptHasher;
use PHPUnit\Framework\TestCase;

class PasswordValidatorTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_password(): void
    {
        $validator = new PasswordValidator();
        $additionalInfo = [
            [
                "name" => "email",
                "value" => "rizky1#F.reza@mail.com"
            ],
            [
                "name" => "nama",
                "value" => "rizky reza"
            ]
        ];

        $error = $validator->getErrorMessages(
            'rizky1#F.reza', 
            ["", "", '$2y$04$h7vFOK0UtmGsjAgCCC2p3uTskLxZMkErvsWJUhqkNI1qYTNSL3OEW'], 
            $additionalInfo
        );

        print_r($error);
        
        $this->assertTrue($validator->validate(
            'rizky1#F.rezaK', 
            ["", "", '$2y$04$h7vFOK0UtmGsjAgCCC2p3uTskLxZMkErvsWJUhqkNI1qYTNSL3OEW'], 
            $additionalInfo
        ));
    }
}
