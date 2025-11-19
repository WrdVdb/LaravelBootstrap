<?php


namespace App\Repository\Azure\Api;


use App\Utils\Http\HTTPClientMulti;
use Microsoft\Graph\Graph;
use Psr\Log\LoggerInterface;

class AbstractGraphApi
{

    public static int $COUNT = 0;
    private ?string $accessToken=null;

    public function __construct(protected LoggerInterface $logger, protected GraphApiAccessTokenProvider $tokenProvider)
    {
    }

    protected function getGraph(): Graph
    {
        $graph = new Graph();
        if($this->accessToken == null){
            $this->accessToken = $this->tokenProvider->getAccessTokenClientCredentials();
        }
        $graph->setAccessToken($this->accessToken);
        return $graph;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

}
