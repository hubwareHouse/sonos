<?php
/**
 * https redirector script - necessary to put somewhere central on a https reachable url
 * and to be configured as redirect url at https://integration.sonos.com/control_integrations/XXXX/keys/edit
 *
 *
 * this is not a very nice nor secure solution, but it helps to circumvent the
 *  single auth endpoint redirect of the sonos v3 api
 *
 *   state - contains the url-encoded target redirect url
 *   code - the client auth code, as provided by the SONOS authorize API
 *
 * @see https://developer.sonos.com/reference/authorization-api/create-authorization-code/
 *      for more information
 *
 */

$state = $_REQUEST['state'];
$code = $_REQUEST['code'];

//var_dump($_REQUEST['state'],$_REQUEST['code']);
if (substr($state,0,7) == 'http://')
{
    return header('location: '.$state.'?cb=auth&code='.urlencode($code));
}
echo 'NO ACCESS';