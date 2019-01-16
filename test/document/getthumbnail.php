<?php
require_once(__DIR__ . '/../../vendor/autoload.php');
require "../connection.php";

use \DocuWare\Platform as Platform;

$cabId = $_GET['cabId'];
$docId = $_GET['docId'];
$size = $_GET['size'];

try {
    $docuware = new Platform($host, $organization, $username, $password);
    $result = $docuware->Document->getThumbnail($cabId, $docId, $size);
    header('Content-type: image/jpeg');
    echo $result;
} catch (\Exception $e) {
    echo $e->getMessage();
}
