<?php require_once(__DIR__ . '/../vendor/autoload.php');

use DocuWare\Platform as Platform;

$file = "/path/to/doc.pdf";

$fields = new DocuWare\Fields;

$fields->addFieldArray([
                        ["Name" => "DEPARTMENT", "Value" => "IT", "Type" => "String"],
                        ["Name" => "LAST_NAME", "Value" => "Patterson", "Type" => "String"],
                        ["Name" => "FIRST_NAME", "Value" => "Test", "Type" => "String"],
                        ["Name" => "DOCUMENT_TYPE", "Value" => "Resume", "Type" => "String"],
                        ["Name" => "STATUS", "Value" => "New", "Type" => "String"],
                        ["Name" => "DATE_OF_BIRTH", "Value" => "1985-05-11", "Type" => "Date"],
                        ["Name" => "E_MAIL", "Value" => "test.patterson@test.com", "Type" => "String"]
                      ]);

try {
    $docuware = new Platform($host, $organization, $username, $password);
    $hrid = $docuware->FileCabinet->getGUID('HR');
    echo($docuware->Document->upload($hrid, $file, $fields->toString()));
} catch (\Exception $e) {
    //echo $e->getMessage();
    $respCode = http_response_code();
    echo $respCode;
    print_r($e->getMessage());
}
