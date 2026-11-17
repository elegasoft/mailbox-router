<?php

declare(strict_types=1);

namespace Elegasoft\Mailbox\Tests;

use Elegasoft\Mailbox\MailboxRouterServiceProvider;
use Orchestra\Testbench\TestCase;
use PHPUnit\Framework\Attributes\Test;

class MergesConfigTest extends TestCase
{
    #[Test]
    public function it_merges_the_default_config_file_as_a_fallback(): void
    {
        $this->assertEmpty(config('mailbox-router.from'));
        $this->assertEmpty(config('mailbox-router.to'));
        $this->assertEmpty(config('mailbox-router.cc'));
        $this->assertNull(config('mailbox-router.fallback'));
        $this->assertNull(config('mailbox-router.catchAll'));
    }

    protected function getPackageProviders($app)
    {
        return [MailboxRouterServiceProvider::class];
    }
}
