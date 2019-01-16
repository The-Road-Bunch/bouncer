# theroadbunch/filter-lists [![build status](https://scrutinizer-ci.com/g/The-Road-Bunch/filter-lists/badges/build.png?b=master)](https://scrutinizer-ci.com/g/The-Road-Bunch/filter-lists/)
A small library for validating domains against a blacklist/whitelist, and checking if the domain is valid  
  
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

Recommended usage for this library is to have blacklists and whitelists, so a factory was created to quickly create them
```php
<?php

use RoadBunch\Lists\ListFactory;

$email = 'dan@example.com';

$blacklist = ListFactory::createBlacklist([$email]);

echo $blacklist->getType();

// output
blacklist

if ($blacklist->has($email)) {
    die($email . ' has been blacklisted!');
} 

// output 
dan@example.com has been blacklisted!
```

In the previous example, you could really just use an array, but the blacklist/whitelist labels have an advantage
when deciding how to filter something.
```php
<?php

use RoadBunch\Lists\ListFactory;
use RoadBunch\Lists\FilterListInterface;
use RoadBunch\Lists\FilterList;

class Mailer
{
    /** @var FilterListInterface */
    protected $filterList;
    
    public function __construct(FilterListInterface $filterList = null)
    {
        $this->filterList = $filterList;
    }
    
    public function mail($message, $email)
    {
        if ($this->passesListValidation($email)) {
            echo 'Mail sent!';          
        } else {
            echo 'This email address is blacklisted!';
        }
    }
    
    private function passesListValidation(string $email)
    {
        if (null === $this->filterList) {
            return true;
        }
        
        switch ($this->filterList->getType()) {
            case (FilterList::TYPE_WHITELIST):
                return $this->filterList->has($email);
            case (FilterList::TYPE_BLACKLIST):
                return !$this->filterList->has($email);
        }
    }
}

$whitelist = ListFactory::createWhitelist(['dan@example.com']);
$mailer    = new Mailer($whitelist);

$mailer->mail('heyo', 'dan@example.com');

// output
Mail sent!

$mailer->mail('hey', 'notinlist@example.com');

// output
This email address is blacklisted!
``` 

## License
The content of this library is released under the **MIT License** by **Dan McAdams**

You can find a copy of this license in [`LICENSE`](LICENSE) or at http://opensource.org/licenses/mit.
