<?php

namespace App\Console\Commands\Lebify\Auth\Create;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateFolders extends Command
{
    protected $signature = 'create:folders-files';
    protected $description = 'Create folder structure for All files';

    public function handle()
    {

        $structure = [
            'js' => [
                'auth' => ['login.js', 'register.js', 'email.js', 'reset.js', 'verify.js', 'logout.js'],
                'common' => [
                    'base' => [
                        'config' => ['config.js'],
                        'api' => ['request.js'],
                        'script' => ['scriptLoader.js'],
                        'loadingButton' => ['loadingButton.js'],
                        'formHandler' => ['formHandler.js'],
                        'messages' => ['toast.js', 'sweetAlert.js'],
                        'error' => ['error.js'],
                        'utils' => ['utils.js']
                    ],
                    'core' => ['controllers.js']
                ]
            ],
            'css' => [
                'app.css',
                'loading' => ['loading.css']
            ],
            'packages' => [
                'iziToast' => [
                    'js' => [
                        'iziToast.js', 'iziToast.min.js'
                    ],
                    'css' => [
                        'iziToast.min.css'
                    ]
                ],
                'sweetAlert' => [
                    'js' => [
                        'sweetAlert.min.js'
                    ],
                    'css' => [
                        'sweetAlert.min.css'
                    ]
                ]
            ]
        ];

        $publicPath = public_path();
        $this->createFoldersAndFiles($structure, $publicPath);

        $this->info('folder structure created successfully:');
    }

    private function createFoldersAndFiles($structure, $basePath)
    {
        foreach ($structure as $folder => $contents) {
            $folderPath = $basePath . DIRECTORY_SEPARATOR . $folder;
            File::makeDirectory($folderPath, 0755, true, true);
            if (is_array($contents)) {
                foreach ($contents as $subfolder => $subcontents) {
                    if (is_array($subcontents)) {
                        $this->createFoldersAndFiles([$subfolder => $subcontents], $folderPath);
                    } else {
                        $filePath = $folderPath . DIRECTORY_SEPARATOR . $subcontents;
                        File::put($filePath, '');
                        $this->line('- ' . $filePath);
                    }
                }
            } else {
                $filePath = $folderPath . DIRECTORY_SEPARATOR . $contents;
                File::put($filePath, '');
                $this->line('- ' . $filePath);
            }
        }
    }
}
