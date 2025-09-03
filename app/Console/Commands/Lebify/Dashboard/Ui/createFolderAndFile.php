<?php

namespace App\Console\Commands\Lebify\Dashboard\Ui;

use Illuminate\Console\Command;

class createFolderAndFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lebify:dashboard-create-folder-and-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a folder and file for the dashboard';

    /**
     * Execute the console command.
     */
    public function handle()
    {
    $folderPath = resource_path('views/dashboard/pages');
    $filePath = $folderPath . '/dashboard.blade.php';

    if (!file_exists($folderPath)) {
        mkdir($folderPath, 0755, true);
        $this->info("Folder created at: $folderPath");
    } else {
        $this->info("Folder already exists at: $folderPath");
    }

    if (!file_exists($filePath)) {
        file_put_contents($filePath, "@extends('layouts.dashboard')\n");
        $this->info("File created at: $filePath");
    } else {
        $this->info("File already exists at: $filePath");
    }
    }
}
