<?php


namespace Elegasoft\Mailbox\Tests;


use BeyondCode\Mailbox\MailboxServiceProvider;
use Elegasoft\Mailbox\Tests\MockClasses\MockServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase;

/**
 * @property \Elegasoft\Mailbox\Tests\MockClasses\MockRouter router
 */
class MailboxRegistrationTest extends TestCase
{
    use WithFaker;


    /** @test */
    public function it_can_map_config_of_arrays_to_mail_router()
    {
        $this->router->getMappedRoutes()->each(function ($route)
        {
            $configKey = 'mailbox-router.' . $route['subject'];
            $this->assertNotEmpty(config($configKey)[$route['pattern']]);
            $this->assertSame(config($configKey)[$route['pattern']], $route['action']);
        });
    }

    /** @test */
    public function it_can_map_the_config_fallback_to_the_mail_router()
    {
        $fallback = $this->router->getFallbackRoute();
        $this->assertSame(config('mailbox-router.fallback'), get_class($fallback->getMailbox()));
    }

    /** @test */
    public function it_can_map_the_config_catchAll_to_the_mail_router()
    {
        $fallback = $this->router->getCatchAllRoute();
        $this->assertSame(config('mailbox-router.catchAll'), get_class($fallback->getMailbox()));
    }

    protected function getPackageProviders($app)
    {
        return [
            MailboxServiceProvider::class,
            MockServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->router = $this->app->make('mailbox');
    }
}
