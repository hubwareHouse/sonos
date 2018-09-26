# SONOS Cloud API

SONOS Control API implementation for PHP ( see https://developer.sonos.com/build/direct-control/ fore more information)

powered by <a href="http://hubware.house">hubware</a> smart home factory

Please note: This library is work in progress. Some parts of the API are already implemented, some are pending. 
The authentication is using the new cloud-based redirect and callback urls. You need to have public reachable
urls to get the necessary OAuth2 tokens.

License: MIT

Feel free to clone, improve and create pull requests. All code submitted to the project must be licensed under MIT license.


## Preparation
* Register yourself an account at https://developer.sonos.com/
* Add a new integration and a new the client credential using a key. 

## Using it
In the tests/web directory are some files to get started
* Copy __config.php.dist to __config.php and fill in all-ready known values (oauth client id + secret).
* Copy the __api.php and __api_receiver.php to a public available url and configure them in the SONOS api console. They must be reachable when you call them in your browser! Localhost is not accepted by SONOS.
* Run api_auth_1_create_access.php - login to the SONOS account using OAuth2 and be redirected to the __api.php script. Fill in the necessary information into your __config.php script.
* Run api_auth_2_create_token.php - same here, you are redirected to __api_receiver.php and see in your browser the access and refresh token. Copy + paste into __config.php again.
* Now you can play with your SONOS devices:
  * test_player.php to control some player + group devices over the SONOS cloud (quite fast)
  * test_callback.php to receive event callbacks by the SONOS cloud to your system (e.g. change volume on the player, or using the SONOS app); the latency of these callbacks is quite slow and really usable (5-10 seconds on average during the evaluation time in September 2018). 
  
## Hacking it
* A lot of stuff is not yet finished. Please have a look at the src/ directory to see the code and improve it.
* The cloud event callbacks are not implemented yet.
* The OAuth2 registration process with the registered, public reachable callback urls are really a pain. If you can improve it, please do so. :-)
* Create a pull request with clean code, added automated tests and logs that can be used to test against (without your private information).
* Spread the word.
