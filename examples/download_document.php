<?php require_once(__DIR__ . '/../vendor/autoload.php');

require 'connection.php';

use DocuWare\Platform as Platform;

$cabinet_name = 'Documents';
$docId = 82;
$format = "jpg";
$pathParameters = ['targetFileType' => 'pdf',
                    'keepAnnotations' => true];

try {
    // Argument variables pulled from `connection.php` file
    $docuware = new Platform($host, $organization, $username, $password);

    $fileCabinetId = $docuware->FileCabinet->getGUID($cabinet_name);

    $result = $docuware->Document->download($fileCabinetId, $docId, $pathParameters);
    file_put_contents('test.pdf', $result);
    //$logoff = $docuware->Account->logOff();

    print_r($logoff);
} catch (\Exception $e) {
    $respCode = http_response_code();
    echo $e->getMessage();
}
