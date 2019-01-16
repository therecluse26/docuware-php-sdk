<?php require_once(__DIR__ . '/../vendor/autoload.php');

require 'connection.php';

use DocuWare\Platform as Platform;

$cabinet_name = 'HR';

try {
    $docuware = new Platform($host, $organization, $username, $password);
    $result = $docuware->User->getAll();

    echo $result;
} catch (\Exception $e) {
    $respCode = http_response_code();
    echo $respCode;
    print_r($e->getMessage());
}
