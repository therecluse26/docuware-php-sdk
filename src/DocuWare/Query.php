<?php
namespace DocuWare;

class Query
{
    use Traits\Common;
    use Traits\Query;
    use Traits\OrgAttributes;

    public $resultSet;

    public function searchCabinet($fileCabinetId, $dialogId, $filters = [], $sort = null, $start = null, $count = null, $returnedFields = null)
    {
        $pathPrefix = "dialog;{$dialogId}";
        if (!empty($filters)) {
            $queryString = $this->assembleQueryString($filters);
        } else {
            $queryString = $this->assembleQueryString(array("DWDOCID"));
        }

        //Pulls DW Version
        preg_match("/(: )([0-9])( \()/", $this->fetchAttribute('RuntimeVersion'), $version);

        // Formats query string differently based on DW version
        if ($version[2] >= 7) {
            $formattedString = base64_encode("{$pathPrefix}{$queryString}");
        } else {
            $formattedString = urlencode("{$pathPrefix}{$queryString}");
        }

        $path = "/FileCabinets/{$fileCabinetId}/Query/Documents?q={$formattedString}";

        $path .= !is_null($returnedFields) ? "&fields=$returnedFields" : null;
        $path .= !is_null($sort) ? "&sortOrder=$sort" : null;
        $path .= !is_null($start) ? "&start=$start" : null;
        $path .= !is_null($count) ? "&count=$count" : null;

        $url = $this->platform->buildURL($path);

        $this->resultSet = $this->formatResult($this->platform->getResource($url));

        return $this->resultSet;
    }

    public function documentCount($fileCabinetId, $fieldName){

        $path = "/FileCabinets/{$fileCabinetId}/Query/CountExpression";
        
        $data = [
                    "FieldName" => $fieldName, 
                    "Count" => $count, 
                    "Start" => $start, 
                    "Limit" => $limit, 
                    "SortDirection" => $sortDirection, 
                    "ExcludeExternal" => $excludeExternal,
                    "Typed" => $typed
                ];

        $postData = \http_build_query($data);

        $url = $this->platform->buildURL($path);

        $this->resultSet = $this->formatResult($this->platform->getResource($url, $postData));

        return $this->resultSet;

    }

    /**** THIS ENDPOINT IS MISSING IN V7 ****/
    public function fieldValueStatistics($fileCabinetId, $fieldName, $count = 0, $start = 0, $limit = 0, $sortDirection = "Default", $excludeExternal = false, $typed = false){

        $path = "/FileCabinets/{$fileCabinetId}/Query/FieldValueStatistics";
        
        $data = [
                    "FieldName" => $fieldName, 
                    "Count" => $count, 
                    "Start" => $start, 
                    "Limit" => $limit, 
                    "SortDirection" => $sortDirection, 
                    "ExcludeExternal" => $excludeExternal,
                    "Typed" => $typed
                ];

        $postData = \http_build_query($data);

        $url = $this->platform->buildURL($path);

        $this->resultSet = $this->formatResult($this->platform->postResource($url, $postData));

        return $this->resultSet;

    }
}
