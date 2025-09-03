<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateEnvFile;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateMailConfiguration extends Command
{
    use CodeManipulationTrait;

    protected $signature = 'update:mail';
    protected $description = 'Update mail configuration in .env file';

    public function handle()
    {
        $envFilePath = base_path('.env');

        $code = <<<CODE
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:mwNPWYMwy91bKscvLH5JqKIn8Mo3jGyuiQF2dUlS/mM=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=lebify@gmail.com
MAIL_PASSWORD=xcfqpwualpsjetwj
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="lebify@gmail.com"
MAIL_FROM_NAME="LEBIFY"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="\${APP_NAME}"
VITE_PUSHER_APP_KEY="\${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="\${PUSHER_HOST}"
VITE_PUSHER_PORT="\${PUSHER_PORT}"
VITE_PUSHER_SCHEME="\${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="\${PUSHER_APP_CLUSTER}"

CODE;

        $this->addCodeToFile($envFilePath, $code);;
    }
}
