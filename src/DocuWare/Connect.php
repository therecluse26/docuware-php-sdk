<?php
namespace DocuWare;

class Connect
{
    private $host;
    private $curl;
    private $username;
    private $password;
    private $authToken;
    private $browserId;
    protected $cookieTemp;
    protected $organizationName;
    public $organizationId;
    public $organizationInfo;
    private $tmpDir;
    private static $cookieFile = "dwcookie";
    private static $orgFile = "dworg";

    /**
     * Connect constructor
     * @param $host
     * @param $organization
     * @param $username
     * @param $password
     * @throws \Exception
     */
    public function __construct($host, $organization, $username, $password)
    {
        //Sets global exception handler for uncaught exceptions
        set_exception_handler(array($this, "exceptionHandler"));

        $this->host = rtrim($host, '/');
        $this->username = $username;
        $this->password = $password;
        $this->organizationName = $organization;
        $this->tmpDir = dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."tmp";

        $this->setCookieProperties();

        if (!$this->validateCookie()) {
            $loginStatus = $this->login();

            if ($loginStatus["ok"] === false) {
                die($loginStatus["code"] . ": " . $loginStatus["error"]);
            }
        } else {
            $this->getOrganizationId();
        }

        // Attempts to load organization info from cache,
        if (!$this->getOrgDataFromCache()) {
            $this->cacheOrganizationInfo();
            $this->getOrgDataFromCache();
        }
    }

    /**
     * @throws \Exception
     */
    public function __destruct()
    {
        curl_close($this->curl);
    }

    /**
     * Replaces `access` in `accessResource`
     * with corresponding HTTP method
     * (E.g. GET, POST, PUT, etc)
     */
    public function __call($name, $arguments)
    {
        //Accesses remote resource if method like '%Resource' is used
        if (preg_match('/([a-z]+)Resource/', $name, $matches)) {
            array_unshift($arguments, strtoupper($matches[1]));
            $return = call_user_func_array([$this, 'accessResource'], $arguments);
            return $return;
        }
    }


    private function login($httpMethod = null, $path = null, $content = null, $contentType = null, $boundary = null, $redirect = false)
    {
        $result = array();

        $this->curl = curl_init();

        curl_setopt_array($this->curl, [
            CURLOPT_URL => $this->buildURL('/Account/Logon'),
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 1,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POST => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => ['UserName' => $this->username,
                'Password' => $this->password,
                'Organization' => $this->organizationName,
                'LicenseType' => 'PlatformService']
        ]);

        // Execute Request
        $response = curl_exec($this->curl);
        $returnCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        $curlInfo = curl_getinfo($this->curl);

        if ($returnCode == 200) {
            $header_size = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
            if ($this->setAuth(substr($response, 0, $header_size))) {
                $this->saveCookies();
                $this->setCookieProperties();
                $this->getOrganizationId();
                $this->cacheOrganizationInfo();
            };

            $result["ok"] = true;

            // If redirect URL is specified
            if (!is_null($path)) {
                // Renames `accessResource` method by proper
                // mutated name, based on HTTP method
                $redirectMethod = strtolower($httpMethod)."Resource";
                // Calls `accessResource` method as a redirect
                // Don't include the $httpMethod as an argument here,
                // __call() shifts the argument list by 1
                $this->{$redirectMethod}($path, $content, $contentType, $boundary, true);
            }

            return $result;
        } elseif ($returnCode == 401) {
            $result["ok"] = false;
            $result["code"] = $returnCode;
            $result["error"] = "Authentication error";
            return $result;
        } else {
            ob_start();
            var_dump(curl_error($this->curl));
            $errorDetails = ob_get_contents();
            ob_end_clean();

            http_response_code($curlInfo['http_code']);
            $result["ok"] = false;
            $result["code"] = $curlInfo['http_code'];
            $result["error"] = "Error: " . $errorDetails;
            return $result;
        }
    }

    /**
     * @param $headerString
     */
    private function setAuth($headerString)
    {
        preg_match('/DWPLATFORMAUTH\=[A-Z0-9]+/', $headerString, $auth);
        preg_match('/DWPLATFORMBROWSERID\=[A-Z0-9]+/', $headerString, $browser);

        $this->authToken = explode('=', $auth[0])[1];
        $this->browserId = explode('=', $browser[0])[1];

        return true;
    }

    /**
     * This method is invoked by __call() using various
     * HTTP methods such as GET, POST, PUT, DELETE, etc.
     * For example, it may be invoked by calling `getResource`
     * or `postResource`, and the __call magic method will
     * replace `access` with `get` or `post`, respectively
     */
    public function accessResource($httpMethod, $path, $content = null, $contentType = null, $boundary = null, $redirect = false)
    {
        $boundary = $boundary ? $boundary : md5(time());
        $contentType = $contentType ? $contentType : 'multipart/form-data';

        if (!$this->curl) {
            $this->curl = curl_init();
        } else {
            curl_reset($this->curl);
        }

        curl_setopt_array($this->curl, [
            CURLOPT_URL => $path,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => $httpMethod,
            CURLOPT_POSTFIELDS => $content,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Content-Type: {$contentType}; Boundary={$boundary}",
                "Cookie: DWOrganization={$this->organizationName};" .
                "DWPLATFORMBROWSERID={$this->browserId};" .
                ".DWPLATFORMAUTH={$this->authToken}",
                "openInNewWindow=False"]
        ]);

