<?php
namespace Core\Database;

class QueryBuilder
{

    protected $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Select all records from a json file.
     *
     * @param string $file
     */
    public function selectAll($file)
    {
        return $this->connection->get($file);
    }

}