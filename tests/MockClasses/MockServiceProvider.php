<?php


namespace Elegasoft\Mailbox\Tests\MockClasses;

use Elegasoft\Mailbox\MailboxRouterServiceProvider;
use Illuminate\Support\Facades\File;

class MockServiceProvider extends MailboxRouterServiceProvider
{
    public function register()
    {
        $this->app->singleton('mailbox', function ()
        {
            return new MockRouter($this->app);
        });

        parent::register();
    }

    protected function loadMailboxRoutes()
    {
        if (File::exists(__DIR__ . '/../../routes/mail.php'))
        {
            return __DIR__ . '/../../routes/mail.php';
        }
        return __DIR__ . '/MockConfig.php';
    }
}
