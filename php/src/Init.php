<?php

namespace src;

final class Init
{
    const TEST_TABLE = 'test';

    const RESULTS = ['normal', 'illegal', 'failed', 'success'];

    /**
     * @var DI
     */
    private $di;

    /**
     * @var Database
     */
    private $db;

    /**
     * @param \src\DI $di
     */
    public function __construct(DI $di) {
        $this->di = $di;
        $this->db = $di->get('db');

        //$this->create();
        //$this->fill();
    }

    /**
     * @return bool
     */
    private function create() {
        $sql = '
            CREATE TABLE IF NOT EXISTS `' . self::TEST_TABLE . '` (
                `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                `script_name` VARCHAR(25) NOT NULL,
                `start_time` INT(11),
                `end_time` INT(11),
                `result` ENUM(\'normal\',\'illegal\',\'failed\',\'success\') DEFAULT \'normal\'
            )
        ';

        return $this->db->execute($sql);
    }

    /**
     * @return bool
     */
    public function fill()
    {
        $results = self::RESULTS;

        $i = 1000;

        while ($i--) {
            $scriptName = substr(md5(rand(0, 99)), 20);
            $startTime = time() + rand(0, 9999);
            $endName = $startTime + rand(0, 999);
            $result = $results[rand(0, 3)];

            $sql = '
                INSERT INTO `' . self::TEST_TABLE . '`
                SET `script_name`="' . $scriptName . '",
                    `start_time`=' . $startTime . ',
                    `end_time`=' . $endName . ',
                    `result`="' . $result . '"
            ';

            $this->db->execute($sql);
        }

        return true;
    }

    /**
     * @return array
     */
    public function get() {
        $sql = '
            SELECT *
            FROM `' . self::TEST_TABLE . '`
            WHERE `result` IN ("normal","success")
        ';

        return $this->db->query($sql);
    }
}
