<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateControllerFiles;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateLoginController extends Command
{
    use CodeManipulationTrait;

    protected $signature = 'update:login-controller';
    protected $description = 'Update LoginController to include custom authenticated method';

    public function handle()
    {
        $loginControllerFilePath = app_path('Http/Controllers/Auth/LoginController.php');

        $code = <<<PHP
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected \$redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        \$this->middleware('guest')->except('logout');
    }

    protected function authenticated()
    {
        \$redirectToWithQuery = \$this->redirectTo . '?success=1';
        return response()->json(['redirect' => \$redirectToWithQuery]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

PHP;

        $this->addCodeToFile($loginControllerFilePath, $code);
    }
}
