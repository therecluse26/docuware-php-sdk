<?php
namespace DocuWare;

class Utility
{
    /**
     * @param $string
     * @param $start
     * @param $end
     * @return bool|string
     *
     * Returns substring between two strings
     */
    public static function getStringBetween($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) {
            return '';
        }
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    /**
     * Translates DocuWare data types to HTML input types
     * @param  string $fieldType DocuWare field datatype
     * @return string]            HTML input type
     */
    public static function htmlDataType($fieldType)
    {
        $result = null;
        switch ($fieldType) {
            case "Text":
              $result = "text";
              break;
            case "Date":
              $result = "date";
              break;
            case "Numeric":
              $result = "number";
              break;
            default:
              $result = "text";
              break;
        }
        return $result;
    }

    /**
     * Returns formatted array from formData array
     * @param  array  $formData [description]
     * @return [type]           [description]
     */
    public static function formatFormData(array $formData)
    {
        $formatted = array();
        foreach ($formData as $field) {
            if ($field['value'] !== "") {
                $formatted[$field['name']] = $field['value'];
            }

        }

        return $formatted;
    }
}
