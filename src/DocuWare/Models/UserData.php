<?php
namespace DocuWare\Models;

class UserData
{
    use \DocuWare\Traits\UserSchema;

    public $properties;

    public function __construct($userData)
    {
        foreach ($userData as $userKey => $userProp) {
            if (array_key_exists($userKey, $this->userSchema["properties"])) {
                $this->properties->{$userKey} = $userData[$userKey];
            }
        }
    }
}
