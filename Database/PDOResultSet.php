<?php


namespace Database;


class PDOResultSet implements ResultSetInterface
{

    private $pdoStatement;

    public function __construct(\PDOStatement $pdoStatement)
    {
        $this->pdoStatement = $pdoStatement;
    }

    /**
     * @return \Generator
     */
    public function fetch(): \Generator
    {
        while($row = $this->pdoStatement->fetchAll(\PDO::FETCH_ASSOC)) {
            yield $row;
        }
    }
}