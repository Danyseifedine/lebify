<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateRouteFiles;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateRoutes extends Command
{

    use CodeManipulationTrait;
    protected $signature = 'update:routes';
    protected $description = 'Update web routes to include email verification';

    public function handle()
    {
        $routesFilePath = base_path('routes/web.php');

        $code = <<<ROUTE
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
        });
    });


ROUTE;

        $this->addCodeToFile($routesFilePath, $code);
    }
}
