<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require 'connection.php';

use DocuWare\Platform as Platform;

$fileCabinetId = $_GET['fileCabinetId'];

try {
    $docuware = new Platform($host, $organization, $username, $password);
    $result = $docuware->FileCabinet->getDocuments($fileCabinetId);
    unset($docuware);
    echo $result;
} catch (\Exception $e) {
    $respCode = http_response_code();
    echo $respCode;
}