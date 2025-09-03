<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateSweetAlertFile extends Command
{
    use CodeManipulationTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:sweet-alert-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update sweetAlert.js file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sweetAlertJsFilePath = public_path('js/common/base/messages/sweetAlert.js');

        $code = <<< 'JS'
        import { Translator } from '../../translation/translation.js'
import { __SWEET_ALERT_CFG__ } from '../config/config.js';

let t = new Translator();

export class SweetAlert {
    static async deleteSuccess(title, text, options = {}) {
        const defaultOptions = {
            title: title || t.getSweetAlertSuccess('delete.title'),
            text: text || t.getSweetAlertSuccess('delete.text'),
            icon: 'success',
            timer: __SWEET_ALERT_CFG__.TIMER,
            timerProgressBar: __SWEET_ALERT_CFG__.TIMER_PROGRESS_BAR,
            customClass: {
                title: 'custom-title-class-success-delete',
                text: 'custom-text-class-success-delete',
                confirmButton: 'custom-confirm-button-class-success-delete',
            },
            ...options
        };

        await Swal.fire(defaultOptions);
    }

    static async error(title, text, options = {}) {
        const defaultOptions = {
            title: title || t.getSweetAlertError('default.title'),
            text: text || t.getSweetAlertError('default.text'),
            icon: 'error',
            timerProgressBar: __SWEET_ALERT_CFG__.TIMER_PROGRESS_BAR,
            timer: __SWEET_ALERT_CFG__.TIMER,
            customClass: {
                title: 'custom-title-class-error',
                text: 'custom-text-class-error',
                confirmButton: 'custom-confirm-button-class-error',
            },
            ...options
        };

        await Swal.fire(defaultOptions);
    }

    static async deleteAction(title = t.getSweetAlertConfirm('delete.title'), text = t.getSweetAlertConfirm('delete.text'), confirmButtonText = t.getSweetAlertButton('delete'), cancelButtonText = t.getSweetAlertButton('cancel'), options = {}) {
        const defaultOptions = {
            icon: 'warning',
            html: `<div class="custom-delete-alert">${t.getSweetAlertConfirm('delete.text')}</div>`,
            showCancelButton: true,
            confirmButtonText: confirmButtonText,
            cancelButtonText: cancelButtonText,
            customClass: {
                title: 'custom-title-class-delete',
                confirmButton: 'custom-confirm-button-class-delete',
                cancelButton: 'custom-cancel-button-class-delete',
                text: 'custom-text-class-delete'
            },
            reverseButtons: true,
            focusCancel: true,
            allowOutsideClick: false,
            ...options
        };

        const result = await Swal.fire({
            title: title,
            text: text,
            ...defaultOptions
        });

        return result.isConfirmed;
    }
}
JS;
        $this->addCodeToFile($sweetAlertJsFilePath, $code);
        $this->info('The sweetAlert.js file has been updated successfully.');
    }
}
