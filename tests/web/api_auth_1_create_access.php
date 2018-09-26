<?php
require __DIR__ .'/__config.php';

$redirectOAuth = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];


$state = urlencode(time().'_'.rand(0,99999999));

$authRedirect = 'https://api.sonos.com/login/v3/oauth?client_id='.$clientId.'&response_type=code&state='.$state.'&scope=playback-control-all&redirect_uri='.urlencode($redirectUri);
return header('Location: '.$authRedirect, true, 302);
