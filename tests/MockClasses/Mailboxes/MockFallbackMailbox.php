<?php

declare(strict_types=1);

namespace Elegasoft\Mailbox\Tests\MockClasses\Mailboxes;

use BeyondCode\Mailbox\InboundEmail;

class MockFallbackMailbox
{
    /**
     * @var array
     */
    public $emails = [];

    public function __invoke(InboundEmail $email): \stdClass
    {
        return (object) [
            'email' => $email,
            'class' => static::class,
        ];
    }
}
