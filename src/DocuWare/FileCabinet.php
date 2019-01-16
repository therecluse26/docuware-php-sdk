<?php
namespace DocuWare;

class FileCabinet
{
    use Traits\Common;

    protected $fileCabinets;

    public function searchCabinetAttributeValue(array $array, $field, $value)
    {
        foreach ($array as $key => $elem) {
            if ($elem[$field] === $value) {
                return $key;
            }
        }
        return false;
    }

    /**
     * @param $fileCabinet
     * @param $attribute
     * @return mixed
     * @throws \Exception
     */
    public function getAttribute($fileCabinet, $attribute)
    {
        if ($this->platform->fileCabinets[$fileCabinet]) {
            return $this->platform->fileCabinets[$fileCabinet][$attribute];
        } else {
            foreach ($this->platform->fileCabinets->getElementsByTagName('FileCabinet') as $cabinet) {
                $this->platform->fileCabinets[$cabinet->getAttribute('Name')][$attribute] = $cabinet->getAttribute($attribute);
            }

            if ($this->platform->fileCabinets[$fileCabinet]) {
                return $this->platform->fileCabinets[$fileCabinet][$attribute];
            } else {
                throw new \Exception('File cabinet not found.');
            }
        }
    }

    /**
     * Loads all file cabinets into $this->platform->fileCabinets array
     * @throws \Exception
     */
    private function loadAllCabinets()
    {
        $path = "/FileCabinets";
        $pathOptions = ['orgid' => ['required' => true]];
        $pathParameters = ['orgid' => $this->platform->organizationId];
        $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));

        $dom = new \DOMDocument('1.0');
        $dom->loadXML($result);

        foreach ($dom->getElementsByTagName('FileCabinet') as $cabinet) {
            $this->platform->fileCabinets[$cabinet->getAttribute('Name')]['Name'] = $cabinet->getAttribute('Name');
            $this->platform->fileCabinets[$cabinet->getAttribute('Name')]['Id'] = $cabinet->getAttribute('Id');
        }
    }

    /**
     * Gets all file cabinets
     * @return string
     * @throws \Exception
     */
    public function getAll()
    {
        $path = "/FileCabinets?orgid={$this->platform->organizationId}";

        $result = $this->platform->getResource($this->platform->buildURL($path));

        return $this->formatResult($result);
    }


    /**
     * Get GUID of file cabinet by name
     * @throws \Exception
     */
    public function getGUID($fileCabinet)
    {
        if (!$this->platform->fileCabinets) {
            $this->loadAllCabinets();
        }

        $fileCabinet = $this->searchCabinetAttributeValue($this->platform->fileCabinets, 'Name', $fileCabinet);

        if (isset($this->platform->fileCabinets[$fileCabinet])) {
            header("Content-Type: text/plain");
            return $this->platform->fileCabinets[$fileCabinet]['Id'];
        } else {
            throw new \Exception("File cabinet '$fileCabinet' not found.");
        }
    }

    /**
     * Gets file cabinet Name by Id
     * @throws \Exception
     */
    public function getName($fileCabinetId)
    {
        try {
            if (!$this->platform->fileCabinets) {
                $this->loadAllCabinets();
            }
            $fileCabinet = $this->searchCabinetAttributeValue($this->platform->fileCabinets, 'Id', $fileCabinetId);

            if (isset($this->platform->fileCabinets[$fileCabinet])) {
                header("Content-Type: text/plain");
                return $this->platform->fileCabinets[$fileCabinet]['Name'];
            } else {
                throw new \Exception("File cabinet '$fileCabinetId' not found.");
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Gets file cabinet info by Name or Id
     * @throws \Exception
     */
    public function getInfo($paramType, $param)
    {
        try {
            if ($paramType === 'Name') {
                $fileCabinetGuid = $this->getGUID($param);
            } elseif ($paramType === 'Id') {
                $fileCabinetGuid = $param;
            } elseif ($paramType !== 'Id' && $paramType !== 'Name') {
                throw new \Exception('Must provide a file cabinet name or id');
            }

            $path = "/FileCabinets/{$fileCabinetGuid}";

            $result = $this->platform->getResource($this->platform->buildURL($path));
            return $this->formatResult($result);
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /**
     * Gets file cabinet dialogs of specified type
     * @throws \Exception
     */
    public function getDialogs($fileCabinetId, $dialogType)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Dialogs?dialogType={$dialogType}";

        $result = $this->platform->getResource($this->platform->buildURL($path));
        return $this->formatResult($result);
    }

    /**
     * Gets FileCabinet dialog info
     * @throws \Exception
     */
    public function getDialogInfo($fileCabinetId, $dialogId)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Dialogs/{$dialogId}";

        $result = $this->platform->getResource($this->platform->buildURL($path));
        return $this->formatResult($result);
    }


    /**
     * Gets existing values stored in field (also does fuzzy search by queryString)
     * @param  [type] $queryString [description]
     * @return [type]              [description]
     */
    public function getFieldValues($queryString = null)
    {
        if ($queryString) {
        } else {
        }
    }

    /**
     * Gets FileCabinet documents
     * @param  string $fileCabinetId File Cabinet ID
     * @return string JSON string of return data
     * @throws \Exception
     */
    public function getDocuments($fileCabinetId)
    {
        $path = "/FileCabinets/{$fileCabinetId}/Documents";

        $result = $this->platform->getResource($this->platform->buildURL($path));
        return $this->formatResult($result);
    }
}