        /* debug start
        ini_set('xdebug.var_display_max_depth', '100');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '10000');
        ob_start();
        $out = fopen('php://output', 'w');
        curl_setopt($this->curl, CURLOPT_VERBOSE, true);
        curl_setopt($this->curl, CURLOPT_STDERR, $out);
        /* debug start */

        // Execute request
        $response = curl_exec($this->curl);
        $returnCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        /* debug end
        fclose($out);
        $debug = ob_get_clean();
        var_dump($debug);
        /* debug end */

        if ($returnCode === 401) {
            // Login and redirect back to current api call
            $loginStatus = $this->login($httpMethod, $path, $content, $contentType, $boundary, true);

            if (!$loginStatus["ok"]) {
                die("Login failed");
            }

            return $loginStatus["ok"];
        }

        http_response_code($returnCode);
        return $response;
    }

    /**
     * @param $path
     * @param null $pathParameters
     * @param null $pathArguments
     * @return string
     * @throws \Exception
     */
    public function buildURL($path, $pathParameters = null, $pathArguments = null)
    {
        $pathParameters = $pathParameters ? $pathParameters : [];
        $pathArguments = $pathArguments ? $pathArguments : [];

        $urlArguments = [];

        //Check if given parameters are valid
        foreach ($pathArguments as $key => $value) {
            if ($pathParameters[$key]) {
                $urlArguments[$key] = $value;
            } else {
                throw new \Exception("Parameter is not an option: {$key}");
            }
        }

        foreach ($pathParameters as $key => $value) {
            if (is_array($value)) {
                //Check if required parameters are defined
                if (array_key_exists('required', $value) && $value['required']
                    && !array_key_exists($key, $urlArguments)) {
                    throw new \Exception("Missing required URL parameter: {$key}");
                }
                //Check if value matches defined type
                if (array_key_exists('type', $value) &&
                                        array_key_exists($key, $urlArguments)) {
                    switch ($value['type']) {
                        case 'int':
                            $match = preg_match('/^\d+$/', $urlArguments[$key]);
                            break;
                        default:
                            throw new \Exception("Invalid type given: {$value['type']}");
                    }

                    if (!$match) {
                        throw new \Exception("Value did not match the");
                    }
                }
            }
        }

        if (count($urlArguments) > 0) {
            $path .= '?' . http_build_query($urlArguments);
        }

        $url = $this->host . "/Platform{$path}";

        return $url;
    }

    /**
     * Returns connection data for use in
     * other dependency-injected classes
     */
    public function returnConnectionData()
    {
        return ["host" => $this->host,
            "organization" => $this->organizationName,
            "username" => $this->username,
            "password" => $this->password,
            "authToken" => $this->authToken,
            "browserId" => $this->browserId];
    }


    /**
     * Sets basic cookie properties for connection object
     */
    private function setCookieProperties()
    {
        //$tmpDir = dir(__DIR__)."../../tmp";
        /*chdir($tmpDir->path);
        chdir("../../");
        $tmpDir = getcwd() . "/tmp";*/

        //$this->cookieTemp = $this->tmpDir . "/dwcookie";
        $localCookie = $this->loadCookieFile(self::$cookieFile);
        $this->authToken = \DocuWare\Utility::getStringBetween(
            $localCookie,
            "<DWPLATFORMAUTH>",
            "</DWPLATFORMAUTH>"
        );
        $this->browserId = \DocuWare\Utility::getStringBetween(
            $localCookie,
            "<DWPLATFORMBROWSERID>",
            "</DWPLATFORMBROWSERID>"
        );
    }

    /**
     * @param $filePath
     * Saves cookie data to file
     */
    private function saveCookieFile()
    {
        $cookiePath = realpath($this->tmpDir).DIRECTORY_SEPARATOR.self::$cookieFile;
        if ($cookieFile = @fopen($cookiePath, "w")) {
            fwrite($cookieFile, "<DWPLATFORMAUTH>" . $this->authToken
              . "</DWPLATFORMAUTH>" . "<DWPLATFORMBROWSERID>" . $this->browserId . "</DWPLATFORMBROWSERID>");
            fclose($cookieFile);
        } else {
            error_log("Cannot create, open and/or write to cookie file.
		         Check that file exists and that the server can write to '" . $cookiePath . "'");
        }
    }

    /**
     * @param $filePath
     * @return bool|string|void
     * Returns cookie data from file
     */
    private function loadCookieFile()
    {
        $cookiePath = realpath($this->tmpDir).DIRECTORY_SEPARATOR.self::$cookieFile;

        try {
            if (!$cookieFile = @fopen($cookiePath, "r")) {
                throw new \Exception("Cookie file missing");
            };
            if (!$cookieResult = @fread($cookieFile, filesize($cookiePath))) {
                throw new \Exception("Cookie file is empty or cannot be read");
            };

            fclose($cookieFile);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            error_log("Attempting to generate new cookie file in '" . $cookiePath . "'");
            return;
        }

        return $cookieResult;
    }

    /**
     * @return bool
     * Checks local cookie auth token for valid format
     * @throws \Exception
     */
    private function validateCookie()
    {
        $response = false;

        $localCookie = $this->loadCookieFile();

        if (!$localCookie) {
            return $response;
        }

        $localAuthToken = \DocuWare\Utility::getStringBetween($localCookie, "<DWPLATFORMAUTH>", "</DWPLATFORMAUTH>");

        if ($localAuthToken != null) {
            $response = true;
        } else {
            error_log("Empty Token");
        }

        return $response;
    }

    /**
     * @return bool
     * Saves cookies to file after logging in
     */
    private function saveCookies()
    {
        if ($this->authToken && $this->browserId) {
            $this->saveCookieFile();
            return true;
        } else {
            return false;
        }
    }

    private function cacheOrganizationInfo()
    {
        $path = "/Organizations/{$this->organizationId}";
        $result = json_encode(new \SimpleXMLElement($this->getResource($this->buildURL($path))));

        $orgPath = realpath($this->tmpDir).DIRECTORY_SEPARATOR."dworginfo";

        if ($orgFile = @fopen($orgPath, "w")) {
            fwrite($orgFile, $result);
            fclose($orgFile);
        }
    }

    private function getOrgDataFromCache()
    {
        try {
            $orgPath = realpath($this->tmpDir).DIRECTORY_SEPARATOR."dworginfo";

            if ($orgFile = @fopen($orgPath, "r")) {
                $res = fread($orgFile, filesize($orgPath));
                fclose($orgFile);

                $parsed = json_decode($res, true);
                $this->loadOrgInfo($parsed);
            } else {
                throw new \Exception("Couldn't open file");
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Gets organization ID
     * @throws \Exception
     */
    private function getOrganizationId()
    {
        $status = true;
        $orgPath = realpath($this->tmpDir).DIRECTORY_SEPARATOR.self::$orgFile;

        if (!$orgFile = @fopen($orgPath, "r")) {
            error_log("Failed to load dworg file, attempting to generate new version");
            $status = false;
        }
        if (!$orgResult = @fread($orgFile, filesize($orgPath))) {
            $status = false;
        };

        if ($orgFile) {
            fclose($orgFile);
        };

        if ($status) {
            $this->organizationId = \DocuWare\Utility::getStringBetween($orgResult, "<DWORGID>", "</DWORGID>");
            return;
        } else {
            $path = "/Organizations";
            $result = $this->getResource($this->buildURL($path));

            $dom = new \DOMDocument('1.0');
            //Suppress loadXML error if invalid token is passed
            @$dom->loadXML($result);

            foreach ($dom->getElementsByTagName('Organization') as $organization) {
                $remoteOrgName = $organization->getAttribute('Name');
                if ($remoteOrgName == $this->organizationName) {
                    $this->organizationId = $organization->getAttribute('Id');
                }
            }

            if (!$this->organizationId) {
                throw new \Exception('Organization not found.');
            }

            $this->saveOrganizationId();
        }
    }

    private function saveOrganizationId()
    {
        $orgPath = realpath($this->tmpDir).DIRECTORY_SEPARATOR.self::$orgFile;

        $result = true;
        if ($this->organizationId) {
            if ($orgFile = @fopen($orgPath, "w")) {
                fwrite($orgFile, "<DWORGID>" . $this->organizationId . "</DWORGID>");
                fclose($orgFile);
            } else {
                $result = false;
                error_log("Cannot create, open and/or write to organization ID file.
            		         Check that file exists and that the server can write to '" . $orgPath . "'");
            }
        } else {
            $result = false;
        }

        return $result;
    }

    public function loadOrgInfo($array)
    {
        foreach ($array['@attributes'] as $attKey => $attVal) {
            $this->organizationInfo[$attKey] = $attVal;
        }

        foreach ($array['AdditionalInfo']['@attributes'] as $addKey => $addVal) {
            $this->organizationInfo[$addKey] = $addVal;
        }

        $this->organizationInfo['CompanyNames'] = $array['AdditionalInfo']['CompanyNames'];

        foreach ($array['AdditionalInfo']['AddressLines'] as $addrKey => $addrVal) {
            $this->organizationInfo[$addrKey] = $addrVal;
        }
    }
}
