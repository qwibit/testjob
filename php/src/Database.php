<?php

namespace src;

class Database
{
    /**
     * @var DI 
     */
    private $di;

    /**
     * @var \PDO
     */
    private $link;

    /**
     * @param \src\DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;

        $this->connect();
    }

    /**
     * @return $this
     */
    private function connect()
    {
        $dbConfig = $this->di->get('config')['db'];

        $dsn  = 'mysql:';
        $dsn .= 'host=' . $dbConfig['host'] . ';';
        $dsn .= 'dbname=' . $dbConfig['dbname'] . ';';
        $dsn .= 'charset=' . $dbConfig['charset'];

        $this->link = new \PDO(
            $dsn,
            $dbConfig['username'],
            $dbConfig['password']
        );

        return $this;
    }

    /**
     * @param string $sql
     * @return array
     */
    public function query($sql)
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if ($result === false) {
            return [];
        }

        return $result;
    }

    /**
     * @param string $sql
     * @return bool
     */
    public function execute($sql)
    {
        $sth = $this->link->prepare($sql);

        return $sth->execute();
    }
}
