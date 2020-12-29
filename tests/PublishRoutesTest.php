<?php


namespace Elegasoft\Mailbox\Tests;


use Elegasoft\Mailbox\MailboxRouterServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;

class PublishRoutesTest extends TestCase
{

    /** @test */
    public function it_publishes_the_config_as_a_route_file()
    {
        if (File::exists(base_path('routes/mail.php')))
        {
            unlink(base_path('routes/mail.php'));
        }

        $this->assertFalse(File::exists(base_path('routes/mail.php')));

        Artisan::call('mailboxes:install');

        $this->assertTrue(File::exists(base_path('routes/mail.php')));
    }

    /** @test */
    public function it_will_not_overwrite_the_published_file()
    {
        $contents = 'THIS IS A MAIL ROUTE STUB';

        File::put(base_path('routes/mail.php'), $contents);

        $this->assertTrue(File::exists(base_path('routes/mail.php')));

        Artisan::call('mailboxes:install');

        $this->assertEquals($contents, file_get_contents(base_path('routes/mail.php')));
    }

    protected function getPackageProviders($app)
    {
        return [MailboxRouterServiceProvider::class];
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        if (File::exists(base_path('routes/mail.php')))
        {
            unlink(base_path('routes/mail.php'));
        }
    }
}
