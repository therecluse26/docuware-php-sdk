<?php
require_once(__DIR__ . '/../../vendor/autoload.php');
require "../connection.php";

use \DocuWare\Platform as Platform;

$fileCabinetId = $_POST['cabId'];
$dialogId = $_POST['dialogId'];
$filterArray = array_key_exists('fields', $_POST) ? $_POST['fields'] : [];
$sortOrder = array_key_exists('sortOrder', $_POST) ? $_POST['sortOrder'] : null;
$start = array_key_exists('start', $_POST) ? $_POST['start'] : null;
$count = array_key_exists('count', $_POST) ? $_POST['count'] : null;

$filters = \DocuWare\Utility::formatFormData($filterArray);

try {
    $docuware = new Platform($host, $organization, $username, $password);
    $result = $docuware->Query->searchCabinet($fileCabinetId, $dialogId, $filters, $sortOrder, $start, $count);
    echo $result;
} catch (\Exception $e) {
    echo $e->getMessage();
}
