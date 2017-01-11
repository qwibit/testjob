<?php 

define('PROCESS_DIR', 'datafiles');
define('PROCESS_EXTENSION', 'txt');

$files = scandir(PROCESS_DIR);
$processFiles = [];

foreach ($files as $file) {
    $pathInfo = pathinfo($file);

    if ($pathInfo['extension'] != PROCESS_EXTENSION) {
        continue;
    }

    if (!preg_match('/^[a-z0-9]+$/i', $pathInfo['filename'])) {
        continue;
    }

    $processFiles[] = $file;
}

print_r($processFiles);
?>