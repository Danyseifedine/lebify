<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateModelFiles;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateUserModel extends Command
{
    use CodeManipulationTrait;

    protected $signature = 'update:user-model';
    protected $description = 'Update User model to implement MustVerifyEmail interface';

    public function handle()
    {
        $userModelFilePath = app_path('Models/User.php');

        // Read the contents of the User model file

$code = <<<PHP
<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected \$fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected \$hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected \$casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

PHP;
        $this->addCodeToFile($userModelFilePath, $code);
    }
}
