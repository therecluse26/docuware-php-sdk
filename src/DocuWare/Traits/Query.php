<?php
namespace Docuware\Traits;

/**
 * Defines dependency-injected constructor
 * used by every class using `Traits\Platform`
 */
trait Query
{
    /**
     * Model for query field arrays
     * `true` = required, `false` = optional
     * @var array
     */
    public static $queryFieldModel = ["key" => "value"];
    public $valResult;
    public $queryString = "";

    /**
     * Assembles query string from array (following $queryFieldModel)
     * @param array $fieldArray
     * @return array|string
     */
    public function assembleQueryString(array $fieldArray)
    {
        // Validates each field passed
        $this->validate($fieldArray);

        if ($this->valResult == "valid") {
            // Loops over fields
            foreach ($fieldArray as $name => $value) {
                if ($this->queryString === "") {
                    $this->queryString .= ";;And;;" . $name . ":" . $value . ";";
                } else {
                    $this->queryString .= $name . ":" . $value . ";";
                }
            }
            return rtrim($this->queryString, ";");
        } else {
            return $this->valResult;
        }
    }

    public function validate(array $arr)
    {
        try {
            if (!is_array($arr)) {
                throw new \Exception("Query fields must be arrays", 400);
            }

            foreach ($arr as $arrKey => $arrVal) {
                if ($arrKey == null) {
                    return;
                    //throw new \Exception("Cannot pass a null key to query field array", 400);
                }
            }

            $this->valResult = "valid";
        } catch (\Exception $e) {
            http_response_code($e->getCode());
            $this->valResult = $e->getMessage();
        }
    }
}
