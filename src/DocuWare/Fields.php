<?php
namespace DocuWare;

/**
 * Used to build and return a JSON object of index values for a document
 */
class Fields
{
    use Traits\GenericTypes;

    /**
     * Holds index values
     * @var array
     */
    private $fields = ['Fields' => []];

    /**
     * Validates the given value against the given type
     *
     * @param string $value Value to be written to the index field
     * @param string $type  Database type of the index field
     *
     * @throws \Exception if the given field type is invalid
     *
     * @return boolean Returns true if given value matches given type
     */
    private function validateField($value, $type)
    {
        if (array_key_exists($type, $this->fieldTypes)) {
            if ($type == 'Keywords') {
                return is_array($value);
            } else {
                return preg_match('/^' . $this->fieldTypes[$type]['regex'] . '$/', $value);
            }
        } else {
            throw new \Exception('Invalid field type: ' . $type);
        }
    }

    /**
     * Add a new field to Fields object
     *
     * @param string $name  Name of the index field
     * @param string $value Value to be written to the index field
     * @param string $type  Database type of the index field
     *
     * @throws \Exception if value does match the given type
     */
    public function addField($name, $value, $type)
    {
        if ($this->validateField($value, $type)) {
            switch ($type) {
                case 'Keywords':
                    $itemValue['Keyword'] = $value;
                    break;
                default:
                    $itemValue = $value;
            }

            array_push($this->fields['Fields'], ['FieldName' => $name,
                                                 'Item' => $itemValue,
                                                 'ItemElementName' => $type]);
        } else {
            throw new \Exception('Invalid value given for {$name} ({$type}): ' . $value);
        }
    }

    /**
     * Add a new field to Fields object
     *
     * @param array $fieldArray  Array of field data. Each entry requires "Name", "Value" and "Type" values to be set
     *
     * @throws \Exception if value does match the given type
     */
    public function addFieldArray($fieldArray)
    {
        foreach ($fieldArray as $field) {
            if (!array_key_exists('Name', $field) || !array_key_exists('Value', $field) || !array_key_exists('Type', $field)) {
                throw new \Exception('Invalid field data passed. Requires fields `Name`, `Value` and `Type`');
            }

            $name = $field['Name'];
            $value = $field['Value'];
            $type = $field['Type'];

            if ($this->validateField($value, $type)) {
                switch ($type) {
                    case 'Keywords':
                        $itemValue['Keyword'] = $value;
                        break;
                    default:
                        $itemValue = $value;
                }

                array_push($this->fields['Fields'], ['FieldName' => $name,
                                             'Item' => $itemValue,
                                             'ItemElementName' => $type]);
            } else {
                throw new \Exception('Invalid value given for {$name} ({$type}): ' . $value);
            }
        }
    }

    /**
    * Returns value of given field
    *
    * @return string
    */
    public function getFieldValue($fieldJSON, $fieldName)
    {
        $fieldArray = json_decode($fieldJSON, true);
        foreach ($fieldArray['Fields']['Field'] as $field) {
            if ($field['@attributes']['FieldName'] == strtoupper($fieldName) && !isset($field['@attributes']['IsNull'])) {
                return array_values($field)[1];
            }
        }
        return null;
    }

    /**
    * Returns Fields object as JSON
    *
    * @return string Returns Fields object as JSON
    */
    public function toString()
    {
        return json_encode($this->fields);
    }

    /**
     * Resets the Fields object
     */
    public function reset()
    {
        $this->fields = ['Fields' => []];
    }
}
