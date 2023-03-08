# theroadbunch/bouncer [![Build Status](https://scrutinizer-ci.com/g/The-Road-Bunch/bouncer/badges/build.png?b=main)](https://scrutinizer-ci.com/g/The-Road-Bunch/bouncer/build-status/main)
Bouncer is an easy-to-use block/deny list interface.  
In this library is the interface and some usable classes to inject into your services.
  
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

Use `RoadBunch\Bouncer\BouncerFactory` to create your bouncer.  
All bouncers implement `RoadBunch\Bouncer\BouncerInterface`

```php
use RoadBunch\Bouncer\BouncerFactory;
use RoadBunch\Bouncer\Rule;

$subject = 'deniedAndAllowed';
$subjectList = [$subject];

$bouncer = BouncerFactory::create(Rule::ALLOW, $subjectList);
$bouncer->isAllowed($subject); // true

$bouncer = BouncerFactory::create(Rule::DENY, $subjectList);
$bouncer->isAllowed($subject) // false
```

Update the Bouncer in real time

```php
use RoadBunch\Bouncer\BouncerFactory;
use RoadBunch\Bouncer\Rule;

$subject = 'allowedAndThenDenied';
$subjectList = [$subject];

$bouncer = BouncerFactory::create(Rule::ALLOW, $subjectList);
$bouncer->isAllowed($subject); // true

$bouncer->deny($subject);
$bouncer->isAllowed($subject); // false
```

Example of a real-world use-case

```php
<?php

use Psr\Log\LoggerInterface;
use RoadBunch\Bouncer\Rule;
use RoadBunch\Bouncer\BouncerFactory;
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
            $this->logger->error("Sending failed, {$address} add to block list.")
        }
    }
}

// with deny list

$bouncer = BouncerFactory::create(Rule::DENY, ['someone@example.com']);
$mailer = new Mailer($bouncer);

$mailer->send('someone@example.com', 'Welcome!'); // logs warning
$mailer->send('someotheraddress@example.com', 'Welcome!'); // sends mail

// with allowed list

$bouncer = BouncerFactory::create(Rule::ALLOW, ['someone@example.com']);
$mailer = new Mailer($bouncer);

$mailer->send('someone@example.com', 'Welcome!'); // sends email
$mailer->send('someotheraddress@example.com', 'Welcome!'); // logs warning
```

## License
&copy; Dan McAdams | The content of this library is released under the **MIT License**

You can find a copy of this license in [`LICENSE`](LICENSE) or at http://opensource.org/licenses/mit.
