<?php require_once(__DIR__ . '/../vendor/autoload.php');

require 'connection.php';

use DocuWare\Platform as Platform;

$cabinet_name = 'Documents';
$docId = 10; //82;

// Argument variables pulled from `connection.php` file
$docuware = new Platform($host, $organization, $username, $password);

$fileCabinetId = $docuware->FileCabinet->getGUID($cabinet_name);

$result = $docuware->Document->getData($fileCabinetId, $docId);

$contact = $docuware->Fields->getFieldValue($result, 'contact');
