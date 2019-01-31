<?php
namespace Docuware\Traits;

/**
* Defines dependency-injected constructor
* used by every class using `Traits\Platform`
*/
trait Common
{
    /**
     * Common constructor.
     * @param \Docuware\Platform $platform
     * @param array $properties
     */
    public function __construct(\Docuware\Platform $platform, array $properties = [])
    {
        set_exception_handler(array($this, "exceptionHandler"));

        $this->platform = $platform;

        foreach ($properties as $key => $prop) {
            $this->{$key} = $prop;
        }
    }

    /**
     * Main Exception handler
     * @param  \Exception $exception Exception object
     * @return string
     */
    public static function exceptionHandler($e)
    {
        http_response_code($e->getCode());
        echo "Exception: " . $e->getMessage();
    }


    /**
     * Generates XML object and returns encoded version
     * @param  object $object Input object
     * @param  string $format Format (JSON or XML)
     * @param  array  $namespaces array("key" => "label")
     * @return string
     * @throws \Exception
     */
    public function formatResult($object, $format = "JSON", $namespaces = [])
    {
        $xml = new \SimpleXMLElement($object);

        // Parses namespaces (if found)
        if (!empty($namespaces)){

            foreach ($namespaces as $namespace => $label){

                foreach($xml->children($namespace, true) as $child) {
                    
                    $xml->addChild($label, $child);

                }
            }
        }

        // Encodes result according to $format
        if ($format === "JSON") {
            header('Content-Type: application/json');
            return json_encode($xml);
        } elseif ($format === "XML") {
            header("Content-Type: text/xml; charset=utf-8");
            return $xml;
        } else {
            throw new \Exception("Invalid format: $format");
            return false;
        }
    
    }
    
}
