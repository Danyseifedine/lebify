<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateControllerFiles;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateResetPasswordControllerFile extends Command
{
    use CodeManipulationTrait;

    protected $signature = 'update:reset-password-controller';
    protected $description = 'Update ResetPasswordController to include custom sendResetResponse method';

    public function handle()
    {
        $resetPasswordControllerFilePath = app_path('Http/Controllers/Auth/ResetPasswordController.php');

        $code = <<<PHP
<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected \$redirectTo = '/home';
    protected function sendResetResponse(Request \$request, \$response)
    {
        // Customize the response based on your requirements
        if (\$request->wantsJson()) {
            return new JsonResponse(['redirect' => \$this->redirectTo]);
        }

        return redirect(\$this->redirectTo)->with('status', trans(\$response));
    }}

PHP;
        $this->addCodeToFile($resetPasswordControllerFilePath, $code);
    }
}
