<?php
namespace Docuware\Traits;

/**
* Defines default user schema
*/
trait UserSchema
{
    /**
     * User schema
     * @var array
     */
    private $userSchema = [ "properties" => [
                              "EMail" => ["Type" => "string", "Required" => true],
                              "DefaultWebBasket" => ["Type" => "string", "Required" => true, "Default" => "00000000-0000-0000-0000-000000000000"],
                              "OutOfOffice" => ["Type" => "object", "Required" => true,
                                "properties" => [
                                  "IsOutOfOffice" => ["Type" => "boolean", "Required" => false, "Default" => false],
                                  "StartDateTime" => ["Type" => "string", "Required" => false],
                                  "StartDateTimeSpecified" => ["Type" => "boolean", "Required" => true, "Default" => false],
                                  "EndDateTime" => ["Type" => "string", "Required" => false],
                                  "EndDateTimeSpecified" => ["Type" => "boolean", "Required" => true, "Default" => false],
                                ]
                              ],
                              "RegionalSettings" => ["Type" => "object", "Required" => true,
                                "properties" => [
                                  "Language" => ["Type" => "string", "Required" => true, "Default" => "en-US"],
                                  "Culture" => ["Type" => "string", "Required" => false],
                                  "Calendar" => ["Type" => "string", "Required" => false]
                                ]
                              ],
                              "Links" => ["Type" => "array", "Required" => false,
                                "items" => [
                                  "Type" => "object",
                                  "properties" => [
                                    "rel" => ["Type" => "string", "Required" => true],
                                    "href" => ["Type" => "string", "Required" => true],
                                    "type" => ["Type" => "string", "Required" => true]
                                  ]
                                ]
                              ],
                              "Id" => ["Type" => "string", "Required" => true],
                              "Name" => ["Type" => "string", "Required" => true],
                              "FirstName" => ["Type" => "string", "Required" => true],
                              "LastName" => ["Type" => "string", "Required" => true],
                              "Salutation" => ["Type" => "string", "Required" => true],
                              "DBName" => ["Type" => "string", "Required" => true],
                              "Active" => ["Type" => "boolean", "Required" => true, "Default" => true],
                              "NetworkId" => ["Type" => "string", "Required" => false]]];
}
