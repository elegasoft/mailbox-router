# Laravel Mailbox Route Registration

This package extends [beyondcode/laravel-mail](https://github.com/beyondcode/laravel-mailbox) by providing a simple 
syntax to register mail handlers in a routes file which is outside of a service provider. 

## Installation

You can install the package via composer:

```bash
composer require elegasoft/mailbox-router
```

## Usage
First publish the route file stub to `routes/mail.php`:
``` php
php artisan mailboxes:install
```

Then define your routes:
``` php
// routes/mail.php

return [
    /*
     * Map emails sent from a specific address to a class which
     * will be invoked to process the incoming email message.
     *
     * For example: 'from@test.org' => ExampleMailbox::class
     */

    'from' =>  [
            'example@example.org'  => MyMailbox::class,
            'example2@example.org' => MyMailbox::class,
        ],

    /*
     * Map emails sent to a specific address to a class which
     * will be invoked to process the incoming email message.
     *
     * For example: 'to@test.org' => ExampleMailbox::class
     */

    'to' => [],

    /*
     * Map emails cc'd to a specific address to a class which
     * will be invoked to process the incoming email message.
     *
     * For example: 'cc@test.org' => ExampleMailbox::class
     */

    'cc' => [],

    /*
     * Map emails containing a specific subject to a class which
     * will be invoked to process the incoming email message.
     *
     * For example: 'This Subject' => ExampleMailbox::class
     */

    'subject' => [],

    /*
     * Only when an email does not match any of the preceding
     * invoke this class to catch the email for processing.
     *
     * For example: ExampleFallbackMailbox::class,
     */

    'fallback' => ExampleFallbackMailbox::class,

    /*
     * Regardless of when an email matches any of the preceding
     * always invoke this class to process the email message.
     *
     * For example: ExampleCatchAllMailbox::class,
     */

    'catchAll' => ExampleCatchAllMailbox::class,
];
```

The `MailboxRouterServiceProvider::class` will automatically bind each of the mail routes and invoke the classes or 
callbacks which when required to process an email which matches the registration.

#### Known Incompatibilities

You cannot use `Regular Expression Contraints` as define in the 
[beyondcode/laravel-mailbox docs](https://beyondco.de/docs/laravel-mailbox/basic-usage/mailboxes#regular-expression-constraints).

---

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email jason@elegasoft.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
