<?php
require_once(__DIR__ . '/../../vendor/autoload.php');
require "../connection.php";

use \DocuWare\Platform as Platform;

$parmType = $_GET['parmtype'];
$parmVal = $_GET['parmval'];

try {
    $docuware = new Platform($host, $organization, $username, $password);
    $result = $docuware->FileCabinet->getInfo($parmType, $parmVal);
    echo $result;
} catch (\Exception $e) {
    echo $e->getMessage();
}