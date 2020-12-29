<?php

namespace Elegasoft\Mailbox;

use BeyondCode\Mailbox\Facades\Mailbox;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class MailboxRouterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole())
        {
            $this->publishes([
                __DIR__ . '/../config/mailboxes.php' => base_path('/routes/mail.php'),
            ], 'routes');

            $this->commands([
                MailboxInstaller::class,
            ]);
        }

        $this->registerMailboxes();
    }

    protected function registerMailboxes()
    {
        foreach (config('mailbox-router') as $mailbox => $routes)
        {
            $this->registerRoutableMailboxes($mailbox, $routes);
        }

        if (config('mailbox-router.fallback'))
        {
            Mailbox::fallback(config('mailbox-router.fallback'));
        }

        if (config('mailbox-router.catchAll'))
        {
            Mailbox::catchAll(config('mailbox-router.catchAll'));
        }
    }

    protected function registerRoutableMailboxes($mailbox, $routes)
    {
        if (in_array($mailbox, ['fallback', 'catchAll']))
        {
            return;
        }

        foreach ($routes as $matcher => $handler)
        {
            $func = "\BeyondCode\Mailbox\Facades\Mailbox::{$mailbox}";
            $func($matcher, $handler);
        }
    }

    public function register()
    {
        $mailboxRoutes = $this->loadMailboxRoutes();
        $this->mergeConfigFrom($mailboxRoutes, 'mailbox-router');
    }

    protected function loadMailboxRoutes()
    {
        if (File::exists(base_path('/routes/mail.php')))
        {
            return base_path('/routes/mail.php');
        }
        return __DIR__ . '/../config/mailboxes.php';
    }
}
