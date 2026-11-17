<?php

declare(strict_types=1);

namespace Elegasoft\Mailbox\Tests;

use Elegasoft\Mailbox\MailboxRouterServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;
use PHPUnit\Framework\Attributes\Test;

class MailboxCommandTest extends TestCase
{
    #[Test]
    public function it_creates_a_new_foo_class(): void
    {
        // destination path of the Foo class
        $mailboxClass = app_path('Mailboxes/MyMailbox.php');

        // make sure we're starting from a clean state
        if (File::exists($mailboxClass)) {
            unlink($mailboxClass);
        }

        $this->assertFalse(File::exists($mailboxClass));

        // Run the make command
        Artisan::call('make:mailbox MyMailbox');

        // Assert a new file is created
        $this->assertTrue(File::exists($mailboxClass));

        if (File::exists($mailboxClass)) {
            unlink($mailboxClass);
        }
    }

    protected function getPackageProviders($app)
    {
        return [MailboxRouterServiceProvider::class];
    }
}
