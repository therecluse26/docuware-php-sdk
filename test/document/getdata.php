<?php
require_once(__DIR__ . '/../../vendor/autoload.php');
require "../connection.php";

use \DocuWare\Platform as Platform;

$cabId = $_GET['cabId'];
$docId = $_GET['docId'];

try {
    $docuware = new Platform($host, $organization, $username, $password);
    $result = $docuware->Document->getData($cabId, $docId);
    echo $result;
} catch (\Exception $e) {
    echo $e->getMessage();
}
