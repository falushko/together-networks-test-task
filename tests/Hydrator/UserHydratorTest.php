<?php

namespace Hydrator;

use PHPUnit\Framework\TestCase;
use TestTask\DTO\User;
use TestTask\Hydrator\UserHydrator;

class UserHydratorTest extends TestCase
{
    protected $userHydrator;

    public function setUp()
    {
        $this->userHydrator = new UserHydrator();
    }

    /**
     * @dataProvider dataProvider
     *
     * @param string $id
     * @param string $name
     * @param string $email
     * @param int $sum
     * @param string $currency
     */
    public function testHydrateUser(string $id, string $name, string $email, int $sum, string $currency)
    {
        $userArray = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'sum' => $sum,
            'currency' => $currency
        ];

        $user = new User();
        $user->setId($id);
        $user->setName($name);
        $user->setEmail($email);
        $user->setSum($sum);
        $user->setCurrency($currency);

        $this->assertEquals($user, $this->userHydrator->hydrateUser($userArray));

    }

    /**
     * @dataProvider dataProvider
     *
     * @param string $id
     * @param string $name
     * @param string $email
     * @param int $sum
     * @param string $currency
     */
    public function testHydrateUsers(string $id, string $name, string $email, int $sum, string $currency)
    {
        $userArray = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'sum' => $sum,
            'currency' => $currency
        ];

        $user = new User();
        $user->setId($id);
        $user->setName($name);
        $user->setEmail($email);
        $user->setSum($sum);
        $user->setCurrency($currency);

        $this->assertEquals([$user], $this->userHydrator->hydrateUsers([$userArray]));
    }

    public function dataProvider()
    {
        return [
            [1, 'Test Name', 'Test Email', 123, '$']
        ];
    }
}