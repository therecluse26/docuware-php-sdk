<?php
require_once(__DIR__ . '/../../vendor/autoload.php');
require "../connection.php";

use \DocuWare\Platform as Platform;

$cabId = $_GET['cabId'];

try {
    $docuware = new Platform($host, $organization, $username, $password);
    $result = $docuware->FileCabinet->getDocuments($cabId);
    echo $result;
} catch (\Exception $e) {
    echo $e->getMessage();
}