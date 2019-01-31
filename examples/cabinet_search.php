<?php
require(__DIR__ . '/../vendor/autoload.php');
require 'connection.php';
use DocuWare\Platform as Platform;

// File Cabinet ID
$cabId = "ce765ff9-8a22-4d92-b7e4-11b744dcfca4";
// Search Dialog ID
$dialogId = "6c75d60e-4143-48d6-b942-5b68606b85de";

$docuware = new Platform($host, $organization, $username, $password);
$dialogInfo = @$docuware->FileCabinet->getDialogInfo($cabId, $dialogId);
$fields = json_decode($dialogInfo)->Fields;
header("Content-Type: text/html");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/searchcabinet.css">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div id="fields" class="col-sm-6">
      <button id="search" class="btn btn-primary btn-block">Search</button>
    <form class="form-inline" id="dwSearch">
    <?php

      foreach ($fields->Field as $field) {
          $name = $field->{'@attributes'}->DBFieldName;
          $label = $field->{'@attributes'}->DlgLabel;
          $readonly = null;
          if (property_exists($field->{'@attributes'}, 'ReadOnly')) {
              $readonly = $field->{'@attributes'}->ReadOnly ? "readonly" : "";
          }
          $prefillValue = null;

          if (property_exists($field, 'PrefillValue')) {
              $prefillValue = $field->{'PrefillValue'}[0]->String;
          }

          $type = \DocuWare\Utility::htmlDataType($field->{"@attributes"}->DWFieldType);

          if ($type == "date") {
              echo "<div class='col-sm-4'>
                  <label class='control-label' style='font-size:10px' for='$name'>$label</label>
                  <input class='form-control form-control-sm' type='text' name='$name' id='$name' placeholder='$label' value='$prefillValue' $readonly onfocus='(this.type=\"date\")' onblur='(this.type=\"text\")'></input>
                </div>";
          } else {
              echo "<div class='col-sm-4'>
                    <label class='control-label' style='font-size:10px' for='$name'>$label</label>
                    <input class='form-control form-control-sm' type='$type' name='$name' id='$name' placeholder='$label' value='$prefillValue' $readonly >
                  </div>";
          }
      }

      echo "</form>";
      echo '<input type="hidden" id="fileCabinetId" value="'.$cabId.'"/>
            <input type="hidden" id="dialogId" value="'.$dialogId.'"/>';

    ?>
    </div>
    <div class="col-sm-6 text-center">
      <div id="controls">
        <form class="form-inline">
          <label for="count">Count</label>
          <select name="count" id="count" class="form-control form-control-sm">
            <option value="5">5</option>
            <option value="10" selected>10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="250">250</option>
            <option value="500">500</option>
          </select>&nbsp;
          <label for="sortOrder">Sort Order</label>
          <select name="sortOrder" id="sortOrder" class="form-control form-control-sm">
            <option value="Asc" selected>Ascending</option>
            <option value="Desc">Descending</option>
          </select>&nbsp;
          <button class="btn btn-sm btn-warning" id="leftEndBtn"> << </button>
          <button class="btn btn-sm btn-warning" id="leftPageBtn"> < </button>
          <button class="btn btn-sm btn-warning" id="rightPageBtn"> > </button>
          <button class="btn btn-sm btn-warning" id="rightEndBtn"> >> </button>
        </form>
      </div>
      <div id="result"></div>
    </div>
  </div>
</div>
<script>
  var docStart = 0;
  var docDisplayCount = parseInt($("#count").val());
  var docSortOrder = $("#sortOrder").val();
  var docCount = 0;
  var rng = Math.floor(Math.random() * 1000000000);

  $(document).ready(function(){

    $(document).ajaxStart(function(){
         let resultList = $("#result");
         resultList.empty();
         resultList.html("<img src='assets/spinner1.svg' width='100px' class='align-middle'>");
     });

     //Left and right page buttons
     $("#leftEndBtn").click(function(e){
       e.preventDefault();
       docStart = 0;
       $("#search").click();
     });

     $("#leftPageBtn").click(function(e){
       e.preventDefault();
       docDisplayCount = parseInt($("#count").val());
       let tmpStart = docStart - docDisplayCount;
       if (tmpStart <= 0){
         docStart = 0;
       } else {
         docStart = tmpStart;
       }
       $("#search").click();
     });

     $("#rightPageBtn").click(function(e){
       e.preventDefault();
       docDisplayCount = parseInt($("#count").val());
       let tmpStart = docStart + docDisplayCount;
       if (tmpStart >= docCount){
         docStart = docCount - docDisplayCount;
       } else {
         docStart = tmpStart;
       }
       $("#search").click();
     });

     $("#rightEndBtn").click(function(e){
       e.preventDefault();
       docDisplayCount = parseInt($("#count").val());
       let tmp = (docCount - docDisplayCount);
       if (tmp >= 1){
         docStart = tmp;
       } else {
         docStart = 0;
       }
       $("#search").click();
     });
  });

  $("#search").click(function(){

    docDisplayCount = parseInt($("#count").val());
    docSortOrder = $("#sortOrder").val();

    var baseServerUrl = "<?= $base_api_url ?>";

    var formData = $("#dwSearch").find("input").filter(function() {
                      return this.value != "";
                    }).serializeArray();

    var fileCabinetId = $("#fileCabinetId").val();
    var dialogId = $("#dialogId").val();

    $.ajax({
      url: baseServerUrl + "/test/query/searchcabinet.php",
      data: {"cabId":fileCabinetId, "dialogId":dialogId, "fields":formData, "start": docStart, "count": docDisplayCount, "sortOrder": docSortOrder},
      method: "POST"

    }).done(function(resp) {

      let resultDiv = $("#result");

      resultDiv.html("<div>Showing documents "+docStart+" - "+(docStart + docDisplayCount)+" of "+resp.Count+"</div>");

      resultDiv.append("");

      docCount = resp.Count;

      if (resp.Count > 1){

        console.log(resp);

        for (doc of resp.Items.Item){

          let docLink = baseServerUrl + "/test/document/getdata.php?cabId=" + fileCabinetId + "&docId=" + doc["@attributes"].Id;
          resultDiv.append("<div class='d-block'><a href='"+docLink+"'>"+doc["@attributes"].Id+ " - "+ doc["@attributes"].Title +"</a>" + "</div>");

        };

      } else if (resp.Count == 1) {

          let docLink = baseServerUrl + "/test/document/getdata.php?cabId=" + fileCabinetId + "&docId=" + resp.Items.Item["@attributes"].Id;
          resultDiv.append("<div class='d-block'><a href='"+docLink+"'>"+resp.Items.Item["@attributes"].Id+ " - "+ resp.Items.Item["@attributes"].Title +"</a>" + "</div>");

      }

    }).fail(function(err){
      let resultDiv = $("#result");
      resultDiv.empty();
      resultDiv.html(err.responseText);
      console.log(err);
    });

  });


</script>
</body>
</html>
