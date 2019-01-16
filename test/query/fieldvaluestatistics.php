<?php
require_once(__DIR__ . '/../../vendor/autoload.php');
require "../connection.php";

use \DocuWare\Platform as Platform;

$fileCabinetId = $_GET['cabId'];
$field = $_GET['field'];

try {
    $docuware = new Platform($host, $organization, $username, $password);
    $result = $docuware->Query->fieldValueStatistics($fileCabinetId, $field);
    echo $result;
} catch (\Exception $e) {
    echo $e->getMessage();
}
