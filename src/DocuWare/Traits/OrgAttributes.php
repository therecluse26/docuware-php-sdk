<?php
namespace Docuware\Traits;

/**
 * Pulls organizational attributes from tmp file
 */
trait OrgAttributes
{
    private $organizationInfo = [];
    private $tmpDir; 

    public function pullAttributes()
    {
        try {
            $this->tmpDir = dirname(dirname(dirname(__DIR__))).DIRECTORY_SEPARATOR."tmp";
            
            $orgPath = realpath($this->tmpDir).DIRECTORY_SEPARATOR."dworginfo";

            if ($orgFile = @fopen($orgPath, "r")) {
                $res = fread($orgFile, filesize($orgPath));
                fclose($orgFile);

                $parsed = json_decode($res, true);
                $this->loadOrgInfo($parsed);
            } else {
                throw new \Exception("Couldn't open file");
            }
            return true;
            
        } catch (\Exception $e) {
            http_response_code($e->getCode());
            $this->valResult = $e->getMessage();
        }
    }

    public function loadOrgInfo($array)
    {
        foreach ($array['@attributes'] as $attKey => $attVal) {
            $this->organizationInfo[$attKey] = $attVal;
        }

        foreach ($array['AdditionalInfo']['@attributes'] as $addKey => $addVal) {
            $this->organizationInfo[$addKey] = $addVal;
        }

        $this->organizationInfo['CompanyNames'] = $array['AdditionalInfo']['CompanyNames'];

        foreach ($array['AdditionalInfo']['AddressLines'] as $addrKey => $addrVal) {
            $this->organizationInfo[$addrKey] = $addrVal;
        }
    }

    public function fetchAttribute($name)
    {
        try {
            $this->pullAttributes();
            return $this->organizationInfo[$name];
        } catch (\Exception $e) {
            return $e->getMessage;
        }
    }
}
