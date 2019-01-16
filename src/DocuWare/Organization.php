<?php
namespace DocuWare;

/**
 * Organization-related methods
 */
class Organization
{
    use Traits\Common;
    use Traits\GenericTypes;

    /**
     * Returns all basic Organization info
     * @return string
     * @throws \Exception
     */
    public function getInfo()
    {
        $path = '/Organizations/'.$this->platform->organizationId;
        $result = $this->platform->getResource($this->platform->buildURL($path));
        return $this->formatResult($result, "JSON");
    }

    /**
     * Returns all Organization web settings
     * @return string
     * @throws \Exception
     */
    public function webSettings()
    {
        $path = '/Organizations/'.$this->platform->organizationId.'/WebSettings';
        $result = $this->platform->getResource($this->platform->buildURL($path));
        return $this->formatResult($result);
    }

    /**
     * Returns info about one or all dialogs
     * @param string $dialogType Dialog type
     *               `$dialogTypes` property includes alowed values
     * @return string
     * @throws \Exception
     */
    public function dialogs($dialogType = null)
    {
        $path = '/Organizations/'.$this->platform->organizationId.'/Dialogs';

        $pathOptions = [];
        $pathParameters = [];

        if (!is_null($dialogType)) {
            if (!in_array($dialogType, $this->dialogTypes)) {
                throw new \Exception("Dialog type $dialogType doesn't exist");
            }
            $pathOptions = ['dialogType' => ['required' => true]];
            $pathParameters = ['dialogType' => $dialogType];
        }

        $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));
        return $this->formatResult($result);
    }

    /**
     * Returns info about one or all groups
     * @param string $groupId Group ID
     * @return string
     * @throws \Exception
     */
    public function groups($groupId = null)
    {
        $path = '/Organizations/'.$this->platform->organizationId.'/Groups';

        if (!is_null($groupId)) {
            $path = substr($path, 0, -1);
            $pathOptions = ['groupId' => ['required' => true]];
            $pathParameters = ['groupId' => $groupId];
            $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));
        } else {
            $result = $this->platform->getResource($this->platform->buildURL($path));
        }

        return $this->formatResult($result);
    }

    /**
     * Returns all users in given group
     * @param string $groupId Group ID
     * @return string
     * @throws \Exception
     */
    public function groupUsers($groupId)
    {
        $path = '/Organizations/'.$this->platform->organizationId.'/GroupUsers';

        $pathOptions = ['groupId' => ['required' => true]];
        $pathParameters = ['groupId' => $groupId];
        $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));

        return $this->formatResult($result);
    }

    /**
     * Returns info about one or all roles
     * @param string $roleId Role ID
     * @return string
     * @throws \Exception
     */
    public function roles($roleId = null)
    {
        $path = '/Organizations/'.$this->platform->organizationId.'/Roles';

        if (!is_null($roleId)) {
            $path = substr($path, 0, -1);
            $pathOptions = ['roleId' => ['required' => true]];
            $pathParameters = ['roleId' => $roleId];
            $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));
        } else {
            $result = $this->platform->getResource($this->platform->buildURL($path));
        }

        return $this->formatResult($result);
    }

    /**
     * Returns all users in given role
     * @param string $roleId Role ID
     * @return string
     * @throws \Exception
     */
    public function roleUsers($roleId)
    {
        $path = '/Organizations/'.$this->platform->organizationId.'/Users';

        $pathOptions = ['roleId' => ['required' => true]];
        $pathParameters = ['roleId' => $roleId];
        $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));

        return $this->formatResult($result);
    }

    /**
     * Returns info about one or all Select Lists
     * @param string $roleId Select List ID
     * @return string
     * @throws \Exception
     */
    public function selectLists($selectListId = null)
    {
        $path = '/Organizations/'.$this->platform->organizationId.'/SelectLists';

        if (!is_null($selectListId)) {
            $path = substr($path, 0, -1);
            $pathOptions = ['selectListId' => ['required' => true]];
            $pathParameters = ['selectListId' => $selectListId];
            $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));
        } else {
            $result = $this->platform->getResource($this->platform->buildURL($path));
        }

        return $this->formatResult($result);
    }

    /**
     * Returns info about one or all Select Lists
     * @param string $roleId Select List ID
     * @return string
     * @throws \Exception
     */
    public function selectListValues($selectListId, $start = null, $count = null)
    {
        $path = '/Organizations/'.$this->platform->organizationId.'/SelectListValues';

        if (!is_null($start) && !is_null($count)) {
            $pathOptions = ['selectListId' => ['required' => true], 'start' => ['required' => true], 'count' => ['required' => true]];
            $pathParameters = ['selectListId' => $selectListId, 'start' => $start, 'count' => $count];
        } else {
            $pathOptions = ['selectListId' => ['required' => true]];
            $pathParameters = ['selectListId' => $selectListId];
        }

        $result = $this->platform->getResource($this->platform->buildURL($path, $pathOptions, $pathParameters));

        return $this->formatResult($result);
    }
}
