<?php
namespace DocuWare;

/**
 * User Account class
 */
class Account
{
    use Traits\Common;

    // NOT YET WORKING
    /**
     * @param string $newPassword
     * @return mixed
     * @throws \Exception
     */
    public function changePassword(string $newPassword)
    {
        $path = '/Account/ChangePassword';

        $connectionData = $this->platform->returnConnectionData();

        $data = [
                  'UserName' => $connectionData['username'],
                  'OldPassword' => $connectionData['password'],
                  'NewPassword' => $newPassword,
                  'ConfirmPassword' => $newPassword,
                  'Organization' => $connectionData['organization']
                ];

        $model = http_build_query($data, '', '', PHP_QUERY_RFC1738);

        $pathParameters = ['model' => ['required' => true]];
        $pathArguments = ['model' => $model];
        $result = $this->platform->postResource(
            $this->platform->buildURL($path, $pathParameters, $pathArguments)
        );

        return $result;
    }

    public function logOff()
    {
        $path = "/Account/LogOff";

        $result = $this->platform->getResource($this->platform->buildURL($path));
        return $result;
    }

    public function logOn($model = null)
    {
        $path = "/Account/LogOn";

        $result = $this->platform->getResource($this->platform->buildURL($path));
        return $result;
    }

    public function register($username, $password)
    {
        //
    }
}
