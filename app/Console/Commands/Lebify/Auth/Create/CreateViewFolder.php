<?php

namespace App\Console\Commands\Lebify\Auth\Create;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateViewFolder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:folders-files-views';
    protected $description = 'Create folder structure for All files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $structure = [
            'auth' =>
            [
                'components' =>
                [
                    'footer' => 'footer.blade.php'
                ]
            ],
        ];

        $publicPath = resource_path('views');
        $this->createFoldersAndFiles($structure, $publicPath);

        $this->info('Views folder structure created successfully:');
    }

    private function createFoldersAndFiles($structure, $basePath)
    {
        foreach ($structure as $folder => $contents) {
            $folderPath = $basePath . DIRECTORY_SEPARATOR . $folder;
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true, true);
            }
            $this->processContents($contents, $folderPath);
        }
    }

    private function processContents($contents, $folderPath)
    {
        foreach ($contents as $subfolder => $subcontents) {
            if (is_array($subcontents)) {
                $subfolderPath = $folderPath . DIRECTORY_SEPARATOR . $subfolder;
                if (!File::exists($subfolderPath)) {
                    File::makeDirectory($subfolderPath, 0755, true, true);
                }
                $this->processContents($subcontents, $subfolderPath);
            } else {
                $filePath = $folderPath . DIRECTORY_SEPARATOR . $subcontents;
                if (!File::exists($filePath)) {
                    File::put($filePath, '');
                    $this->line('- ' . $filePath);
                }
            }
        }
    }
}
