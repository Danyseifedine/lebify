<?php

namespace App\Console\Commands\Lebify\Auth\Calls\Translation;

use App\Console\Commands\Lebify\Auth\Create\Translation\CreateTranslationJsFolders;
use App\Console\Commands\Lebify\Auth\Update\Translation\UpdateTranslationFile;
use Illuminate\Console\Command;

class TranslationCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call:Translation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call all Translation-related commands';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Create Translation folders and files
        $this->info('Creating Translation folders and files...');
        $this->call(CreateTranslationJsFolders::class);
        $this->info('Folders and files created successfully.');
        sleep(1);

        // update Translation file
        $this->info('Updating Translation.js file...');
        $this->call(UpdateTranslationFile::class);
        $this->info('Translation.js file updated successfully.');
        sleep(1);

        $this->info('All Translation-related commands executed successfully.');
    }
}
