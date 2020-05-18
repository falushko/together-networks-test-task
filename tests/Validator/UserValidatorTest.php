<?php

namespace Validator;

use PHPUnit\Framework\TestCase;
use TestTask\DTO\User;
use TestTask\Validator\UserValidator;

class UserValidatorTest extends TestCase
{
    public function testIsValid()
    {
        $userValidator = new UserValidator();

        $user = new User();
        $user->setId(1);
        $user->setName('Test Name');
        $user->setEmail('Test Email');
        $user->setSum(1234);
        $user->setCurrency('$');

        $isValid = $userValidator->isValid($user);

        $this->assertTrue($isValid);
        $this->assertEquals([], $userValidator->getErrors());
    }

    public function testIsInvalid()
    {
        $userValidator = new UserValidator();

        $user = new User();
        $user->setId(1);
        $user->setName('Test Name test test test test test');
        $user->setEmail('Test Email');
        $user->setSum(1234561234);
        $user->setCurrency('$QWERTY');

        $isValid = $userValidator->isValid($user);

        $this->assertFalse($isValid);
        $this->assertEquals([
            'currency' => 'User\'s currency is invalid',
            'sum' => 'User\'s sum is invalid',
            'name' => 'User\'s name is invalid'
        ], $userValidator->getErrors());
    }
}