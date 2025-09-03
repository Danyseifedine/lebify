<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateCssFiles;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class LoadingCssFile extends Command
{

    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:loading-css-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the loading.css file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $loginJsFilePath = public_path('css/loading/loading.css');

        $code = <<<'CSS'
.loading_version_3 {
    width: 20px;
    aspect-ratio: 1;
    --c: no-repeat repeating-linear-gradient(90deg, #000 0 20%, #0000 0 40%);
    background: var(--c), var(--c), var(--c), var(--c);
    background-size: 100% 26%;
    animation: loading_version_3_ 1.5s infinite;
}

@keyframes loading_version_3_ {
    0% {
        background-position: -50px calc(0*100%/3), -50px calc(1*100%/3), -50px calc(2*100%/3), -50px calc(3*100%/3)
    }

    12.5% {
        background-position: 0 calc(0*100%/3), -50px calc(1*100%/3), -50px calc(2*100%/3), -50px calc(3*100%/3)
    }

    25% {
        background-position: 0 calc(0*100%/3), 0 calc(1*100%/3), -50px calc(2*100%/3), -50px calc(3*100%/3)
    }

    37.5% {
        background-position: 0 calc(0*100%/3), 0 calc(1*100%/3), 0 calc(2*100%/3), -50px calc(3*100%/3)
    }

    45%,
    55% {
        background-position: 0 calc(0*100%/3), 0 calc(1*100%/3), 0 calc(2*100%/3), 0 calc(3*100%/3)
    }

    62.5% {
        background-position: 50px calc(0*100%/3), 0 calc(1*100%/3), 0 calc(2*100%/3), 0 calc(3*100%/3)
    }

    75% {
        background-position: 50px calc(0*100%/3), 50px calc(1*100%/3), 0 calc(2*100%/3), 0 calc(3*100%/3)
    }

    87.5% {
        background-position: 50px calc(0*100%/3), 50px calc(1*100%/3), 50px calc(2*100%/3), 0 calc(3*100%/3)
    }

    100% {
        background-position: 50px calc(0*100%/3), 50px calc(1*100%/3), 50px calc(2*100%/3), 50px calc(3*100%/3)
    }
}

.loading_version_4 {
    width: 15px;
    padding: 3px;
    aspect-ratio: 1;
    border-radius: 50%;
    background: #000000;
    --_m:
        conic-gradient(#0000 10%, #000),
        linear-gradient(#000 0 0) content-box;
    -webkit-mask: var(--_m);
    mask: var(--_m);
    -webkit-mask-composite: source-out;
    mask-composite: subtract;
    animation: loading_version_4_ 1s infinite linear;
}

@keyframes loading_version_4_ {
    to {
        transform: rotate(1turn)
    }
}

.loading_version_5 {
    width: 20px;
    --b: 8px;
    aspect-ratio: 1;
    border-radius: 50%;
    padding: 1px;
    background: conic-gradient(#0000 10%, #ffffff) content-box;
    -webkit-mask:
        repeating-conic-gradient(#0000 0deg, #000 1deg 20deg, #0000 21deg 36deg),
        radial-gradient(farthest-side, #0000 calc(100% - var(--b) - 1px), #000 calc(100% - var(--b)));
    -webkit-mask-composite: destination-in;
    mask-composite: intersect;
    animation: loading_version_5_ 1s infinite steps(10);
}

@keyframes loading_version_5_ {
    to {
        transform: rotate(1turn)
    }
}


.loading_version_6 {
    width: 20px;
    aspect-ratio: 1;
    color: #ffffff;
    --_c: no-repeat radial-gradient(farthest-side, currentColor 92%, #0000);
    background:
        var(--_c) 50% 0 /4px 4px,
        var(--_c) 50% 100%/4px 4px,
        var(--_c) 100% 50%/4px 4px,
        var(--_c) 0 50%/4px 4px,
        var(--_c) 50% 50%/4px 4px,
        conic-gradient(from 90deg at 2px 2px, #0000 90deg, currentColor 0) -2px -2px/calc(50% + 1px) calc(50% + 1px);
    animation: loading_version_6_ 1s infinite linear;
}

@keyframes loading_version_6_ {
    to {
        transform: rotate(.5turn)
    }
}


.loading_version_7 {
    width: 20px;
    aspect-ratio: 1;
    border-radius: 50%;
    padding: 1px;
    background:
        radial-gradient(farthest-side, #ffffff 95%, #0000) 50% 0/4px 4px no-repeat,
        radial-gradient(farthest-side, #0000 calc(100% - 2px), #000000 calc(100% - 2px)) content-box;
    animation: loading_version_7_ 2s infinite;
}

@keyframes loading_version_7_ {
    to {
        transform: rotate(1turn)
    }
}


.loading_version_8 {
    --s: 15px;

    --_d: calc(0.353*var(--s));
    width: calc(var(--s) + var(--_d));
    aspect-ratio: 1;
    clip-path: polygon(var(--_d) 0, 100% 0, 100% calc(100% - var(--_d)), calc(100% - var(--_d)) 100%, 0 100%, 0 var(--_d));
    background:
        conic-gradient(from -90deg at var(--s) var(--_d),
            #ffffff 135deg, #bcbcbc 0 270deg, #d5d5d5 0);
    animation: loading_version_8_ 1s infinite cubic-bezier(0.5, 300, 0.5, -300);
}

@keyframes loading_version_8_ {

    50%,
    100% {
        transform: translateY(0.1px)
    }
}


.loading_version_9 {
    --s: 25px;
    --g: 5px;

    width: calc(3*(1.353*var(--s) + var(--g)));
    display: grid;
    justify-items: end;
    aspect-ratio: 3;
    overflow: hidden;
    --_m: linear-gradient(90deg, #0000, #000 15px calc(100% - 15px), #0000);
    -webkit-mask: var(--_m);
    mask: var(--_m);
}

.loading_version_9:before {
    content: "";
    width: calc(4*100%/3);
    background:
        conic-gradient(from -90deg at var(--s) calc(0.353*var(--s)),
            #fff 135deg, #666 0 270deg, #aaa 0);
    --_m:
        linear-gradient(to bottom right,
            #0000 calc(0.25*var(--s)), #000 0 calc(100% - calc(0.25*var(--s)) - 1.414*var(--g)), #0000 0),
        conic-gradient(from -90deg at right var(--g) bottom var(--g), #000 90deg, #0000 0);
    -webkit-mask: var(--_m);
    mask: var(--_m);
    background-size: calc(100%/4) 100%;
    -webkit-mask-size: calc(100%/4) 100%;
    mask-size: calc(100%/4) 100%;
    -webkit-mask-composite: source-in;
    mask-composite: intersect;
    animation: loading_version_9_ 1s infinite linear;
}

@keyframes loading_version_9_ {
    to {
        transform: translate(calc(100%/4))
    }
}

.loading_full_screen_version {
    position: fixed;
    z-index: 999;
    height: 2em;
    width: 2em;
    overflow: show;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.loading_full_screen_version {
    position: fixed;
    z-index: 999;
    height: 2em;
    width: 2em;
    overflow: show;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

.loading_full_screen_version:before {
    content: '';
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(rgba(0, 0, 0, 0.54), rgba(0, 0, 0, 0.511));
}

@keyframes spin3D {
    from {
        transform: rotate3d(.5, .5, .5, 360deg);
    }

    to {
        transform: rotate3d(0deg);
    }
}

@keyframes version_10_configure-clockwise {
    0% {
        transform: rotate(0);
    }

    25% {
        transform: rotate(90deg);
    }

    50% {
        transform: rotate(180deg);
    }

    75% {
        transform: rotate(270deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

@keyframes version_10_pulse {
    from {
        opacity: 1;
        transform: scale(1);
    }

    to {
        opacity: .25;
        transform: scale(.75);
    }
}

/* GRID STYLING */

.loading_version_10 .spinner-box {
    width: 300px;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: transparent;
}

/* SPINNING CIRCLE */


/* ALTERNATING ORBITS */



.loading_version_10 .configure-border-1 {
    width: 115px;
    height: 115px;
    padding: 3px;
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #fb5b53;
    animation: version_10_configure-clockwise 3s ease-in-out 0s infinite alternate;
}

.loading_version_10 .configure-border-2 {
    width: 115px;
    height: 115px;
    padding: 3px;
    left: -115px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgb(63, 249, 220);
    transform: rotate(45deg);
    animation: configure-xclockwise 3s ease-in-out 0s infinite alternate;
}

.loading_version_10 .configure-core {
    width: 100%;
    height: 100%;
    background-color: #1d2630;
}

/* PULSE BUBBLES */


.loading_version_10 .pulse-bubble-1 {
    animation: version_10_pulse .4s ease 0s infinite alternate;
}

.loading_version_10 .pulse-bubble-2 {
    animation: version_10_pulse .4s ease .2s infinite alternate;
}

.loading_version_10 .pulse-bubble-3 {
    animation: version_10_pulse .4s ease .4s infinite alternate;
}



.loading_version_10 .leo {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
}

.loading_version_10 .blue-orbit {
    width: 165px;
    height: 165px;
    border: 2px solid #91daffa5;
    -webkit-animation: spin3D 3s linear .2s infinite;
}

.loading_version_10 .green-orbit {
    width: 120px;
    height: 120px;
    border: 2px solid #91ffbfa5;
    -webkit-animation: spin3D 2s linear 0s infinite;
}

.loading_version_10 .red-orbit {
    width: 90px;
    height: 90px;
    border: 2px solid #ffca91a5;
    -webkit-animation: spin3D 1s linear 0s infinite;
}

.loading_version_10 .white-orbit {
    width: 60px;
    height: 60px;
    border: 1px solid #ffffff;
    -webkit-animation: spin3D 10s linear 0s infinite;
}

/* HTML: <div class="loader"></div> */
.loading_version_11 {
    z-index: 999999;
    width: 50px;
    aspect-ratio: 1;
    border: 2px solid;
    box-sizing: border-box;
    border-radius: 50%;
    display: grid;
    animation: l11 1.5s infinite linear;
    transform-origin: 50% 80%;
}

.loading_version_11:before,
.loading_version_11:after {
    content: "";
    grid-area: 1/1;
    border: inherit;
    border-radius: 50%;
    animation: inherit;
    animation-duration: 1s;
    transform-origin: inherit;
}

.loading_version_11:after {
    --s: -1;
}

@keyframes l11 {
    100% {
        transform: rotate(calc(var(--s, 1)*1turn))
    }
}
CSS;

        $this->addCodeToFile($loginJsFilePath, $code);
        $this->info('The email.js file has been updated successfully.');
    }
}
