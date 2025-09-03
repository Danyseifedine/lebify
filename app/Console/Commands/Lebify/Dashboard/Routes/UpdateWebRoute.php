<?php

namespace App\Console\Commands\Lebify\Dashboard\Routes;

use Illuminate\Console\Command;

class UpdateWebRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lebify:dashboard-web-route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
    $routeName = 'web';
    $filePath = base_path("routes/{$routeName}.php");

    if (!file_exists($filePath)) {
        $this->error("The route file '{$routeName}.php' does not exist.");
        return;
    }

    $routeContent = <<<ROUTE
    <?php

    use App\Http\Controllers\Auth\LoginController;
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;





    Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ], function () {

        // Landing page
        Route::get('/', function () {
            return view('welcome');
        });

        // Auth routes
        Auth::routes(['verify' => true]);

        // Logout route
        Route::middleware(['auth'])->group(function () {
            Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
        });

        Route::middleware(['verified'])->group(function () {
            Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

            include __DIR__ . DIRECTORY_SEPARATOR . 'dashboard.php';
        });
    });
    ROUTE;

    file_put_contents($filePath, $routeContent);

    $this->info("The route file '{$routeName}.php' has been updated successfully.");
    }
}
