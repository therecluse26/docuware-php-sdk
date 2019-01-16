<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require 'connection.php';
use DocuWare\Platform as Platform;
try {
    $docuware = new Platform($host, $organization, $username, $password);
    $fileCabinets = json_decode($docuware->FileCabinet->getAll())->FileCabinet;
    unset($docuware);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

</head>
<body>

    <h3>File Cabinets</h3>

    <select id="FileCabinet" onchange="loadCabinet(this)">
        <?
            foreach($fileCabinets as $cabinet){
                echo "<option value='".$cabinet->{'@attributes'}->Id."'>".$cabinet->{'@attributes'}->Name."</option>";
            };
        ?>
    </select>

    <h4>Documents</h4>
        <select id="Document" onchange="loadDocument(this)">
    </select>

    <h4>Sections</h4>
        <select id="Section" onchange="loadSection(this)">
    </select>


</body>

<script>
    $(document).ready(function(){
        let cabinetSelect = document.getElementById('FileCabinet');
        loadCabinet(cabinetSelect);
    });

    function loadCabinet(elem){
        let fileCabinetId = elem.options[elem.selectedIndex].value;
        $.ajax({
            url: "return_filecabinet_all_documents.php?fileCabinetId=" + fileCabinetId,
            method: "GET",
            dataType: "json"
        }).done(function(resp){
            let docSelect = $("#Document");
            docSelect.html("");
            for (let key in resp){
                    for (let k in resp[key]['Item']) {
                        let item = resp[key]['Item'][k]['@attributes'];
                        docSelect.append("<option value='" + item['Id'] + "'>" + item['Title'] + "-" + item['Id'] + "</option>");
                    }

            }
        })
    }

    function loadDocument(elem){

        let fcElem = document.getElementById('FileCabinet');
        let fileCabinetId = fcElem.options[fcElem.selectedIndex].value;
        let documentId = elem.options[elem.selectedIndex].value;

        $.ajax({
            url: "return_document_sections.php?fileCabinetId=" + fileCabinetId + "&documentId=" + documentId,
            method: "GET",
            dataType: "json"
        }).done(function(resp){

            let sectionSelect = $("#Section");
            sectionSelect.html("");
            let count = 1;

            for (let key in resp){
                for (let k in resp[key]){
                    if ('Id' in resp[key][k]){
                        let item = resp[key][k]['Id'];
                        sectionSelect.append("<option value='"+item+"'>"+count+"</option>");
                        count++;
                    }
                }
            }
        })

    };
</script>
</html>
