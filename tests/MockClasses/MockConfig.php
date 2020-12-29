<?php

/*
 * You can place your custom package configuration in here.
 */

use Elegasoft\Mailbox\Tests\MockClasses\Mailboxes\MockCatchAllMailbox;
use Elegasoft\Mailbox\Tests\MockClasses\Mailboxes\MockFallbackMailbox;
use Elegasoft\Mailbox\Tests\MockClasses\Mailboxes\MockMailbox;

return [
    'from'     => [
        'from@test.org'  => MockMailbox::class,
        '{any}@test.org' => MockMailbox::class,
    ],
    'to'       => [
        'to@test.org'       => MockMailbox::class,
        'fallback@test.org' => MockFallbackMailbox::class,
    ],
    'cc'       => [
        'cc@test.org'       => MockMailbox::class,
        'catchall@test.org' => MockCatchAllMailbox::class,
    ],
    'subject'  => [
        'test-subject' => MockMailbox::class,
    ],
    'fallback' => MockFallbackMailbox::class,
    'catchAll' => MockCatchAllMailbox::class,
];
