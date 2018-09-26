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
    //'Authorization' => ['Basic '.$userKey],
    'auth' => [$clientId, $clientSecret],
    'handler' => $stack,
];

$client = new \GuzzleHttp\Client($config);


$requestParams = [
    //'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
    'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $userKey,
                'redirect_uri' => $redirectUri,
    ],
    //'body' => 'grant_type=authorization_code&code='.$userKey.'&redirect_uri='.urlencode($redirectUri),
    'debug' => true
];

$response = $client->post('https://api.sonos.com/login/v3/oauth/access', $requestParams);
var_dump($response->getHeaders(), $response->getBody()->getContents());
