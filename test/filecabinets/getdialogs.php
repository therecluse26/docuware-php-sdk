<?php
require_once(__DIR__ . '/../../vendor/autoload.php');
require "../connection.php";

use \DocuWare\Platform as Platform;

$cabId = $_GET['cabId'];
$dialogType = $_GET['dialogType'];

try {
    $docuware = new Platform($host, $organization, $username, $password);
    $result = $docuware->FileCabinet->getDialogs($cabId, $dialogType);
    echo $result;
} catch (\Exception $e) {
    echo $e->getMessage();
}