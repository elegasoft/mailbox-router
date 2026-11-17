<?php

declare(strict_types=1);

namespace Elegasoft\Mailbox\Tests\MockClasses;

use Elegasoft\Mailbox\MailboxRouterServiceProvider;
use Illuminate\Support\Facades\File;

class MockServiceProvider extends MailboxRouterServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('mailbox', fn (): MockRouter => new MockRouter($this->app));

        parent::register();
    }

    protected function loadMailboxRoutes(): string
    {
        if (File::exists(__DIR__ . '/../../routes/mail.php')) {
            return __DIR__ . '/../../routes/mail.php';
        }

        return __DIR__ . '/MockConfig.php';
    }
}
