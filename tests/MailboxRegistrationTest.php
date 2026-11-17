<?php

declare(strict_types=1);

namespace Elegasoft\Mailbox\Tests;

use BeyondCode\Mailbox\MailboxServiceProvider;
use BeyondCode\Mailbox\Routing\Router;
use Elegasoft\Mailbox\Tests\MockClasses\MockRouter;
use Elegasoft\Mailbox\Tests\MockClasses\MockServiceProvider;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase;
use PHPUnit\Framework\Attributes\Test;

/**
 * @property MockRouter router
 */
class MailboxRegistrationTest extends TestCase
{
    use WithFaker;

    /**
     * @var Router|MockRouter|mixed|object
     */
    private mixed $router;

    #[Test]
    public function it_can_map_config_of_arrays_to_mail_router(): void
    {
        $this->router->getMappedRoutes()->each(function (array $route): void {
            $configKey = 'mailbox-router.' . $route['subject'];
            $this->assertNotEmpty(config($configKey)[$route['pattern']]);
            $this->assertSame(config($configKey)[$route['pattern']], $route['action']);
        });
    }

    #[Test]
    public function it_can_map_the_config_fallback_to_the_mail_router(): void
    {
        $fallback = $this->router->getFallbackRoute();
        $this->assertSame(config('mailbox-router.fallback'), $fallback->getMailbox()::class);
    }

    #[Test]
    public function it_can_map_the_config_catch_all_to_the_mail_router(): void
    {
        $fallback = $this->router->getCatchAllRoute();
        $this->assertSame(config('mailbox-router.catchAll'), $fallback->getMailbox()::class);
    }

    protected function getPackageProviders($app)
    {
        return [
            MailboxServiceProvider::class,
            MockServiceProvider::class,
        ];
    }

    /**
     * @throws BindingResolutionException
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->router = $this->app->make('mailbox');
    }
}
