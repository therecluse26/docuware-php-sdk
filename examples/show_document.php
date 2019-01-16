<?php require_once(__DIR__ . '/../vendor/autoload.php');

require 'connection.php';

use DocuWare\Platform as Platform;

$cabinet_name = 'HR';
$format = "jpg";

try {
    // Argument variables pulled from `connection.php` file
    $docuware = new Platform($host, $organization, $username, $password);

    $fileCabinetId = $docuware->FileCabinet->getGUID($cabinet_name);

    $result = $docuware->Document->view($fileCabinetId, "20-0", "0", $format);

    header('Content-Type: ' . $format . '; Content-Disposition: attachment; filename="image."' . $format);

    //$logoff = $docuware->Account->logOff();

    echo $result;

} catch (\Exception $e) {
    $respCode = http_response_code();
    echo $e->getMessage();
}

