<?php

namespace App\Console\Commands\Lebify\Dashboard\Layout\Create\Components;

use Illuminate\Console\Command;

class footer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lebify:dashboard-component-footer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new footer component';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = resource_path('views/dashboard/components/footer.blade.php');
        $directoryPath = dirname($filePath);

        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }
        $fileContent = <<<'HTML'
        <div
                class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                <!--begin::Copyright-->
                                <div class="text-gray-900 order-2 order-md-1">
                                    <span class="text-muted fw-semibold me-1">2024&copy;</span>
                                    <a href="https://keenthemes.com" target="_blank"
                                        class="text-gray-800 text-hover-primary">Lebify</a>
                                </div>
                                <!--end::Copyright-->
                                <!--begin::Menu-->
                                <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                                    <li class="menu-item">
                                        <a href="#" target="_blank" class="menu-link px-2">Dany Seifeddine</a>
                                    </li>
                                </ul>
                                <!--end::Menu-->
                            </div>
        HTML;
        file_put_contents($filePath, $fileContent);
        $this->info('Footer component created successfully');
    }
}
