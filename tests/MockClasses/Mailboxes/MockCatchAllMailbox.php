<?php


namespace Elegasoft\Mailbox\Tests\MockClasses\Mailboxes;


use BeyondCode\Mailbox\InboundEmail;

class MockCatchAllMailbox
{
    /**
     * @var array
     */
    public $emails = [];

    public function __invoke(InboundEmail $email)
    {
        return (object)[
            'email' => $email,
            'class' => static::class,
        ];
    }
}
