<?php


namespace Elegasoft\Mailbox;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MailboxInstaller extends Command
{
    protected $signature = 'mailboxes:install';

    protected $description = 'Installs the default Mailbox Routes';

    public function handle()
    {
        $this->info('Installing default Mailbox Routes...');

        if (File::exists(base_path('routes/mail.php')))
        {
            $this->error('File exists at /routes/mail.php unable to install again.');
            return;
        }

        $this->call('vendor:publish', [
            '--provider' => MailboxRouterServiceProvider::class,
            '--tag'      => "routes",
        ]);

        $this->info('Installed Mailbox Routes as /routes/mail.php');
    }
}
