<?php
namespace DocuWare;

/**
 * Basic DocuWare platform object.
* Define specific object-related
* callers here
 * @property mixed Document
 * @property mixed FileCabinet
 * @property mixed Account
 */
class Platform extends Connect
{
    public $fileCabinets;
    private $classes = [];

    public function __construct()
    {
        parent::__construct(...func_get_args());
    }

    /**
     * Checks if called class exists,
     * instantiates and returns it
     * @throws \Exception
     */
    public function __get($property)
    {
        if (class_exists(__NAMESPACE__ . "\\" .$property)) {
            if (!array_key_exists($property, $this->classes)) {
                $class = __NAMESPACE__ . "\\" . $property;
                $this->classes[$property] = new $class($this);
            }
            return $this->classes[$property];
        } else {
            throw new \Exception("Call to undefined variable: {$property}");
        }
    }
}
