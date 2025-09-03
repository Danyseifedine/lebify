<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateCssFiles;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class AppCssFile extends Command
{

    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:-css-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the app.css file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $loginJsFilePath = public_path('css/app.css');

        $code = <<<'CSS'
@import url('https://fonts.googleapis.com/css2?family=Changa:wght@200..800&display=swap');
@import url("https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@500&family=Montserrat:wght@400;500;600&display=swap");


:lang(ar) {
    font-family: "Changa", sans-serif !important;
}

:lang(ar) {
    font-family: "Changa", sans-serif !important;
}

:lang(ar) .iziToast {
    font-family: "Changa", sans-serif !important;
}

:lang(ar) .iziToast-title {
    font-weight: bolder !important;
    font-size: 16px !important;
    font-family: "Changa", sans-serif !important;
}

:lang(ar) .iziToast-message {
    font-size: 14px !important;
    font-weight: 500 !important;
    font-family: "Changa", sans-serif !important;
}

.iziToast {
    font-family: Inter, Helvetica, sans-serif !important;
}

.iziToast-title {
    font-weight: bolder !important;
    font-size: 16px !important;
    font-family: Inter, Helvetica, sans-serif !important;
}

.iziToast-message {
    font-size: 14px !important;
    font-weight: 500 !important;
    font-family: Inter, Helvetica, sans-serif !important;
}


.dropzone.empty {
    border: 2px dashed #ff4d4d;
    /* Dashed red border */
    padding: 20px;
    border-radius: 5px;
}

.dropzone .dz-message {
    color: #ff4d4d;
    /* Red text for the dropzone message */
}

.dropzone .dz-message:hover {
    color: #cc0000;
    /* Darker red on hover */
}

.dropzone .form-control-icon {
    color: #ff4d4d;
    /* Red icon color */
}

.select2-selection__choice__remove {
    right: auto;
    left: 5px;
}

.bg-logo {
    background-color: #F77E15 !important;
    color: white !important;
}

.bg-logo:hover {
    background-color: #cc6d00 !important;
    color: white !important;
}

.text-logo {
    color: #F77E15 !important;
}

.auth {
    background-image: url('/vendor/img/bg/LEBIFY-light-1.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: bottom;
}


[data-bs-theme="dark"] .auth {
    background-image: url('/vendor/img/bg/LEBIFY-dark-1.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: bottom;
}

.languageBox {
    background-color: white;
}

[data-bs-theme="dark"] .languageBox {
background-color: rgb(26, 26, 26);
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

[data-bs-theme="dark"] .custom-title-class-delete {
    color: #ffffff !important;
}

.custom-title-class-delete {
    font-size: 16px !important;
    font-weight: bold !important;
}

/* start ========== Delete alert confirmation ============ */
.custom-confirm-button-class-delete{
    background-color: #dc2626 !important;
    color: #ffffff !important;
}

.custom-cancel-button-class-delete{
    background-color: #333333 !important;
    color: #ffffff !important;
}

/* end ========== Delete alert confirmation ============ */

/* start ========== Delete success alert  ============ */

[data-bs-theme="dark"] .custom-title-class-success-delete{
    color: #ffffff !important;
}

.custom-confirm-button-class-success-delete{
    background-color: #28a745 !important;
    color: #ffffff !important;
}

.swal2-icon.swal2-success .swal2-success-ring{
    border-color: transparent !important;
}

.swal2-icon.swal2-warning .swal2-warning-ring{
    border-color: transparent !important;
}

/* end ========== Delete success alert  ============ */

/* start ========== Delete error alert  ============ */

[data-bs-theme="dark"] .custom-title-class-error{
    color: #ffffff !important;
}

.custom-confirm-button-class-error{
    background-color: #E42855 !important;
    color: #ffffff !important;
}

/* end ========== Delete error alert  ============ */

.datatable-btn {
    transition: all 0.3s ease;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.datatable-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.data-table-action-edit {
    background-color: #0d6dfd1d !important;
    box-shadow: 0 2px 4px rgba(13, 109, 253, 0.2), 0 1px 2px rgba(13, 109, 253, 0.1) !important;
    transition: all 0.3s ease;
}

.data-table-action-edit:hover {
    background-color: #0d6dfd61 !important;
    color: #fff !important;
    box-shadow: 0 4px 8px rgba(13, 109, 253, 0.3), 0 2px 4px rgba(13, 109, 253, 0.2) !important;
    transform: translateY(-1px);
}

.data-table-action-show {
    background-color: #1987541d !important;
    box-shadow: 0 2px 4px rgba(25, 135, 84, 0.2), 0 1px 2px rgba(25, 135, 84, 0.1) !important;
    transition: all 0.3s ease;
}

.data-table-action-show:hover {
    background-color: #19875461 !important;
    box-shadow: 0 4px 8px rgba(25, 135, 84, 0.3), 0 2px 4px rgba(25, 135, 84, 0.2) !important;
    transform: translateY(-1px);
}

.data-table-action-delete {
    background-color: #dc35451d !important;
    box-shadow: 0 2px 4px rgba(220, 53, 69, 0.2), 0 1px 2px rgba(220, 53, 69, 0.1) !important;
    transition: all 0.3s ease;
}

.data-table-action-delete:hover {
    background-color: #dc354561 !important;
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3), 0 2px 4px rgba(220, 53, 69, 0.2) !important;
    transform: translateY(-1px);
}

.select-info{
    display: none !important;
}

.datatable-body{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

.card-error{
    background: rgba(255, 255, 255, 0.3) !important;
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37) !important;
    backdrop-filter: blur(9.5px) !important;
    -webkit-backdrop-filter: blur(9.5px) !important;
    border-radius: 10px !important;
    border: 1px solid rgba(255, 255, 255, 0.18) !important;
}

[data-bs-theme="light"] .skeleton-wrapper {
    padding: 20px;
    background: #f8f9fa;
    border-radius: 4px;
}

[data-bs-theme="light"] .skeleton-header,
[data-bs-theme="light"] .skeleton-text,
[data-bs-theme="light"] .skeleton-button {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

[data-bs-theme="light"] .skeleton-header {
    height: 30px;
    margin-bottom: 20px;
    width: 50%;
}

[data-bs-theme="light"] .skeleton-text {
    height: 20px;
    margin-bottom: 15px;
}

[data-bs-theme="light"] .skeleton-text:last-of-type {
    width: 80%;
}

[data-bs-theme="light"] .skeleton-button {
    height: 35px;
    width: 120px;
    border-radius: 4px;
}

[data-bs-theme="dark"] .skeleton-wrapper {
    padding: 20px;
    background: rgb(21, 23, 28);
    border-radius: 4px;
}

[data-bs-theme="dark"] .skeleton-header,
[data-bs-theme="dark"] .skeleton-text,
[data-bs-theme="dark"] .skeleton-button {
    background: linear-gradient(90deg, rgb(31, 33, 38) 25%, rgb(41, 43, 48) 50%, rgb(31, 33, 38) 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

[data-bs-theme="dark"] .skeleton-header {
    height: 30px;
    margin-bottom: 20px;
    width: 50%;
}

[data-bs-theme="dark"] .skeleton-text {
    height: 20px;
    margin-bottom: 15px;
}

[data-bs-theme="dark"] .skeleton-text:last-of-type {
    width: 80%;
}

[data-bs-theme="dark"] .skeleton-button {
    height: 35px;
    width: 120px;
    border-radius: 4px;
}

@keyframes loading {
    0% {
        background-position: 200% 0;
    }

    100% {
        background-position: -200% 0;
    }
}


@media (max-width: 768px) {
    .dt-toolbar{
        margin-top: 50px !important;
    }
}


@media (max-width: 576px) {
    .datatable-body {
        gap: 10px;
        flex-direction: column !important;
    }
}

/* start ===================================== */
/* start ============= animation ============= */
/* start ===================================== */
/* animation for scale up */
.lebify-scale-up {
    transition: transform 0.2s ease-in-out;
}

.lebify-scale-up:hover {
    transition: transform 0.2s ease-in-out;
    transform: scale(1.02);
}

.lebify-scale-up:not(:hover) {
    transform: scale(1);
}
/* Fade In Animation */
.lebify-fade-in {
    animation: fadeIn 1s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Slide In From Left Animation */
.lebify-slide-in-left:hover {
    animation: slideInLeft 0.5s ease-out;
}

@keyframes slideInLeft {
    from { transform: translateX(-100%); }
    to { transform: translateX(0); }
}

/* Bounce Animation */
.lebify-bounce:hover {
    animation: bounce 0.5s ease;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* Rotate Animation */
.lebify-rotate:hover {
    animation: rotate 2s linear;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Pulse Animation */
.lebify-pulse:hover {
    animation: pulse 1s ease;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Shake Animation */
.lebify-shake:hover {
    animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
}

@keyframes shake {
    10%, 90% { transform: translate3d(-1px, 0, 0); }
    20%, 80% { transform: translate3d(2px, 0, 0); }
    30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
    40%, 60% { transform: translate3d(4px, 0, 0); }
}

CSS;

        $this->addCodeToFile($loginJsFilePath, $code);
        $this->info('The app.css file has been updated successfully.');
    }
}
