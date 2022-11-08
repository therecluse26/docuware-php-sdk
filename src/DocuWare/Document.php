<?php
namespace DocuWare;

class Document
{
    use Traits\Common;
    use Traits\GenericTypes;

    /**
     * Returns document data
     * @param  string $fileCabinetId File Cabinet ID
     * @param  string $docId Document ID
     * @return string
     * @throws \Exception
     */
    public function getData($fileCabinetId, $docId)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Documents/{$docId}";

        $result = $this->platform->getResource($this->platform->buildURL($path));

        return $this->formatResult($result, "JSON", ["s" => "Links", "test"=>"Blah"]);

    }

    /**
     * Returns binary data of document
     * @param  string $fileCabinetId File Cabinet ID
     * @param  string $docId Document ID
     * @return string
     * @throws \Exception
     */
    public function getBinaryData($fileCabinetId, $docId)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Documents/{$docId}/Data";

        $result = $this->platform->getResource($this->platform->buildURL($path));
        return $result;
    }

    /**
     * Returns all available links for given document
     * @param  string $fileCabinetId File Cabinet ID
     * @param  string $docId Document ID
     * @param  string $resultListId Result list ID
     * @return string
     * @throws \Exception
     */
    public function links($fileCabinetId, $docId, $resultListId = null)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Documents/{$docId}/DocumentLinks";

        if (!is_null($resultListId)) {
            $path = substr($path, 0, -1);
            $pathOptions = ['resultListId' => ['required' => true]];
            $pathParameters = ['resultListId' => $resultListId];
            $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));
        } else {
            $result = $this->platform->getResource($this->platform->buildURL($path));
        }

        return $this->formatResult($result);
    }

    /**
     * @param $fileCabinetId
     * @param string $format
     * @return string
     * @throws \Exception
     */
    public function getAll($fileCabinetId, $format = "JSON")
    {
        $path = "/FileCabinets/{$fileCabinetId}/Documents";

        $result = $this->platform->getResource($this->platform->buildURL($path));
        return $this->formatResult($result, $format);
    }

    /**
     * Upload a document to the cabinet
     *
     * @param string $fileCabinetId File cabinet GUID
     * @param string $file File path
     * @param string $fields JSON/XML object containing index data
     * @param array $pathParameters Array of all optional url parameters:
     *              $pathParameters = [
     *                'processTextshot' => (boolean) This parameter specifies if the document is processed and a text
     *                                               shot is extracted for further processing. If this parameter is
     *                                               missing or true then the text shot is created after the document
     *                                               has been uploaded. If the parameter is false then the text shot
     *                                               is not created, and it is neccessary to upload the text shot with
     *                                               a subsequent request in order to benefit fromany further text shot
     *                                               processing.
     *                'imageProcessing' => (boolean) Define if image processing is executed when document is stored
     *                'redirect' => (string) After the request is successfully finished you are redirected to the
     *                                       specified URI.
     *                'storeDialogId' => (string) Id of the store dialog from which the document is stored
     *                'checkFileNameForCheckinInfo' => (bool) Define whether to check file name for checkin information
     *              ]
     *
     * @return string Returns XML document
     * @throws \Exception
     */
    public function upload($fileCabinetId, $file, $fields, $pathParameters = null,$docId=null)
    {
        $type = null;
        $path = "/FileCabinets/{$fileCabinetId}/Documents";
        $pathOptions = ['processTextshot' => ['required' => false],
                           'imageProcessing' => ['required' => false],
                           'redirect' => ['required' => false],
                           'storeDialogId' => ['required' => false],
                           'checkFileNameForCheckinInfo' => ['required' => false]];
        $boundary = md5(time());

        $content = "--".$boundary."\r\n" .
                   "Content-Disposition: attachment; filename=document.json; name=document\r\n" .
                   "Content-Type: application/json; charset=utf-8\r\n\r\n" .
                   $fields . "\r\n" .
                   "--".$boundary . "\r\n";
        if (empty($file)){
            $content .= "Content-Disposition: attachment; filename=\"none\"\r\n" .
                   "Content-Type: text/xml \r\n\r\n" .
                   "--" . $boundary . "--\r\n";
        }else{
            $fileInfo = pathinfo($file);
            $content .= "Content-Disposition: attachment; filename=\"" . $fileInfo['basename'] . "\"\r\n" .
                   "Content-Type: " . mime_content_type($file) . "\r\n\r\n" .
                   file_get_contents($file) . "\r\n" .
                   "--" . $boundary . "--\r\n";
        }
        $content .= "\r\n";
        if(!empty($docId)){
            $path = "/FileCabinets/{$fileCabinetId}/Documents/{$docId}";
        }

        if (!empty($docId) && empty($file)){
            $type = "application/json";
            $path = "/FileCabinets/{$fileCabinetId}/Documents/{$docId}/Fields";
            $content = str_replace('{"Fields":[{','{"Field":[{',$fields);  
            //$content = '{"Field":[{"FieldName":"DOCUMENT_TYPE","Item":"Pedido Compra","ItemElementName":"String"},{"FieldName":"NIF_EMISOR","Item":"prueba2","ItemElementName":"String"},{"FieldName":"NUMERO_DEL_PEDIDO","Item":"3097","ItemElementName":"String"},{"FieldName":"FECHA_DE_EXPEDICION","Item":"2022-06-20","ItemElementName":"Date"},{"FieldName":"IMPORTE_NETO_TOTAL","Item":33.1,"ItemElementName":"Decimal"},{"FieldName":"IMPORTE_BRUTO","Item":33.1,"ItemElementName":"Decimal"}]}';
            //error_log(print_r($content,true));                
        }

        $url = $this->platform->buildURL($path, $pathOptions);
        $result = $this->platform->postResource($url, $content, $type, $boundary);

        return $result;
    }

    // Might be nisnamed
    /**
     * @param $fileCabinetId
     * @param $docId
     * @param $file
     * @return mixed
     * @throws \Exception
     */
    public function append($fileCabinetId, $docId, $file)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Documents/{$docId}";

        $pathOptions = ['processTextshot' => ['required' => false],
                        'imageProcessing' => ['required' => false],
                        'redirect' => ['required' => false],
                        'storeDialogId' => ['required' => false],
                        'checkFileNameForCheckinInfo' => ['required' => false]];
        $fileInfo = pathinfo($file);
        $boundary = md5(time());

        $content = "--".$boundary . "\r\n" .
                   "Content-Disposition: attachment; filename=\"" . $fileInfo['basename'] . "\"\r\n" .
                   "Content-Type: " . mime_content_type($file) . "\r\n\r\n" .
                   file_get_contents($file) . "\r\n" .
                   "--" . $boundary . "--\r\n\r\n";


        $url = $this->platform->buildURL($path, $pathOptions);
        $result = $this->platform->postResource($url, $content, null, $boundary);

        return $result;
    }

    /**
     * Download a document
     *
     * @param string $fileCabinetId File cabinet GUID
     * @param string $docId DWDOCID
     * @param array $pathParameters Array of all optional url parameters:
     * @return string Returns file
     * @throws \Exception
     */
    public function download($fileCabinetId, $docId, $pathParameters = null)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Documents/{$docId}/FileDownload";
        $pathOptions = ['targetFileType' => ['required' => false],
                        'keepAnnotations' => ['required' => false],
                        'downloadFile' => ['required' => false],
                        'autoPrint' => ['required' => false],
                        'sendByEmail' => ['required' => false],
                        'layers' => ['required' => false],
                        'append' =>['required' => false]];

        $url = $this->platform->buildURL($path, $pathOptions, $pathParameters);
        $result = $this->platform->getResource($url);

        return $result;
    }

    // IN PROGRESS

    /**
     * @param $fileCabinetId
     * @param $docId
     * @param $clipIds
     * @param string $operation
     * @return mixed
     * @throws \Exception
     */
    public function clip($fileCabinetId, $docId, $clipIds, $operation = 'Clip')
    {
        $path = "/FileCabinets/{$fileCabinetId}/Operations/ClippedDocuments";
        $pathOptions = ['docId' => ['required' => true,
                                    'type' => 'int'],
                        'operation' => ['required' => false,
                                        'options' => ['Clip','Staple']]];

        $pathParameters['docId'] = $docId;
        $pathParameters['operation'] = $operation;

        $content = json_encode(["Int" => $clipIds]);
        $contentType = 'application/json';
        $result = $this->platform->postResource($this->platform->buildURL($path, $pathOptions, $pathParameters), $content, $contentType);
        return $result;
    }


    /**
     * @param $fileCabinetId
     * @param $docId
     * @return mixed
     * @throws \Exception
     */
    public function unclip($fileCabinetId, $docId)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Operations/Unclip";
        $pathOptions = ['docId' => ['required' => true]];

        $pathParameters['docId'] = $docId;

        $result = $this->platform->postResource($this->platform->buildURL($path, $pathOptions, $pathParameters));
        return $result;
    }

    /**
     * @param $fileCabinetId
     * @param $docId
     * @return mixed
     * @throws \Exception
     */
    public function unlock($fileCabinetId, $docId)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Documents/{$docId}/Lock";

        $result = $this->platform->deleteResource($this->platform->buildURL($path));
        return $result;
    }

    /**
     * @param $docId
     * @param $fileCabinetId
     * @param null $resultList
     * @return string
     * @throws \Exception
     */
    public function view($fileCabinetId, $sectionId, $pageNumber, $format = "pdf")
    {
        switch ($format) {
            case "png":
                $format="image/png";
                break;
            case "pdf":
                $format="application/pdf";
                break;
            case "jpg":
                $format="image/jpeg";
                break;
            default:
                $format = "application/pdf";
                break;
        }
        $path = "/FileCabinets/{$fileCabinetId}/Rendering/{$sectionId}/Image";

        $pathParameters['page'] = $pageNumber;
        $pathParameters['format'] = $format;
        $pathOptions = ['page' => ['required' => true], 'format' => ['required' => true]];

        $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));

        header('Content-Type: ' . $format . '; Content-Disposition: attachment; filename="image."'.$format);

        return $result;
    }

    /**
     * Gets document sections
     * @param $docId
     * @param $fileCabinetId
     * @return mixed
     * @throws \Exception
     */
    public function getSections($fileCabinetId, $docId)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Sections";

        $pathOptions = ['docid' => ['required' => true]];

        $pathParameters['docid'] = $docId;

        $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));
        return $this->formatResult($result);
    }

    /**
     * Gets document thumbnail
     * @param $docId
     * @param $fileCabinetId
     * @param $size
     * @return mixed
     * @throws \Exception
     */
    public function getThumbnail($fileCabinetId, $docId, $size = null)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Documents/{$docId}/Thumbnail?&annotations=False";

        if ($size !== null) {
            $path .= "&size=" . $size;
        }
  
        $result = $this->platform->getResource($this->platform->buildURL($path));
        return $result;
    }
}
