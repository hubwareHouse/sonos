<?php
require_once __DIR__.'/__config.php';


$stack = \GuzzleHttp\HandlerStack::create();
// my middleware
$stack->push(\GuzzleHttp\Middleware::mapRequest(function (\Psr\Http\Message\RequestInterface $request) {
    $contentsRequest = (string) $request->getBody();
    echo 'BODY: '. $contentsRequest."\n\n";

    return $request;
}));


$config = [
    'auth' => [$clientId, $clientSecret],
    'handler' => $stack,
];

$client = new \GuzzleHttp\Client($config);


$requestParams = [
    'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
    'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
                'redirect_uri' => $redirectUri,
    ],
    'debug' => true
];

$response = $client->post('https://api.sonos.com/login/v3/oauth/access', $requestParams);
var_dump($response->getHeaders(), $response->getBody()->getContents());

