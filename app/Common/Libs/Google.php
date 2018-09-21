<?php

namespace App\Common\Libs;

use Exception;

if (file_exists(__DIR__ . '/Google/autoload.php')) {
    include __DIR__ . "/Google/autoload.php";
} else {
    throw new Exception("Google autoload.php could not be found");
}

use Google_Client;
use Google_Service_Oauth2;

/**
 * @Class: Upload_manager\Library\Google
 **/
class Google
{

    private $client;

    public function __construct($config, $redirect_uri = null)
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfigFile($config);
        if (!is_null($redirect_uri)) {
            $this->client->setRedirectUri($redirect_uri);
        }
        $this->client->addScope("email");
        $this->client->addScope("profile");
    }

    public function createAuthUrl()
    {
        return $this->client->createAuthUrl();
    }

    public function authenticate($code)
    {
        return $this->client->authenticate($code);
    }

    public function setAccessToken($access_token)
    {
        return $this->client->setAccessToken($access_token);
    }

    public function getAccessToken()
    {
        return $this->client->getAccessToken();
    }

    public function Oauth2()
    {
        $service = new Google_Service_Oauth2($this->client);
        return $service->userinfo->get();
    }
}

?>