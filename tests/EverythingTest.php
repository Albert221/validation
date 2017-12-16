<?php

declare(strict_types=1);

namespace Albert221\Validation;

use PHPUnit\Framework\TestCase;

class EverythingTest extends TestCase
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var array
     */
    private $insults;

    /**
     * Sets up in-memory PDO and insults array.
     */
    public function setUp()
    {
        $this->pdo = new \PDO('sqlite::memory:');
        $this->pdo->exec('
            CREATE TABLE IF NOT EXISTS `users` (
                `id` INTEGER PRIMARY KEY AUTOINCREMENT,
                `username` VARCHAR UNIQUE
            );
            INSERT INTO `users` (`username`) VALUES
            ("john_doe");
        ');

        $this->insults = [
            'bad_word'
        ];
    }

    /**
     * @param bool $shouldBeValid
     * @param array $data
     *
     * @dataProvider provideData
     */
    public function testEverything(bool $shouldBeValid, array $data)
    {
        $verdicts = Validator::build()
            ->addField('username')
                ->addRule(Rule\Required::class)
//                ->addRule(Rule\Length::class, ['min' => 4])
//                ->addRule(Rule\DbUnique::class, [
//                    'pdo' => $this->pdo,
//                    'table' => 'users',
//                    'field' => 'username'
//                ])
//                ->addRule(Rule\NotIn::class, ['collection' => $this->insults])
            ->addField('email')
                ->addRule(Rule\Required::class)
//                ->addRule(Rule\Email::class)
            ->addField('favorite_sentence')
//                ->addRule(new Rule\Length(['min' => 10]))
            ->addField('password')
                ->addRule(Rule\Required::class)
//                ->addRule(Rule\Length::class)
//                    ->setOption('min', 8)
//                ->addRule(Rule\Complexity::class, ['num' => true, 'special' => true])
//                    ->setMessage('Your password is too weak!')
            ->addField('confirm_password')
                ->addRule(Rule\Required::class)
//                ->addRule(Rule\SameAs::class, ['field' => 'password'])
            ->validate($data);

        $this->assertEquals($shouldBeValid, $verdicts->passes());
    }

    /**
     * @return array
     */
    public function provideData(): array
    {
        $data = [];

        $data[] = [
            true,
            [
                'username' => 'Xavier',
                'email' => 'xavier@example.com',
                'favorite_sentence' => null,
                'password' => 'qwerty123!',
                'confirm_password' => 'qwerty123!'
            ]
        ];

        $data[] = [
            false,
            [
                'username' => 'john_doe',
                'favorite_sentence' => 'x',
                'password' => 'weaklol',
                'confirm_password' => null
            ]
        ];

        return $data;
    }
}
