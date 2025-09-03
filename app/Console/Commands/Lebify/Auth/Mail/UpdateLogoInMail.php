<?php

namespace App\Console\Commands\Lebify\Auth\Mail;

use Illuminate\Console\Command;

class UpdateLogoInMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:default-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the default mail configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating the default mail configuration');

        $this->call('vendor:publish', ['--tag' => 'laravel-mail']);
        $this->info('Mail configuration updated');

        $headerViewPath = resource_path('views/vendor/mail/html/header.blade.php');
        $newHeaderContent = <<<HTML
@props(['url'])
<tr>
    <td class="header">
        <a href="{{ \$url }}" style="display: inline-block;">
                <img src="https://raw.githubusercontent.com/daniseifeddine/Ds-Validator-Toolkit/main/media/logo.png" class="logo" alt="Lebify Logo">
        </a>
    </td>
</tr>

HTML;

        if (file_exists($headerViewPath)) {
            file_put_contents($headerViewPath, $newHeaderContent);
            $this->info('Mail header updated successfully');
        } else {
            $this->error('Mail header view file does not exist');
        }
    }
}
