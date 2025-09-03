<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait CodeManipulationTrait
{
    protected function addCodeToFile($filePath, $codeToAdd)
    {
        File::put($filePath, $codeToAdd);

        $this->info('Code added successfully to ' . $filePath);
    }

    protected function createFile($fileName, $path, $content)
    {
        $filePath = $path . '/' . $fileName;

        // Check if the file already exists
        if (File::exists($filePath)) {
            $this->info('The ' . $fileName . ' file already exists at ' . $path);
            return;
        }

        // Create the directory if it doesn't exist
        $directory = dirname($filePath);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Create the file with the provided content
        File::put($filePath, $content);

        $this->info('The ' . $fileName . ' file has been created at ' . $path);
    }
}
