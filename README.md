# 📋 Bouncer
[![Latest Stable Version](https://img.shields.io/packagist/v/theroadbunch/bouncer.svg)](https://packagist.org/packages/theroadbunch/bouncer)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Build Status](https://scrutinizer-ci.com/g/The-Road-Bunch/bouncer/badges/build.png?b=main)](https://scrutinizer-ci.com/g/The-Road-Bunch/bouncer/build-status/main)

_What is Bouncer?_  

Bouncer is an easy-to-use allow/deny list interface.

_Why the name Bouncer?_  

In the real-world, a bouncer holds the list of who is allowed entry and who is not.
* AllowBouncer: At an exclusive club, the bouncer has a list and if you're not on it, you can't come in.  
* DenyBouncer: The local bar allows almost everyone in, the bouncer has a list of trouble-makers to stop at the door.

### Contents
1. [Installation](#install)
2. [Implementation](#Implementation)  
   1. [Standard Usage](#standard-usage)  
   2. [Real-World Use-Case](#example-of-a-real-world-use-case)  
3. [Bouncers](#bouncers)  
4. [Abstract Bouncer](#abstract-bouncer)  
5. [License](LICENSE)  

<a name="install"></a>
### Install using composer</a> <sup><small>[[?]](https://getcomposer.org)</small></sup>

`composer require theroadbunch/bouncer`

### Implementation

#### Standard Usage

Use `Bouncer::allow()` or `Bouncer::deny()` to create your allow/deny lists (bouncer).

```php
use RoadBunch\Bouncer\Bouncer;

$subjectList = ['example', 'one', 'two', 'three'];
$bouncer = Bouncer::allow($subjectList);
$bouncer->isAllowed('example'); // true

$bouncer = Bouncer::deny($subjectList);
$bouncer->isAllowed('example'); // false

// or
$subjectList = 'example;one;two;three';
$bouncer = Bouncer::allow($subjectList);
$bouncer->isAllowed('one'); // true
$bouncer->isAllowed('not in list'); // false

$bouncer = Bouncer::deny($subjectList);
$bouncer->isAllowed('two'); // false
$bouncer->isAllowed('not in list'); // true

// or 
$subject = 'onlydomainiwanttosendemailto.com';
$bouncer = Bouncer::allow($subject);
$bouncer->isAllowed($subject); // true
$bouncer->isAllowed('example.com'); //false
```

Update the Bouncer in real time
```php
use RoadBunch\Bouncer\Bouncer;

$subject = 'allowedAndThenDenied';

$bouncer = Bouncer::allow($subject);
$bouncer->isAllowed($subject); // true

$bouncer->deny($subject);
$bouncer->isAllowed($subject); // false
```

Using `BouncerFactory::create()`  
<sub>_This has been deprecated and will be removed from the documentation in version **2.4**_</sub>
```php
use RoadBunch\Bouncer\Rule;
use RoadBunch\Bouncer\BouncerFactory;

$subjectList = ['example', 'one', 'two', 'three'];
$bouncer = BouncerFactory::create(Rule::ALLOW, $subjectList);
$bouncer->isAllowed('example'); // true
$bouncer->isAllowed('not in list'); // false
```

#### Example of a real-world use-case

```php
<?php
declare(strict_types=1);

use Psr\Log\LoggerInterface;
use RoadBunch\Bouncer\Bouncer;
use RoadBunch\Bouncer\BouncerInterface;

class Mailer
{
    public function __construct(      
        /** ... config parameters ... */,
        private readonly LoggerInterface $logger,
        private readonly BouncerInterface $bouncer, 
    ) {}
    
    public function send(string $address, string $message): void
    {
        if (!$this->bouncer->isAllowed($address)) {
            $this->logger->warning("Cannot send email to blocked email address: {$address}");
            return;
        }
        // do work
        if (/* work fails */) {
            // deny this address in the next run
            $this->bouncer->deny($address);
            $this->logger->error("Sending failed, {$address} added to block list.")
            return;
        }
        $this->logger->info("Sending email to {$address}.");                               
    }
}

// Create a bouncer that has a DenyList
$bouncer = Bouncer::deny(['someone@example.com', 'someone_else@example.com']);
$mailer = new Mailer($bouncer);

$mailer->send('someone@example.com', 'Welcome!'); // logs warning
$mailer->send('someotheraddress@example.com', 'Welcome!'); // sends mail
```

### Bouncers
All bouncers implement `RoadBunch\Bouncer\BouncerInterface`

`RoadBunch\Bouncer\AllowBouncer`

| method                     | description                                        | return type |
|----------------------------|----------------------------------------------------|-------------|
| isAllowed(string $subject) | returns `true` if the subject is on the allow list | bool        |
| allow(string $subject)     | Add this subject to the allow list                 | void        |
| deny(string $subject)      | Remove this subject from the allow list            | void        |

`RoadBunch\Bouncer\DenyBouncer`

| method                     | description                                           | return type |
|----------------------------|-------------------------------------------------------|-------------|
| isAllowed(string $subject) | returns `true` if the subject is NOT on the deny list | bool        |
| allow(string $subject)     | Remove this subject from the deny list                | void        |
| deny(string $subject)      | Add this subject to the deny list                     | void        |

### Abstract Bouncer
`RoadBunch\Bouncer\AbstractBouncer` implements `RoadBunch\Bouncer\BouncerInterface` and is available to extend if you need to write your own logic to determine if a subject is allowed.

| method                  | description                                             | return type |
|-------------------------|---------------------------------------------------------|-------------|
| has(string $subject)    | returns `true` if a subject is held in the subject pool | bool        |
| add(string $subject)    | Add this subject to the pool                            | void        |
| remove(string $subject) | Remove this subject from the pool                       | void        |

## License
&copy; Dan McAdams | The content of this library is released under the **MIT License**

You can find a copy of this license in [`LICENSE`](LICENSE) or at http://opensource.org/licenses/mit.
