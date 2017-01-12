<?php

$host = 'localhost';
$database = 'testjob';
$user = 'root';
$password = '';

$link = mysqli_connect($host, $user, $password, $database) or die('Error ' . mysqli_error($link));

$count = 0; // TODO: Need to set the rows number

while ($count--) {
    $name = substr(md5(rand(0, 99)), 20);
    $desc = substr(md5(rand(0, 99)), 20);
    $date = '1997-10-04 22:23:00';
    $value = rand(0, 1276);

    $sql = '
        INSERT INTO `data`
        SET `date`=' . $date . ',
            `value`=' . $value;

    mysqli_query($link, $sql);
    $lastDataId = mysqli_insert_id($link);
    if (!$lastDataId) {
        continue;
    }

    $sql = '
        INSERT INTO `info`
        SET `name`="' . $name . '",
            `desc`="' . $desc . '"
    ';

    mysqli_query($link, $sql);
    $lastInfoId = mysqli_insert_id($link);
    if (!$lastInfoId) {
        continue;
    }

    $sql = '
        INSERT INTO `link`
        SET `data_id`=' . $lastDataId . ',
            `info_id`=' . $lastInfoId . '
    ';

    mysqli_query($link, $sql);
}

$start = microtime(true);

//$query = mysqli_query($link, 'SELECT * FROM data,link,info WHERE link.info_id = info.id AND link.data_id = data.id');
//$query = mysqli_query($link, 'SELECT * FROM data JOIN link ON link.data_id = data.id JOIN info ON info.id = link.info_id');
$query = mysqli_query($link, 'SELECT count(*) FROM `data` JOIN `link` ON `link`.`data_id` = `data`.`id` JOIN `info` ON `info`.`id` = `link`.`info_id`');

if ($query) {
    echo microtime(true) - $start;
} else {
    echo 'Error ' . mysqli_error($link);
}
