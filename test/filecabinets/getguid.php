<?php
require_once(__DIR__ . '/../../vendor/autoload.php');
require "../connection.php";

use \DocuWare\Platform as Platform;

$name = $_GET['name'];

try {
    $docuware = new Platform($host, $organization, $username, $password);
    $result = $docuware->FileCabinet->getGUID($name);
    echo $result;
} catch (\Exception $e) {
    echo $e->getMessage();
}