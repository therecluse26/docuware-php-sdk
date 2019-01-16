<?php
namespace DocuWare;

/**
 * User info class
 */
class User
{
    use Traits\Common;
    use Traits\UserSchema;

    /**
     * Returns info about one User by ID
     * @param string $userId User ID
     * @return string
     * @throws \Exception
     */
    public function getById($userId)
    {
        $path = "/Organizations/{$this->platform->organizationId}/UserByID";

        $pathOptions = ['userId' => ['required' => true]];
        $pathParameters = ['userId' => $userId];
        $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));

        return $this->formatResult($result);
    }

    /**
     * Returns all groups that user belongs to
     * @param string $userId User ID
     * @return string
     * @throws \Exception
     */
    public function groups($userId)
    {
        $path = "/Organizations/{$this->platform->organizationId}/UserGroups";

        $pathOptions = ['userId' => ['required' => true]];
        $pathParameters = ['userId' => $userId];
        $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));

        return $this->formatResult($result);
    }

    /**
     * Returns all roles that user belongs to
     * @param string $userId User ID
     * @return string
     * @throws \Exception
     */
    public function roles($userId)
    {
        $path = "/Organizations/{$this->platform->organizationId}/UserRoles";

        $pathOptions = ['userId' => ['required' => true]];
        $pathParameters = ['userId' => $userId];
        $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));

        return $this->formatResult($result);
    }


    public function update(Models\UserData $user)
    {
        $path = "/Organizations/{$this->platform->organizationId}/UserInfo";

        $userJson = json_encode($user);

        $result = $this->platform->postResource($this->platform->buildURL($path), $userJson, "application/json");

        return $result;
    }

    /**
     * Get all users
     * @return string JSON result set
     * @throws \Exception
     */
    public function getAll()
    {
        $path = "/Organizations/{$this->platform->organizationId}/Users";

        $result = $this->platform->getResource($this->platform->buildURL($path));

        return $this->formatResult($result);
    }
}
