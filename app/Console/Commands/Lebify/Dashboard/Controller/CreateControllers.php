<?php

namespace App\Console\Commands\Lebify\Dashboard\Controller;

use Illuminate\Console\Command;

class CreateControllers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lebify:dashboard-create-controllers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create dashboard controllers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating dashboard controllers...');
        $this->call('make:controller', ['name' => 'Dashboard/DashboardController']);

        $filePath = app_path('Http/Controllers/Dashboard/DashboardController.php');

        $controllerContent = <<<CONTROLLER
        <?php

        namespace App\Http\Controllers\Dashboard;

        use App\Http\Controllers\Controller;
        use Illuminate\Http\Request;

        class DashboardController extends Controller
        {
            public function index()
            {
                \$user = auth()->user();
                return view('dashboard.pages.dashboard', compact('user'));
            }
        }

        CONTROLLER;

        file_put_contents($filePath, $controllerContent);

        $this->info("The controller 'DashboardController' has been created successfully.");
    }
}
