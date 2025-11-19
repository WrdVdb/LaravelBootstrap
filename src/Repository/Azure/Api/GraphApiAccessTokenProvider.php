<?php


namespace App\Repository\Azure\Api;


use App\Exception\AzureAuthenticationException;
use \DateTime;
use \DateInterval;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class GraphApiAccessTokenProvider
{

    /**
     * AbstractAccessTokenProvider constructor.
     * @param string $azureTenantId
     * @param string $azureClientId
     * @param string $azureClientSecret
     * @throws \Exception
     */
    public function __construct(private string $azureTenantId,
                                private string $azureClientId,
                                private string $azureClientSecret,
                                private string $azureScopes,
                                private string $azureApplicationRedirectUri,
    )
    {
    }

    public function getAccessTokenClientCredentials() : string
    {

        $guzzle = new HttpClient();
        $url = 'https://login.microsoftonline.com/' . $this->azureTenantId . '/oauth2/v2.0/token';
        $token = \json_decode($guzzle->post($url, [
            'form_params' => [
                'client_id' => $this->azureClientId,
                'client_secret' => $this->azureClientSecret,
                'scope' => 'https://graph.microsoft.com/.default',
                'grant_type' => 'client_credentials',
            ],
        ])->getBody()->getContents());

        $token = $token->access_token;

        return $token;
    }


}
