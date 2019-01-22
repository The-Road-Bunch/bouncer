# theroadbunch/bouncer [![build status](https://scrutinizer-ci.com/g/The-Road-Bunch/bouncer/badges/build.png?b=master)](https://scrutinizer-ci.com/g/The-Road-Bunch/bouncer/)
A library containing a Whitelist, a Blacklist, and a Bouncer class for use when you might need to filter some strings  
  
[![Latest Stable Version](https://img.shields.io/packagist/v/theroadbunch/bouncer.svg)](https://packagist.org/packages/theroadbunch/bouncer)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

### Contents
1. [Installation](#installation)  
2. [Usage](#usage)  
    a. [Basic Usage](#basic-usage)  
3. [License](LICENSE)  

### <a name="installation">Install using composer</a> <sup><small>[[?]](https://getcomposer.org)</a></small></sup>

`composer require theroadbunch/bouncer`

<a name="usage"></a>
### <a name="basic-usage">Basic Usage</a>

Checking strings at the door using a blacklist
```php
<?php

use RoadBunch\Bouncer\Bouncer;
use RoadBunch\Bouncer\Blacklist;

$banned = [
    'BadDancer29',
    'DefinitelyNotAFakeId'
];

$blacklist = new Blacklist($banned);
$bouncer   = new Bouncer($blacklist);

// returns true
$bouncer->isBlacklisted('BadDancer29');
$bouncer->isBlacklisted('DefinitelyNotAFakeId');
```

Add more neck rolls by letting in only the most elite strings
```php
<?php

use RoadBunch\Bouncer\Bouncer;
use RoadBunch\Bouncer\Whitelist;

$hotClients = [
    'GreatDancer37',
    'HotCeleb21'
];

$whitelist = new Whitelist($hotClients);
$bouncer   = new Bouncer($whitelist);

// returns false
$bouncer->isBlacklisted('GreatDancer37');
$bouncer->isBlacklisted('HotCeleb21');
``` 
__Note:__ `Bouncer::isBlacklisted()` has a sister method called `Bouncer::isAllowed()` and they return opposite values. Use whichever makes your code easier to read.

Add or Remove strings from a Blacklist or Whitelist in real time
```php
<?php

use RoadBunch\Bouncer\Bouncer;

// a Bouncer created with nothing passed to the constructor implements an empty Blacklist
$bouncer = new Bouncer();

// returns false
$bouncer->isBlacklisted('test string');

// add the string to the blacklist/remove from whitelist
$bouncer->addToBlacklist('test string');

// returns true
$bouncer->isBlacklisted('test string');

// remove from blacklist/add to whitelist
$bouncer->addToWhitelist('test string');

// returns false
$bouncer->isBlacklisted('test string');
```

## License
The content of this library is released under the **MIT License** by **Dan McAdams**

You can find a copy of this license in [`LICENSE`](LICENSE) or at http://opensource.org/licenses/mit.
