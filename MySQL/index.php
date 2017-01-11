<?php 
$host = 'localhost'; 
$database = 'testjob';
$user = 'root';
$password = '';

$link = mysqli_connect($host, $user, $password, $database) or die("Error " . mysqli_error($link));

$count = 0;

while($count--)
{
	$name = substr(md5(rand(0, 99)), 20);
	$desc = substr(md5(rand(0, 99)), 20);
	$date = '1997-10-04 22:23:00';
	$value = rand(0, 1276);
	
	$sql = '
		INSERT INTO `info`
		SET `name`="' . $name . '",
			`desc`="' . $desc . '"
	';
	mysqli_query($link, $sql);
	$last_info_id = mysqli_insert_id($link);
	
	$sql = '
		INSERT INTO `data`
		SET `date`="' . $date . '",
			`value`=' . $value . '
	';
	mysqli_query($link, $sql);
	$last_data_id = mysqli_insert_id($link);
	
	$sql = '
		INSERT INTO `link`
		SET `data_id`="' . $last_data_id . '",
			`info_id`=' . $last_info_id . '
	';
	
	mysqli_query($link, $sql);
}

$start = microtime();

//$query = mysqli_query($link, 'SELECT * FROM data,link,info WHERE link.info_id = info.id AND link.data_id = data.id');


//$query = mysqli_query($link, 'SELECT * FROM data JOIN link ON link.data_id = data.id JOIN info ON info.id = link.info_id');
$query = mysqli_query($link, 'SELECT count(*) FROM `data` JOIN `link` ON `link`.`data_id` = `data`.`id` JOIN `info` ON `info`.`id` = `link`.`info_id`');

if($query)
{
	echo microtime()-$start;
}

mysqli_close($link);

?>