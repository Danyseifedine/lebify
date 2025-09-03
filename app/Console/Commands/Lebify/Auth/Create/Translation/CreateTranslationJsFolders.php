<?php

namespace App\Console\Commands\Lebify\Auth\Create\Translation;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateTranslationJsFolders extends Command
{
    protected $signature = 'create:translation-folders-files';
    protected $description = 'Create folder structure for translation JavaScript files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $publicPath = public_path('js/common/translation');
        $translationFilePath = $publicPath . DIRECTORY_SEPARATOR . 'translation.js';

        // Create the translation folder if it doesn't exist
        File::makeDirectory($publicPath, 0755, true, true);

        // Create the translation file if it doesn't exist
        if (!File::exists($translationFilePath)) {
            File::put($translationFilePath, '');
            $this->info('Translation folder structure created successfully:');
            $this->line('- ' . $publicPath);
            $this->line('- ' . $translationFilePath);
        } else {
            $this->warn('Translation folder already exists. No changes were made.');
        }
    }
}
