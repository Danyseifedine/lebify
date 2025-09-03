<?php

namespace App\Console\Commands\Lebify\Dashboard\Routes;

use Illuminate\Console\Command;

class CreateRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lebify:dashboard-route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command creates a new route in the Lebify dashboard';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $routeName = 'dashboard';
        $filePath = base_path("routes/{$routeName}.php");

        if (file_exists($filePath)) {
            $this->error("The route file '{$routeName}.php' already exists.");
            return;
        }

        $routeContent = <<<ROUTE
        <?php

        use App\Http\Controllers\Dashboard\DashboardController;
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\Route;






        Route::prefix('dashboard')->name('dashboard.')->group(function () {

            // Dashboard routes
            Route::controller(DashboardController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });
        ROUTE;

        file_put_contents($filePath, $routeContent);

        $this->info("The route file '{$routeName}.php' has been created successfully.");
    }
}
