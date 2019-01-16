<?php
namespace Docuware\Traits;

/**
* Defines generic types
*/
trait GenericTypes
{
    /**
     * Array of possible dialog types
     * @var array
     */
    public static $dialogTypes = ["Unknown",
                                  "Search",
                                  "Store",
                                  "ResultList",
                                  "ResultTree",
                                  "InfoDialog",
                                  "TaskList"];

    /**
     * Array of possible index field types and their regex patterns
     * @var array
     */
    private $fieldTypes = ['String' => ['regex' => '.*'],
                          'Int' => ['regex' => '\d+'],
                          'Decimal' => ['regex' => '\d+(\.\d+)?'],
                          'Memo' => ['regex' => '.*'],
                          'Date' => ['regex' => '\d{4}-\d{2}-\d{2}'],
                          'DateTime' => ['regex' => '\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z'],
                          'Keywords'];
}
