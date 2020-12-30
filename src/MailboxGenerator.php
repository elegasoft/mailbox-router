<?php


namespace Elegasoft\Mailbox;


use Illuminate\Console\GeneratorCommand;

class MailboxGenerator extends GeneratorCommand
{
    protected $name = 'make:mailbox';

    protected $description = 'Create a new mailbox class';

    protected $type = 'Mailbox';

    public function handle()
    {
        parent::handle();

        $this->generateMailboxFromStub();
    }

    protected function generateMailboxFromStub()
    {
        // Get the fully qualified class name (FQN)
        $class = $this->qualifyClass($this->getNameInput());

        // get the destination path, based on the default namespace
        $path = $this->getPath($class);

        $content = file_get_contents($path);

        // Update the file content with additional data (regular expressions)

        file_put_contents($path, $content);
    }

    /**
     * @inheritDoc
     */
    protected function getStub()
    {
        return __DIR__ . '/../stubs/mailbox.php.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Mailboxes';
    }
}
