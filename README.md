#Ticksy API PHP Class
This PHP Class was created in order to communicate with the Ticksy API.
For more information please take a look into the official [Ticksy API documentation](https://ticksy.com/api/ "Ticksy API documentation").

##Installation
In order to use this class respectively the API you need your **Domain** and **API Key**. Please visit your profile page and navigate to **API (BETA)**.

``` php
// Including class to your project
require('Ticksy.php');

// Setup Ticksy with your credentials
$ticksy = new Ticksy(TICKSY_DOMAIN, TICKSY_API_KEY);
```

Please replaced <code>TICKSY_DOMAIN</code> and <code>TICKSY_API_KEY</code> with your personal credentials.

##Examples
###Receive open tickets
``` php
// Receive all open tickets assigned to you
$tickets = $ticksy->my_tickets();

// Receive all open tickets
$tickets = $ticksy->open_tickets();
```

##What's coming next?
Right now it's possible to receive all information like tickets, responses and comments. 

I'm planning to enhance the class in order to receive for specific data, for example list of all open/assigned tickets with responses needed. Please take a look into the [issues](https://github.com/flowdee/ticksy-api-php-class/issues "issues") and create a new one if you need a special function/enhancement.

If you don't want to miss an update or say hello, follow me on Twitter: [@flowdee](https://twitter.com/flowdee "@flowdee") :wink:
##Credits
* [Ticksy](https://ticksy.com/ "Ticksy")