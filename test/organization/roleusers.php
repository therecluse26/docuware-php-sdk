<?php
require_once(__DIR__ . '/../../vendor/autoload.php');
require "../connection.php";

use \DocuWare\Platform as Platform;

$id = $_GET['id'];

try {
    $docuware = new Platform($host, $organization, $username, $password);
    $result = $docuware->Organization->roleUsers($id);
    echo $result;
} catch (\Exception $e) {
    echo $e->getMessage();
}