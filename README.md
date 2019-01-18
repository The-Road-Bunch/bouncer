# theroadbunch/filter-lists [![build status](https://scrutinizer-ci.com/g/The-Road-Bunch/filter-lists/badges/build.png?b=master)](https://scrutinizer-ci.com/g/The-Road-Bunch/filter-lists/)
A list collection with a type. This library is tailored to using a list of strings as a blacklist/whitelist, but could be used for any collection of strings that has a name  
  
[![Latest Stable Version](https://img.shields.io/packagist/v/theroadbunch/filter-lists.svg)](https://packagist.org/packages/theroadbunch/filter-lists)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

### Contents
1. [Release Notes](doc/release.md)  
2. [Installation](#installation)  
3. [Usage](#usage)  
    a. [Basic Usage](#basic-usage)  
4. [License](LICENSE)  

### <a name="installation">Install using composer</a> <sup><small>[[?]](https://getcomposer.org)</a></small></sup>

`composer require theroadbunch/filter-lists`

<a name="usage"></a>
### <a name="basic-usage">Basic Usage</a>

Recommended usage for this library is to have blacklists and whitelists, but to use it in it's most basic form you can choose
to use it as a named collection of strings
```php
<?php

use RoadBunch\Lists\FilterList;

$userList = new FilterList('user_list', ['bob']);

// returns 'user_list'
$userList->getType();

// returns true
$userList->has('bob');
```

You can take advantage of blacklist/whitelist validation by using the `BlacklistValidator` class, and providing a FilterList with the name of `blacklist` or `whitelist`
```php
<?php

use RoadBunch\Lists\BlacklistValidator;
use RoadBunch\Lists\FilterList;

$filterList = new FilterList(FilterList::TYPE_BLACKLIST, ['blacklisted@example.com']);
$blacklist  = new BlacklistValidator($filterList);

// returns true
$blacklist->isBlacklisted('blacklisted@example.com');

// returns false
$blacklist->isBlacklisted('dan@example.com');

/**
 * This works with whitelists too 
 */

$filterList = new FilterList(FilterList::TYPE_WHITELIST, ['dan@example.com']);
$blacklist  = new BlacklistValidator($filterList);

// returns false
$blacklist->isBlacklisted('dan@example.com');

// returns true
$blacklist->isBlacklisted('notwhitelisted@example.com');
``` 

## License
The content of this library is released under the **MIT License** by **Dan McAdams**

You can find a copy of this license in [`LICENSE`](LICENSE) or at http://opensource.org/licenses/mit.
