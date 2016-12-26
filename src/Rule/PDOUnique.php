<?php

namespace Albert221\Validation\Rule;

use PDO;

class PDOUnique implements RuleInterface
{
    use RuleTrait;

    protected $table;
    protected $field;
    protected $pdo;

    public function __construct($table, $field, PDO $pdo)
    {
        $this->table = $table;
        $this->field = $field;
        $this->pdo = $pdo;
    }

    public function test($value)
    {
        $statement = $this->pdo->prepare(sprintf(
            'SELECT COUNT(`%s`) FROM `%s` WHERE `%1$s` = :value',
            $this->field,
            $this->table
        ));

        $statement->bindValue(':value', $value);
        $statement->execute();

        return $statement->fetchColumn() == 0;
    }
}
