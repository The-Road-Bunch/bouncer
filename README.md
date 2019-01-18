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

Take this simple `Mailer` class below
```php
<?php

use RoadBunch\Lists\FilterListInterface;
use RoadBunch\Lists\BlacklistValidator;
use RoadBunch\Lists\Blacklist;
use RoadBunch\Lists\Whitelist;

class Mailer
{
    /** @var BlacklistValidator */
    protected $blacklist;
    
    public function __construct(FilterListInterface $filterList)
    {
        // set your blacklist validator
        $this->blacklist = new BlacklistValidator($filterList);
    }
    
    public function mail($message, $email)
    {       
        if ($this->blacklist->isBlacklisted($email)) {
            return 'Address is blacklisted';
        }             
        return $this->sendEmail($message, $email);
    }
    
    public function sendEmail($message, $email)
    {
        // send email
        return 'Email Sent!';
    }
}

// create a pre-defined Blacklist and inject it into the mailer
$blacklist  = new Blacklist(['test@example.com']);
$mailer     = new Mailer($blacklist);

// outputs "Address is blacklisted"
echo $mailer->mail('Hello, World!', 'test@example.com');

// you can do the same thing with a whitelist
$whitelist  = new Whitelist(['test@example.com']);
$mailer     = new Mailer($whitelist);

// outputs "Email Sent!"
echo $mailer->mail('Hello, World!', 'test@example.com');
``` 

## License
The content of this library is released under the **MIT License** by **Dan McAdams**

You can find a copy of this license in [`LICENSE`](LICENSE) or at http://opensource.org/licenses/mit.
