<?php
require_once(__DIR__ . '/../../vendor/autoload.php');
require "../connection.php";

use \DocuWare\Platform as Platform;

$cabId = $_GET['cabId'];
$dialogId = $_GET['dialogId'];

try {
    $docuware = new Platform($host, $organization, $username, $password);
    $result = $docuware->FileCabinet->getDialogInfo($cabId, $dialogId);
    echo $result;
} catch (\Exception $e) {
    echo $e->getMessage();
}