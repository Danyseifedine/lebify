<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdatePackages;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateIziToastPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:iziToast-package';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the iziToast package file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $iziToastJsFilePath = public_path('Packages/iziToast/js/iziToast.js');
        $iziToastMinJsFilePath = public_path('Packages/iziToast/js/iziToast.min.js');
        $iziToastMinCssFilePath = public_path('Packages/iziToast/css/iziToast.min.css');

        $code = <<<'JS'

(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        define([], factory(root));
    } else if (typeof exports === 'object') {
        module.exports = factory(root);
    } else {
        root.iziToast = factory(root);
    }
})(typeof global !== 'undefined' ? global : window || this.window || this.global, function (root) {

    'use strict';

    var $iziToast = {},
        PLUGIN_NAME = 'iziToast',
        BODY = document.querySelector('body'),
        ISMOBILE = (/Mobi/.test(navigator.userAgent)) ? true : false,
        ISCHROME = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor),
        ISFIREFOX = typeof InstallTrigger !== 'undefined',
        ACCEPTSTOUCH = 'ontouchstart' in document.documentElement,
        POSITIONS = ['bottomRight', 'bottomLeft', 'bottomCenter', 'topRight', 'topLeft', 'topCenter', 'center'],
        THEMES = {
            info: {
                color: 'blue',
                icon: 'ico-info'
            },
            success: {
                color: 'green',
                icon: 'ico-success'
            },
            warning: {
                color: 'orange',
                icon: 'ico-warning'
            },
            error: {
                color: 'red',
                icon: 'ico-error'
            },
            question: {
                color: 'yellow',
                icon: 'ico-question'
            }
        },
        MOBILEWIDTH = 568,
        CONFIG = {};

    $iziToast.children = {};

    // Default settings
    var defaults = {
        id: null,
        class: '',
        title: '',
        titleColor: '',
        titleSize: '',
        titleLineHeight: '',
        message: '',
        messageColor: '',
        messageSize: '',
        messageLineHeight: '',
        backgroundColor: '',
        theme: 'light', // dark
        color: '', // blue, red, green, yellow
        icon: '',
        iconText: '',
        iconColor: '',
        iconUrl: null,
        image: '',
        imageWidth: 50,
        maxWidth: null,
        zindex: null,
        layout: 1,
        balloon: false,
        close: true,
        closeOnEscape: false,
        closeOnClick: false,
        displayMode: 0,
        position: 'bottomRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
        target: '',
        targetFirst: true,
        timeout: 5000,
        rtl: false,
        animateInside: true,
        drag: true,
        pauseOnHover: true,
        resetOnHover: false,
        progressBar: true,
        progressBarColor: '',
        progressBarEasing: 'linear',
        overlay: false,
        overlayClose: false,
        overlayColor: 'rgba(0, 0, 0, 0.6)',
        transitionIn: 'fadeInUp', // bounceInLeft, bounceInRight, bounceInUp, bounceInDown, fadeIn, fadeInDown, fadeInUp, fadeInLeft, fadeInRight, flipInX
        transitionOut: 'fadeOut', // fadeOut, fadeOutUp, fadeOutDown, fadeOutLeft, fadeOutRight, flipOutX
        transitionInMobile: 'fadeInUp',
        transitionOutMobile: 'fadeOutDown',
        buttons: {},
        inputs: {},
        onOpening: function () { },
        onOpened: function () { },
        onClosing: function () { },
        onClosed: function () { }
    };

    //
    // Methods
    //


    /**
     * Polyfill for remove() method
     */
    if (!('remove' in Element.prototype)) {
        Element.prototype.remove = function () {
            if (this.parentNode) {
                this.parentNode.removeChild(this);
            }
        };
    }

    /*
     * Polyfill for CustomEvent for IE >= 9
     * https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent/CustomEvent#Polyfill
     */
    if (typeof window.CustomEvent !== 'function') {
        var CustomEventPolyfill = function (event, params) {
            params = params || { bubbles: false, cancelable: false, detail: undefined };
            var evt = document.createEvent('CustomEvent');
            evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
            return evt;
        };

        CustomEventPolyfill.prototype = window.Event.prototype;

        window.CustomEvent = CustomEventPolyfill;
    }

    /**
     * A simple forEach() implementation for Arrays, Objects and NodeLists
     * @private
     * @param {Array|Object|NodeList} collection Collection of items to iterate
     * @param {Function} callback Callback function for each iteration
     * @param {Array|Object|NodeList} scope Object/NodeList/Array that forEach is iterating over (aka `this`)
     */
    var forEach = function (collection, callback, scope) {
        if (Object.prototype.toString.call(collection) === '[object Object]') {
            for (var prop in collection) {
                if (Object.prototype.hasOwnProperty.call(collection, prop)) {
                    callback.call(scope, collection[prop], prop, collection);
                }
            }
        } else {
            if (collection) {
                for (var i = 0, len = collection.length; i < len; i++) {
                    callback.call(scope, collection[i], i, collection);
                }
            }
        }
    };

    /**
     * Merge defaults with user options
     * @private
     * @param {Object} defaults Default settings
     * @param {Object} options User options
     * @returns {Object} Merged values of defaults and options
     */
    var extend = function (defaults, options) {
        var extended = {};
        forEach(defaults, function (value, prop) {
            extended[prop] = defaults[prop];
        });
        forEach(options, function (value, prop) {
            extended[prop] = options[prop];
        });
        return extended;
    };


    /**
     * Create a fragment DOM elements
     * @private
     */
    var createFragElem = function (htmlStr) {
        var frag = document.createDocumentFragment(),
            temp = document.createElement('div');
        temp.innerHTML = htmlStr;
        while (temp.firstChild) {
            frag.appendChild(temp.firstChild);
        }
        return frag;
    };


    /**
     * Generate new ID
     * @private
     */
    var generateId = function (params) {
        var newId = btoa(encodeURIComponent(params));
        return newId.replace(/=/g, "");
    };


    /**
     * Check if is a color
     * @private
     */
    var isColor = function (color) {
        if (color.substring(0, 1) == '#' || color.substring(0, 3) == 'rgb' || color.substring(0, 3) == 'hsl') {
            return true;
        } else {
            return false;
        }
    };


    /**
     * Check if is a Base64 string
     * @private
     */
    var isBase64 = function (str) {
        try {
            return btoa(atob(str)) == str;
        } catch (err) {
            return false;
        }
    };


    /**
     * Drag method of toasts
     * @private
     */
    var drag = function () {

        return {
            move: function (toast, instance, settings, xpos) {

                var opacity,
                    opacityRange = 0.3,
                    distance = 180;

                if (xpos !== 0) {

                    toast.classList.add(PLUGIN_NAME + '-dragged');

                    toast.style.transform = 'translateX(' + xpos + 'px)';

                    if (xpos > 0) {
                        opacity = (distance - xpos) / distance;
                        if (opacity < opacityRange) {
                            instance.hide(extend(settings, { transitionOut: 'fadeOutRight', transitionOutMobile: 'fadeOutRight' }), toast, 'drag');
                        }
                    } else {
                        opacity = (distance + xpos) / distance;
                        if (opacity < opacityRange) {
                            instance.hide(extend(settings, { transitionOut: 'fadeOutLeft', transitionOutMobile: 'fadeOutLeft' }), toast, 'drag');
                        }
                    }
                    toast.style.opacity = opacity;

                    if (opacity < opacityRange) {

                        if (ISCHROME || ISFIREFOX)
                            toast.style.left = xpos + 'px';

                        toast.parentNode.style.opacity = opacityRange;

                        this.stopMoving(toast, null);
                    }
                }


            },
            startMoving: function (toast, instance, settings, e) {

                e = e || window.event;
                var posX = ((ACCEPTSTOUCH) ? e.touches[0].clientX : e.clientX),
                    toastLeft = toast.style.transform.replace('px)', '');
                toastLeft = toastLeft.replace('translateX(', '');
                var offsetX = posX - toastLeft;

                if (settings.transitionIn) {
                    toast.classList.remove(settings.transitionIn);
                }
                if (settings.transitionInMobile) {
                    toast.classList.remove(settings.transitionInMobile);
                }
                toast.style.transition = '';

                if (ACCEPTSTOUCH) {
                    document.ontouchmove = function (e) {
                        e.preventDefault();
                        e = e || window.event;
                        var posX = e.touches[0].clientX,
                            finalX = posX - offsetX;
                        drag.move(toast, instance, settings, finalX);
                    };
                } else {
                    document.onmousemove = function (e) {
                        e.preventDefault();
                        e = e || window.event;
                        var posX = e.clientX,
                            finalX = posX - offsetX;
                        drag.move(toast, instance, settings, finalX);
                    };
                }

            },
            stopMoving: function (toast, e) {

                if (ACCEPTSTOUCH) {
                    document.ontouchmove = function () { };
                } else {
                    document.onmousemove = function () { };
                }

                toast.style.opacity = '';
                toast.style.transform = '';

                if (toast.classList.contains(PLUGIN_NAME + '-dragged')) {

                    toast.classList.remove(PLUGIN_NAME + '-dragged');

                    toast.style.transition = 'transform 0.4s ease, opacity 0.4s ease';
                    setTimeout(function () {
                        toast.style.transition = '';
                    }, 400);
                }

            }
        };

    }();





    $iziToast.setSetting = function (ref, option, value) {

        $iziToast.children[ref][option] = value;

    };


    $iziToast.getSetting = function (ref, option) {

        return $iziToast.children[ref][option];

    };


    /**
     * Destroy the current initialization.
     * @public
     */
    $iziToast.destroy = function () {

        forEach(document.querySelectorAll('.' + PLUGIN_NAME + '-overlay'), function (element, index) {
            element.remove();
        });

        forEach(document.querySelectorAll('.' + PLUGIN_NAME + '-wrapper'), function (element, index) {
            element.remove();
        });

        forEach(document.querySelectorAll('.' + PLUGIN_NAME), function (element, index) {
            element.remove();
        });

        this.children = {};

        // Remove event listeners
        document.removeEventListener(PLUGIN_NAME + '-opened', {}, false);
        document.removeEventListener(PLUGIN_NAME + '-opening', {}, false);
        document.removeEventListener(PLUGIN_NAME + '-closing', {}, false);
        document.removeEventListener(PLUGIN_NAME + '-closed', {}, false);
        document.removeEventListener('keyup', {}, false);

        // Reset variables
        CONFIG = {};
    };

    /**
     * Initialize Plugin
     * @public
     * @param {Object} options User settings
     */
    $iziToast.settings = function (options) {

        // Destroy any existing initializations
        $iziToast.destroy();

        CONFIG = options;
        defaults = extend(defaults, options || {});
    };


    /**
     * Building themes functions.
     * @public
     * @param {Object} options User settings
     */
    forEach(THEMES, function (theme, name) {

        $iziToast[name] = function (options) {

            var settings = extend(CONFIG, options || {});
            settings = extend(theme, settings || {});

            this.show(settings);
        };

    });


    /**
     * Do the calculation to move the progress bar
     * @private
     */
    $iziToast.progress = function (options, $toast, callback) {


        var that = this,
            ref = $toast.getAttribute('data-iziToast-ref'),
            settings = extend(this.children[ref], options || {}),
            $elem = $toast.querySelector('.' + PLUGIN_NAME + '-progressbar div');

        return {
            start: function () {

                if (typeof settings.time.REMAINING == 'undefined') {

                    $toast.classList.remove(PLUGIN_NAME + '-reseted');

                    if ($elem !== null) {
                        $elem.style.transition = 'width ' + settings.timeout + 'ms ' + settings.progressBarEasing;
                        $elem.style.width = '0%';
                    }

                    settings.time.START = new Date().getTime();
                    settings.time.END = settings.time.START + settings.timeout;
                    settings.time.TIMER = setTimeout(function () {

                        clearTimeout(settings.time.TIMER);

                        if (!$toast.classList.contains(PLUGIN_NAME + '-closing')) {

                            that.hide(settings, $toast, 'timeout');

                            if (typeof callback === 'function') {
                                callback.apply(that);
                            }
                        }

                    }, settings.timeout);
                    that.setSetting(ref, 'time', settings.time);
                }
            },
            pause: function () {

                if (typeof settings.time.START !== 'undefined' && !$toast.classList.contains(PLUGIN_NAME + '-paused') && !$toast.classList.contains(PLUGIN_NAME + '-reseted')) {

                    $toast.classList.add(PLUGIN_NAME + '-paused');

                    settings.time.REMAINING = settings.time.END - new Date().getTime();

                    clearTimeout(settings.time.TIMER);

                    that.setSetting(ref, 'time', settings.time);

                    if ($elem !== null) {
                        var computedStyle = window.getComputedStyle($elem),
                            propertyWidth = computedStyle.getPropertyValue('width');

                        $elem.style.transition = 'none';
                        $elem.style.width = propertyWidth;
                    }

                    if (typeof callback === 'function') {
                        setTimeout(function () {
                            callback.apply(that);
                        }, 10);
                    }
                }
            },
            resume: function () {

                if (typeof settings.time.REMAINING !== 'undefined') {

                    $toast.classList.remove(PLUGIN_NAME + '-paused');

                    if ($elem !== null) {
                        $elem.style.transition = 'width ' + settings.time.REMAINING + 'ms ' + settings.progressBarEasing;
                        $elem.style.width = '0%';
                    }

                    settings.time.END = new Date().getTime() + settings.time.REMAINING;
                    settings.time.TIMER = setTimeout(function () {

                        clearTimeout(settings.time.TIMER);

                        if (!$toast.classList.contains(PLUGIN_NAME + '-closing')) {

                            that.hide(settings, $toast, 'timeout');

                            if (typeof callback === 'function') {
                                callback.apply(that);
                            }
                        }


                    }, settings.time.REMAINING);

                    that.setSetting(ref, 'time', settings.time);
                } else {
                    this.start();
                }
            },
            reset: function () {

                clearTimeout(settings.time.TIMER);

                delete settings.time.REMAINING;

                that.setSetting(ref, 'time', settings.time);

                $toast.classList.add(PLUGIN_NAME + '-reseted');

                $toast.classList.remove(PLUGIN_NAME + '-paused');

                if ($elem !== null) {
                    $elem.style.transition = 'none';
                    $elem.style.width = '100%';
                }

                if (typeof callback === 'function') {
                    setTimeout(function () {
                        callback.apply(that);
                    }, 10);
                }
            }
        };

    };


    /**
     * Close the specific Toast
     * @public
     * @param {Object} options User settings
     */
    $iziToast.hide = function (options, $toast, closedBy) {

        if (typeof $toast != 'object') {
            $toast = document.querySelector($toast);
        }

        var that = this,
            settings = extend(this.children[$toast.getAttribute('data-iziToast-ref')], options || {});
        settings.closedBy = closedBy || null;

        delete settings.time.REMAINING;

        $toast.classList.add(PLUGIN_NAME + '-closing');

        // Overlay
        (function () {

            var $overlay = document.querySelector('.' + PLUGIN_NAME + '-overlay');
            if ($overlay !== null) {
                var refs = $overlay.getAttribute('data-iziToast-ref');
                refs = refs.split(',');
                var index = refs.indexOf(String(settings.ref));

                if (index !== -1) {
                    refs.splice(index, 1);
                }
                $overlay.setAttribute('data-iziToast-ref', refs.join());

                if (refs.length === 0) {
                    $overlay.classList.remove('fadeIn');
                    $overlay.classList.add('fadeOut');
                    setTimeout(function () {
                        $overlay.remove();
                    }, 700);
                }
            }

        })();

        if (settings.transitionIn) {
            $toast.classList.remove(settings.transitionIn);
        }

        if (settings.transitionInMobile) {
            $toast.classList.remove(settings.transitionInMobile);
        }

        if (ISMOBILE || window.innerWidth <= MOBILEWIDTH) {
            if (settings.transitionOutMobile)
                $toast.classList.add(settings.transitionOutMobile);
        } else {
            if (settings.transitionOut)
                $toast.classList.add(settings.transitionOut);
        }
        var H = $toast.parentNode.offsetHeight;
        $toast.parentNode.style.height = H + 'px';
        $toast.style.pointerEvents = 'none';

        if (!ISMOBILE || window.innerWidth > MOBILEWIDTH) {
            $toast.parentNode.style.transitionDelay = '0.2s';
        }

        try {
            var event = new CustomEvent(PLUGIN_NAME + '-closing', { detail: settings, bubbles: true, cancelable: true });
            document.dispatchEvent(event);
        } catch (ex) {
            console.warn(ex);
        }

        setTimeout(function () {

            $toast.parentNode.style.height = '0px';
            $toast.parentNode.style.overflow = '';

            setTimeout(function () {

                delete that.children[settings.ref];

                $toast.parentNode.remove();

                try {
                    var event = new CustomEvent(PLUGIN_NAME + '-closed', { detail: settings, bubbles: true, cancelable: true });
                    document.dispatchEvent(event);
                } catch (ex) {
                    console.warn(ex);
                }

                if (typeof settings.onClosed !== 'undefined') {
                    settings.onClosed.apply(null, [settings, $toast, closedBy]);
                }

            }, 1000);
        }, 200);


        if (typeof settings.onClosing !== 'undefined') {
            settings.onClosing.apply(null, [settings, $toast, closedBy]);
        }
    };

    /**
     * Create and show the Toast
     * @public
     * @param {Object} options User settings
     */
    $iziToast.show = function (options) {

        var that = this;

        // Merge user options with defaults
        var settings = extend(CONFIG, options || {});
        settings = extend(defaults, settings);
        settings.time = {};

        if (settings.id === null) {
            settings.id = generateId(settings.title + settings.message + settings.color);
        }

        if (settings.displayMode === 1 || settings.displayMode == 'once') {
            try {
                if (document.querySelectorAll('.' + PLUGIN_NAME + '#' + settings.id).length > 0) {
                    return false;
                }
            } catch (exc) {
                console.warn('[' + PLUGIN_NAME + '] Could not find an element with this selector: ' + '#' + settings.id + '. Try to set an valid id.');
            }
        }

        if (settings.displayMode === 2 || settings.displayMode == 'replace') {
            try {
                forEach(document.querySelectorAll('.' + PLUGIN_NAME + '#' + settings.id), function (element, index) {
                    that.hide(settings, element, 'replaced');
                });
            } catch (exc) {
                console.warn('[' + PLUGIN_NAME + '] Could not find an element with this selector: ' + '#' + settings.id + '. Try to set an valid id.');
            }
        }

        settings.ref = new Date().getTime() + Math.floor((Math.random() * 10000000) + 1);

        $iziToast.children[settings.ref] = settings;

        var $DOM = {
            body: document.querySelector('body'),
            overlay: document.createElement('div'),
            toast: document.createElement('div'),
            toastBody: document.createElement('div'),
            toastTexts: document.createElement('div'),
            toastCapsule: document.createElement('div'),
            cover: document.createElement('div'),
            buttons: document.createElement('div'),
            inputs: document.createElement('div'),
            icon: !settings.iconUrl ? document.createElement('i') : document.createElement('img'),
            wrapper: null
        };

        $DOM.toast.setAttribute('data-iziToast-ref', settings.ref);
        $DOM.toast.appendChild($DOM.toastBody);
        $DOM.toastCapsule.appendChild($DOM.toast);

        // CSS Settings
        (function () {

            $DOM.toast.classList.add(PLUGIN_NAME);
            $DOM.toast.classList.add(PLUGIN_NAME + '-opening');
            $DOM.toastCapsule.classList.add(PLUGIN_NAME + '-capsule');
            $DOM.toastBody.classList.add(PLUGIN_NAME + '-body');
            $DOM.toastTexts.classList.add(PLUGIN_NAME + '-texts');

            if (ISMOBILE || window.innerWidth <= MOBILEWIDTH) {
                if (settings.transitionInMobile)
                    $DOM.toast.classList.add(settings.transitionInMobile);
            } else {
                if (settings.transitionIn)
                    $DOM.toast.classList.add(settings.transitionIn);
            }

            if (settings.class) {
                var classes = settings.class.split(' ');
                forEach(classes, function (value, index) {
                    $DOM.toast.classList.add(value);
                });
            }

            if (settings.id) { $DOM.toast.id = settings.id; }

            if (settings.rtl) {
                $DOM.toast.classList.add(PLUGIN_NAME + '-rtl');
                $DOM.toast.setAttribute('dir', 'rtl');
            }

            if (settings.layout > 1) { $DOM.toast.classList.add(PLUGIN_NAME + '-layout' + settings.layout); }

            if (settings.balloon) { $DOM.toast.classList.add(PLUGIN_NAME + '-balloon'); }

            if (settings.maxWidth) {
                if (!isNaN(settings.maxWidth)) {
                    $DOM.toast.style.maxWidth = settings.maxWidth + 'px';
                } else {
                    $DOM.toast.style.maxWidth = settings.maxWidth;
                }
            }

            if (settings.theme !== '' || settings.theme !== 'light') {

                $DOM.toast.classList.add(PLUGIN_NAME + '-theme-' + settings.theme);
            }

            if (settings.color) { //#, rgb, rgba, hsl

                if (isColor(settings.color)) {
                    $DOM.toast.style.background = settings.color;
                } else {
                    $DOM.toast.classList.add(PLUGIN_NAME + '-color-' + settings.color);
                }
            }

            if (settings.backgroundColor) {
                $DOM.toast.style.background = settings.backgroundColor;
                if (settings.balloon) {
                    $DOM.toast.style.borderColor = settings.backgroundColor;
                }
            }
        })();

        // Cover image
        (function () {
            if (settings.image) {
                $DOM.cover.classList.add(PLUGIN_NAME + '-cover');
                $DOM.cover.style.width = settings.imageWidth + 'px';

                if (isBase64(settings.image.replace(/ /g, ''))) {
                    $DOM.cover.style.backgroundImage = 'url(data:image/png;base64,' + settings.image.replace(/ /g, '') + ')';
                } else {
                    $DOM.cover.style.backgroundImage = 'url(' + settings.image + ')';
                }

                if (settings.rtl) {
                    $DOM.toastBody.style.marginRight = (settings.imageWidth + 10) + 'px';
                } else {
                    $DOM.toastBody.style.marginLeft = (settings.imageWidth + 10) + 'px';
                }
                $DOM.toast.appendChild($DOM.cover);
            }
        })();

        // Button close
        (function () {
            if (settings.close) {

                $DOM.buttonClose = document.createElement('button');
                $DOM.buttonClose.type = 'button';
                $DOM.buttonClose.classList.add(PLUGIN_NAME + '-close');
                $DOM.buttonClose.addEventListener('click', function (e) {
                    var button = e.target;
                    that.hide(settings, $DOM.toast, 'button');
                });
                $DOM.toast.appendChild($DOM.buttonClose);
            } else {
                if (settings.rtl) {
                    $DOM.toast.style.paddingLeft = '18px';
                } else {
                    $DOM.toast.style.paddingRight = '18px';
                }
            }
        })();

        // Progress Bar & Timeout
        (function () {

            if (settings.progressBar) {
                $DOM.progressBar = document.createElement('div');
                $DOM.progressBarDiv = document.createElement('div');
                $DOM.progressBar.classList.add(PLUGIN_NAME + '-progressbar');
                $DOM.progressBarDiv.style.background = settings.progressBarColor;
                $DOM.progressBar.appendChild($DOM.progressBarDiv);
                $DOM.toast.appendChild($DOM.progressBar);
            }

            if (settings.timeout) {

                if (settings.pauseOnHover && !settings.resetOnHover) {

                    $DOM.toast.addEventListener('mouseenter', function (e) {
                        that.progress(settings, $DOM.toast).pause();
                    });
                    $DOM.toast.addEventListener('mouseleave', function (e) {
                        that.progress(settings, $DOM.toast).resume();
                    });
                }

                if (settings.resetOnHover) {

                    $DOM.toast.addEventListener('mouseenter', function (e) {
                        that.progress(settings, $DOM.toast).reset();
                    });
                    $DOM.toast.addEventListener('mouseleave', function (e) {
                        that.progress(settings, $DOM.toast).start();
                    });
                }
            }
        })();

        // Icon
        (function () {

            if (settings.iconUrl) {

                $DOM.icon.setAttribute('class', PLUGIN_NAME + '-icon');
                $DOM.icon.setAttribute('src', settings.iconUrl);

            } else if (settings.icon) {
                $DOM.icon.setAttribute('class', PLUGIN_NAME + '-icon ' + settings.icon);

                if (settings.iconText) {
                    $DOM.icon.appendChild(document.createTextNode(settings.iconText));
                }

                if (settings.iconColor) {
                    $DOM.icon.style.color = settings.iconColor;
                }
            }

            if (settings.icon || settings.iconUrl) {

                if (settings.rtl) {
                    $DOM.toastBody.style.paddingRight = '33px';
                } else {
                    $DOM.toastBody.style.paddingLeft = '33px';
                }

                $DOM.toastBody.appendChild($DOM.icon);
            }

        })();

        // Title & Message
        (function () {
            if (settings.title.length > 0) {

                $DOM.strong = document.createElement('strong');
                $DOM.strong.classList.add(PLUGIN_NAME + '-title');
                $DOM.strong.appendChild(createFragElem(settings.title));
                $DOM.toastTexts.appendChild($DOM.strong);

                if (settings.titleColor) {
                    $DOM.strong.style.color = settings.titleColor;
                }
                if (settings.titleSize) {
                    if (!isNaN(settings.titleSize)) {
                        $DOM.strong.style.fontSize = settings.titleSize + 'px';
                    } else {
                        $DOM.strong.style.fontSize = settings.titleSize;
                    }
                }
                if (settings.titleLineHeight) {
                    if (!isNaN(settings.titleSize)) {
                        $DOM.strong.style.lineHeight = settings.titleLineHeight + 'px';
                    } else {
                        $DOM.strong.style.lineHeight = settings.titleLineHeight;
                    }
                }
            }

            if (settings.message.length > 0) {

                $DOM.p = document.createElement('p');
                $DOM.p.classList.add(PLUGIN_NAME + '-message');
                $DOM.p.appendChild(createFragElem(settings.message));
                $DOM.toastTexts.appendChild($DOM.p);

                if (settings.messageColor) {
                    $DOM.p.style.color = settings.messageColor;
                }
                if (settings.messageSize) {
                    if (!isNaN(settings.titleSize)) {
                        $DOM.p.style.fontSize = settings.messageSize + 'px';
                    } else {
                        $DOM.p.style.fontSize = settings.messageSize;
                    }
                }
                if (settings.messageLineHeight) {

                    if (!isNaN(settings.titleSize)) {
                        $DOM.p.style.lineHeight = settings.messageLineHeight + 'px';
                    } else {
                        $DOM.p.style.lineHeight = settings.messageLineHeight;
                    }
                }
            }

            if (settings.title.length > 0 && settings.message.length > 0) {
                if (settings.rtl) {
                    $DOM.strong.style.marginLeft = '10px';
                } else if (settings.layout !== 2 && !settings.rtl) {
                    $DOM.strong.style.marginRight = '10px';
                }
            }
        })();

        $DOM.toastBody.appendChild($DOM.toastTexts);

        // Inputs
        var $inputs;
        (function () {
            if (settings.inputs.length > 0) {

                $DOM.inputs.classList.add(PLUGIN_NAME + '-inputs');

                forEach(settings.inputs, function (value, index) {
                    $DOM.inputs.appendChild(createFragElem(value[0]));

                    $inputs = $DOM.inputs.childNodes;

                    $inputs[index].classList.add(PLUGIN_NAME + '-inputs-child');

                    if (value[3]) {
                        setTimeout(function () {
                            $inputs[index].focus();
                        }, 300);
                    }

                    $inputs[index].addEventListener(value[1], function (e) {
                        var ts = value[2];
                        return ts(that, $DOM.toast, this, e);
                    });
                });
                $DOM.toastBody.appendChild($DOM.inputs);
            }
        })();

        // Buttons
        (function () {
            if (settings.buttons.length > 0) {

                $DOM.buttons.classList.add(PLUGIN_NAME + '-buttons');

                forEach(settings.buttons, function (value, index) {
                    $DOM.buttons.appendChild(createFragElem(value[0]));

                    var $btns = $DOM.buttons.childNodes;

                    $btns[index].classList.add(PLUGIN_NAME + '-buttons-child');

                    if (value[2]) {
                        setTimeout(function () {
                            $btns[index].focus();
                        }, 300);
                    }

                    $btns[index].addEventListener('click', function (e) {
                        e.preventDefault();
                        var ts = value[1];
                        return ts(that, $DOM.toast, this, e, $inputs);
                    });
                });
            }
            $DOM.toastBody.appendChild($DOM.buttons);
        })();

        if (settings.message.length > 0 && (settings.inputs.length > 0 || settings.buttons.length > 0)) {
            $DOM.p.style.marginBottom = '0';
        }

        if (settings.inputs.length > 0 || settings.buttons.length > 0) {
            if (settings.rtl) {
                $DOM.toastTexts.style.marginLeft = '10px';
            } else {
                $DOM.toastTexts.style.marginRight = '10px';
            }
            if (settings.inputs.length > 0 && settings.buttons.length > 0) {
                if (settings.rtl) {
                    $DOM.inputs.style.marginLeft = '8px';
                } else {
                    $DOM.inputs.style.marginRight = '8px';
                }
            }
        }

        // Wrap
        (function () {
            $DOM.toastCapsule.style.visibility = 'hidden';
            setTimeout(function () {
                var H = $DOM.toast.offsetHeight;
                var style = $DOM.toast.currentStyle || window.getComputedStyle($DOM.toast);
                var marginTop = style.marginTop;
                marginTop = marginTop.split('px');
                marginTop = parseInt(marginTop[0]);
                var marginBottom = style.marginBottom;
                marginBottom = marginBottom.split('px');
                marginBottom = parseInt(marginBottom[0]);

                $DOM.toastCapsule.style.visibility = '';
                $DOM.toastCapsule.style.height = (H + marginBottom + marginTop) + 'px';

                setTimeout(function () {
                    $DOM.toastCapsule.style.height = 'auto';
                    if (settings.target) {
                        $DOM.toastCapsule.style.overflow = 'visible';
                    }
                }, 500);

                if (settings.timeout) {
                    that.progress(settings, $DOM.toast).start();
                }
            }, 100);
        })();

        // Target
        (function () {
            var position = settings.position;

            if (settings.target) {

                $DOM.wrapper = document.querySelector(settings.target);
                $DOM.wrapper.classList.add(PLUGIN_NAME + '-target');

                if (settings.targetFirst) {
                    $DOM.wrapper.insertBefore($DOM.toastCapsule, $DOM.wrapper.firstChild);
                } else {
                    $DOM.wrapper.appendChild($DOM.toastCapsule);
                }

            } else {

                if (POSITIONS.indexOf(settings.position) == -1) {
                    console.warn('[' + PLUGIN_NAME + '] Incorrect position.\nIt can be › ' + POSITIONS);
                    return;
                }

                if (ISMOBILE || window.innerWidth <= MOBILEWIDTH) {
                    if (settings.position == 'bottomLeft' || settings.position == 'bottomRight' || settings.position == 'bottomCenter') {
                        position = PLUGIN_NAME + '-wrapper-bottomCenter';
                    }
                    else if (settings.position == 'topLeft' || settings.position == 'topRight' || settings.position == 'topCenter') {
                        position = PLUGIN_NAME + '-wrapper-topCenter';
                    }
                    else {
                        position = PLUGIN_NAME + '-wrapper-center';
                    }
                } else {
                    position = PLUGIN_NAME + '-wrapper-' + position;
                }
                $DOM.wrapper = document.querySelector('.' + PLUGIN_NAME + '-wrapper.' + position);

                if (!$DOM.wrapper) {
                    $DOM.wrapper = document.createElement('div');
                    $DOM.wrapper.classList.add(PLUGIN_NAME + '-wrapper');
                    $DOM.wrapper.classList.add(position);
                    document.body.appendChild($DOM.wrapper);
                }
                if (settings.position == 'topLeft' || settings.position == 'topCenter' || settings.position == 'topRight') {
                    $DOM.wrapper.insertBefore($DOM.toastCapsule, $DOM.wrapper.firstChild);
                } else {
                    $DOM.wrapper.appendChild($DOM.toastCapsule);
                }
            }

            if (!isNaN(settings.zindex)) {
                $DOM.wrapper.style.zIndex = settings.zindex;
            } else {
                console.warn('[' + PLUGIN_NAME + '] Invalid zIndex.');
            }
        })();

        // Overlay
        (function () {

            if (settings.overlay) {

                if (document.querySelector('.' + PLUGIN_NAME + '-overlay.fadeIn') !== null) {

                    $DOM.overlay = document.querySelector('.' + PLUGIN_NAME + '-overlay');
                    $DOM.overlay.setAttribute('data-iziToast-ref', $DOM.overlay.getAttribute('data-iziToast-ref') + ',' + settings.ref);

                    if (!isNaN(settings.zindex) && settings.zindex !== null) {
                        $DOM.overlay.style.zIndex = settings.zindex - 1;
                    }

                } else {

                    $DOM.overlay.classList.add(PLUGIN_NAME + '-overlay');
                    $DOM.overlay.classList.add('fadeIn');
                    $DOM.overlay.style.background = settings.overlayColor;
                    $DOM.overlay.setAttribute('data-iziToast-ref', settings.ref);
                    if (!isNaN(settings.zindex) && settings.zindex !== null) {
                        $DOM.overlay.style.zIndex = settings.zindex - 1;
                    }
                    document.querySelector('body').appendChild($DOM.overlay);
                }

                if (settings.overlayClose) {

                    $DOM.overlay.removeEventListener('click', {});
                    $DOM.overlay.addEventListener('click', function (e) {
                        that.hide(settings, $DOM.toast, 'overlay');
                    });
                } else {
                    $DOM.overlay.removeEventListener('click', {});
                }
            }
        })();

        // Inside animations
        (function () {
            if (settings.animateInside) {
                $DOM.toast.classList.add(PLUGIN_NAME + '-animateInside');

                var animationTimes = [200, 100, 300];
                if (settings.transitionIn == 'bounceInLeft' || settings.transitionIn == 'bounceInRight') {
                    animationTimes = [400, 200, 400];
                }

                if (settings.title.length > 0) {
                    setTimeout(function () {
                        $DOM.strong.classList.add('slideIn');
                    }, animationTimes[0]);
                }

                if (settings.message.length > 0) {
                    setTimeout(function () {
                        $DOM.p.classList.add('slideIn');
                    }, animationTimes[1]);
                }

                if (settings.icon || settings.iconUrl) {
                    setTimeout(function () {
                        $DOM.icon.classList.add('revealIn');
                    }, animationTimes[2]);
                }

                var counter = 150;
                if (settings.buttons.length > 0 && $DOM.buttons) {

                    setTimeout(function () {

                        forEach($DOM.buttons.childNodes, function (element, index) {

                            setTimeout(function () {
                                element.classList.add('revealIn');
                            }, counter);
                            counter = counter + 150;
                        });

                    }, settings.inputs.length > 0 ? 150 : 0);
                }

                if (settings.inputs.length > 0 && $DOM.inputs) {
                    counter = 150;
                    forEach($DOM.inputs.childNodes, function (element, index) {

                        setTimeout(function () {
                            element.classList.add('revealIn');
                        }, counter);
                        counter = counter + 150;
                    });
                }
            }
        })();

        settings.onOpening.apply(null, [settings, $DOM.toast]);

        try {
            var event = new CustomEvent(PLUGIN_NAME + '-opening', { detail: settings, bubbles: true, cancelable: true });
            document.dispatchEvent(event);
        } catch (ex) {
            console.warn(ex);
        }

        setTimeout(function () {

            $DOM.toast.classList.remove(PLUGIN_NAME + '-opening');
            $DOM.toast.classList.add(PLUGIN_NAME + '-opened');

            try {
                var event = new CustomEvent(PLUGIN_NAME + '-opened', { detail: settings, bubbles: true, cancelable: true });
                document.dispatchEvent(event);
            } catch (ex) {
                console.warn(ex);
            }

            settings.onOpened.apply(null, [settings, $DOM.toast]);
        }, 1000);

        if (settings.drag) {

            if (ACCEPTSTOUCH) {

                $DOM.toast.addEventListener('touchstart', function (e) {
                    drag.startMoving(this, that, settings, e);
                }, false);

                $DOM.toast.addEventListener('touchend', function (e) {
                    drag.stopMoving(this, e);
                }, false);
            } else {

                $DOM.toast.addEventListener('mousedown', function (e) {
                    e.preventDefault();
                    drag.startMoving(this, that, settings, e);
                }, false);

                $DOM.toast.addEventListener('mouseup', function (e) {
                    e.preventDefault();
                    drag.stopMoving(this, e);
                }, false);
            }
        }

        if (settings.closeOnEscape) {

            document.addEventListener('keyup', function (evt) {
                evt = evt || window.event;
                if (evt.keyCode == 27) {
                    that.hide(settings, $DOM.toast, 'esc');
                }
            });
        }

        if (settings.closeOnClick) {
            $DOM.toast.addEventListener('click', function (evt) {
                that.hide(settings, $DOM.toast, 'toast');
            });
        }

        that.toast = $DOM.toast;
    };


    return $iziToast;
});
JS;

        $code2 = <<<'JS'
        ! function (t, e) {
    "function" == typeof define && define.amd ? define([], e(t)) : "object" == typeof exports ? module.exports = e(t) : t.iziToast = e(t)
}("undefined" != typeof global ? global : window || this.window || this.global, function (t) {
    "use strict";
    var e = {},
        n = "iziToast",
        o = (document.querySelector("body"), !!/Mobi/.test(navigator.userAgent)),
        i = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor),
        s = "undefined" != typeof InstallTrigger,
        a = "ontouchstart" in document.documentElement,
        r = ["bottomRight", "bottomLeft", "bottomCenter", "topRight", "topLeft", "topCenter", "center"],
        l = {
            info: {
                color: "blue",
                icon: "ico-info"
            },
            success: {
                color: "green",
                icon: "ico-success"
            },
            warning: {
                color: "orange",
                icon: "ico-warning"
            },
            error: {
                color: "red",
                icon: "ico-error"
            },
            question: {
                color: "yellow",
                icon: "ico-question"
            }
        },
        d = 568,
        c = {};
    e.children = {};
    var u = {
        id: null,
        "class": "",
        title: "",
        titleColor: "",
        titleSize: "",
        titleLineHeight: "",
        message: "",
        messageColor: "",
        messageSize: "",
        messageLineHeight: "",
        backgroundColor: "",
        theme: "light",
        color: "",
        icon: "",
        iconText: "",
        iconColor: "",
        iconUrl: null,
        image: "",
        imageWidth: 50,
        maxWidth: null,
        zindex: null,
        layout: 1,
        balloon: !1,
        close: !0,
        closeOnEscape: !1,
        closeOnClick: !1,
        displayMode: 0,
        position: "bottomRight",
        target: "",
        targetFirst: !0,
        timeout: 5e3,
        rtl: !1,
        animateInside: !0,
        drag: !0,
        pauseOnHover: !0,
        resetOnHover: !1,
        progressBar: !0,
        progressBarColor: "",
        progressBarEasing: "linear",
        overlay: !1,
        overlayClose: !1,
        overlayColor: "rgba(0, 0, 0, 0.6)",
        transitionIn: "fadeInUp",
        transitionOut: "fadeOut",
        transitionInMobile: "fadeInUp",
        transitionOutMobile: "fadeOutDown",
        buttons: {},
        inputs: {},
        onOpening: function () {},
        onOpened: function () {},
        onClosing: function () {},
        onClosed: function () {}
    };
    if ("remove" in Element.prototype || (Element.prototype.remove = function () {
            this.parentNode && this.parentNode.removeChild(this)
        }), "function" != typeof window.CustomEvent) {
        var p = function (t, e) {
            e = e || {
                bubbles: !1,
                cancelable: !1,
                detail: void 0
            };
            var n = document.createEvent("CustomEvent");
            return n.initCustomEvent(t, e.bubbles, e.cancelable, e.detail), n
        };
        p.prototype = window.Event.prototype, window.CustomEvent = p
    }
    var m = function (t, e, n) {
            if ("[object Object]" === Object.prototype.toString.call(t))
                for (var o in t) Object.prototype.hasOwnProperty.call(t, o) && e.call(n, t[o], o, t);
            else if (t)
                for (var i = 0, s = t.length; s > i; i++) e.call(n, t[i], i, t)
        },
        g = function (t, e) {
            var n = {};
            return m(t, function (e, o) {
                n[o] = t[o]
            }), m(e, function (t, o) {
                n[o] = e[o]
            }), n
        },
        f = function (t) {
            var e = document.createDocumentFragment(),
                n = document.createElement("div");
            for (n.innerHTML = t; n.firstChild;) e.appendChild(n.firstChild);
            return e
        },
        v = function (t) {
            var e = btoa(encodeURIComponent(t));
            return e.replace(/=/g, "")
        },
        y = function (t) {
            return "#" == t.substring(0, 1) || "rgb" == t.substring(0, 3) || "hsl" == t.substring(0, 3)
        },
        h = function (t) {
            try {
                return btoa(atob(t)) == t
            } catch (e) {
                return !1
            }
        },
        b = function () {
            return {
                move: function (t, e, o, a) {
                    var r, l = .3,
                        d = 180;
                    0 !== a && (t.classList.add(n + "-dragged"), t.style.transform = "translateX(" + a + "px)", a > 0 ? (r = (d - a) / d, l > r && e.hide(g(o, {
                        transitionOut: "fadeOutRight",
                        transitionOutMobile: "fadeOutRight"
                    }), t, "drag")) : (r = (d + a) / d, l > r && e.hide(g(o, {
                        transitionOut: "fadeOutLeft",
                        transitionOutMobile: "fadeOutLeft"
                    }), t, "drag")), t.style.opacity = r, l > r && ((i || s) && (t.style.left = a + "px"), t.parentNode.style.opacity = l, this.stopMoving(t, null)))
                },
                startMoving: function (t, e, n, o) {
                    o = o || window.event;
                    var i = a ? o.touches[0].clientX : o.clientX,
                        s = t.style.transform.replace("px)", "");
                    s = s.replace("translateX(", "");
                    var r = i - s;
                    n.transitionIn && t.classList.remove(n.transitionIn), n.transitionInMobile && t.classList.remove(n.transitionInMobile), t.style.transition = "", a ? document.ontouchmove = function (o) {
                        o.preventDefault(), o = o || window.event;
                        var i = o.touches[0].clientX,
                            s = i - r;
                        b.move(t, e, n, s)
                    } : document.onmousemove = function (o) {
                        o.preventDefault(), o = o || window.event;
                        var i = o.clientX,
                            s = i - r;
                        b.move(t, e, n, s)
                    }
                },
                stopMoving: function (t, e) {
                    a ? document.ontouchmove = function () {} : document.onmousemove = function () {}, t.style.opacity = "", t.style.transform = "", t.classList.contains(n + "-dragged") && (t.classList.remove(n + "-dragged"), t.style.transition = "transform 0.4s ease, opacity 0.4s ease", setTimeout(function () {
                        t.style.transition = ""
                    }, 400))
                }
            }
        }();
    return e.setSetting = function (t, n, o) {
        e.children[t][n] = o
    }, e.getSetting = function (t, n) {
        return e.children[t][n]
    }, e.destroy = function () {
        m(document.querySelectorAll("." + n + "-overlay"), function (t, e) {
            t.remove()
        }), m(document.querySelectorAll("." + n + "-wrapper"), function (t, e) {
            t.remove()
        }), m(document.querySelectorAll("." + n), function (t, e) {
            t.remove()
        }), this.children = {}, document.removeEventListener(n + "-opened", {}, !1), document.removeEventListener(n + "-opening", {}, !1), document.removeEventListener(n + "-closing", {}, !1), document.removeEventListener(n + "-closed", {}, !1), document.removeEventListener("keyup", {}, !1), c = {}
    }, e.settings = function (t) {
        e.destroy(), c = t, u = g(u, t || {})
    }, m(l, function (t, n) {
        e[n] = function (e) {
            var n = g(c, e || {});
            n = g(t, n || {}), this.show(n)
        }
    }), e.progress = function (t, e, o) {
        var i = this,
            s = e.getAttribute("data-iziToast-ref"),
            a = g(this.children[s], t || {}),
            r = e.querySelector("." + n + "-progressbar div");
        return {
            start: function () {
                "undefined" == typeof a.time.REMAINING && (e.classList.remove(n + "-reseted"), null !== r && (r.style.transition = "width " + a.timeout + "ms " + a.progressBarEasing, r.style.width = "0%"), a.time.START = (new Date).getTime(), a.time.END = a.time.START + a.timeout, a.time.TIMER = setTimeout(function () {
                    clearTimeout(a.time.TIMER), e.classList.contains(n + "-closing") || (i.hide(a, e, "timeout"), "function" == typeof o && o.apply(i))
                }, a.timeout), i.setSetting(s, "time", a.time))
            },
            pause: function () {
                if ("undefined" != typeof a.time.START && !e.classList.contains(n + "-paused") && !e.classList.contains(n + "-reseted")) {
                    if (e.classList.add(n + "-paused"), a.time.REMAINING = a.time.END - (new Date).getTime(), clearTimeout(a.time.TIMER), i.setSetting(s, "time", a.time), null !== r) {
                        var t = window.getComputedStyle(r),
                            l = t.getPropertyValue("width");
                        r.style.transition = "none", r.style.width = l
                    }
                    "function" == typeof o && setTimeout(function () {
                        o.apply(i)
                    }, 10)
                }
            },
            resume: function () {
                "undefined" != typeof a.time.REMAINING ? (e.classList.remove(n + "-paused"), null !== r && (r.style.transition = "width " + a.time.REMAINING + "ms " + a.progressBarEasing, r.style.width = "0%"), a.time.END = (new Date).getTime() + a.time.REMAINING, a.time.TIMER = setTimeout(function () {
                    clearTimeout(a.time.TIMER), e.classList.contains(n + "-closing") || (i.hide(a, e, "timeout"), "function" == typeof o && o.apply(i))
                }, a.time.REMAINING), i.setSetting(s, "time", a.time)) : this.start()
            },
            reset: function () {
                clearTimeout(a.time.TIMER), delete a.time.REMAINING, i.setSetting(s, "time", a.time), e.classList.add(n + "-reseted"), e.classList.remove(n + "-paused"), null !== r && (r.style.transition = "none", r.style.width = "100%"), "function" == typeof o && setTimeout(function () {
                    o.apply(i)
                }, 10)
            }
        }
    }, e.hide = function (t, e, i) {
        "object" != typeof e && (e = document.querySelector(e));
        var s = this,
            a = g(this.children[e.getAttribute("data-iziToast-ref")], t || {});
        a.closedBy = i || null, delete a.time.REMAINING, e.classList.add(n + "-closing"),
            function () {
                var t = document.querySelector("." + n + "-overlay");
                if (null !== t) {
                    var e = t.getAttribute("data-iziToast-ref");
                    e = e.split(",");
                    var o = e.indexOf(String(a.ref)); - 1 !== o && e.splice(o, 1), t.setAttribute("data-iziToast-ref", e.join()), 0 === e.length && (t.classList.remove("fadeIn"), t.classList.add("fadeOut"), setTimeout(function () {
                        t.remove()
                    }, 700))
                }
            }(), a.transitionIn && e.classList.remove(a.transitionIn), a.transitionInMobile && e.classList.remove(a.transitionInMobile), o || window.innerWidth <= d ? a.transitionOutMobile && e.classList.add(a.transitionOutMobile) : a.transitionOut && e.classList.add(a.transitionOut);
        var r = e.parentNode.offsetHeight;
        e.parentNode.style.height = r + "px", e.style.pointerEvents = "none", (!o || window.innerWidth > d) && (e.parentNode.style.transitionDelay = "0.2s");
        try {
            var l = new CustomEvent(n + "-closing", {
                detail: a,
                bubbles: !0,
                cancelable: !0
            });
            document.dispatchEvent(l)
        } catch (c) {
            console.warn(c)
        }
        setTimeout(function () {
            e.parentNode.style.height = "0px", e.parentNode.style.overflow = "", setTimeout(function () {
                delete s.children[a.ref], e.parentNode.remove();
                try {
                    var t = new CustomEvent(n + "-closed", {
                        detail: a,
                        bubbles: !0,
                        cancelable: !0
                    });
                    document.dispatchEvent(t)
                } catch (o) {
                    console.warn(o)
                }
                "undefined" != typeof a.onClosed && a.onClosed.apply(null, [a, e, i])
            }, 1e3)
        }, 200), "undefined" != typeof a.onClosing && a.onClosing.apply(null, [a, e, i])
    }, e.show = function (t) {
        var i = this,
            s = g(c, t || {});
        if (s = g(u, s), s.time = {}, null === s.id && (s.id = v(s.title + s.message + s.color)), 1 === s.displayMode || "once" == s.displayMode) try {
            if (document.querySelectorAll("." + n + "#" + s.id).length > 0) return !1
        } catch (l) {
            console.warn("[" + n + "] Could not find an element with this selector: #" + s.id + ". Try to set an valid id.")
        }
        if (2 === s.displayMode || "replace" == s.displayMode) try {
            m(document.querySelectorAll("." + n + "#" + s.id), function (t, e) {
                i.hide(s, t, "replaced")
            })
        } catch (l) {
            console.warn("[" + n + "] Could not find an element with this selector: #" + s.id + ". Try to set an valid id.")
        }
        s.ref = (new Date).getTime() + Math.floor(1e7 * Math.random() + 1), e.children[s.ref] = s;
        var p = {
            body: document.querySelector("body"),
            overlay: document.createElement("div"),
            toast: document.createElement("div"),
            toastBody: document.createElement("div"),
            toastTexts: document.createElement("div"),
            toastCapsule: document.createElement("div"),
            cover: document.createElement("div"),
            buttons: document.createElement("div"),
            inputs: document.createElement("div"),
            icon: s.iconUrl ? document.createElement("img") : document.createElement("i"),
            wrapper: null
        };
        p.toast.setAttribute("data-iziToast-ref", s.ref), p.toast.appendChild(p.toastBody), p.toastCapsule.appendChild(p.toast),
            function () {
                if (p.toast.classList.add(n), p.toast.classList.add(n + "-opening"), p.toastCapsule.classList.add(n + "-capsule"), p.toastBody.classList.add(n + "-body"), p.toastTexts.classList.add(n + "-texts"), o || window.innerWidth <= d ? s.transitionInMobile && p.toast.classList.add(s.transitionInMobile) : s.transitionIn && p.toast.classList.add(s.transitionIn), s["class"]) {
                    var t = s["class"].split(" ");
                    m(t, function (t, e) {
                        p.toast.classList.add(t)
                    })
                }
                s.id && (p.toast.id = s.id), s.rtl && (p.toast.classList.add(n + "-rtl"), p.toast.setAttribute("dir", "rtl")), s.layout > 1 && p.toast.classList.add(n + "-layout" + s.layout), s.balloon && p.toast.classList.add(n + "-balloon"), s.maxWidth && (isNaN(s.maxWidth) ? p.toast.style.maxWidth = s.maxWidth : p.toast.style.maxWidth = s.maxWidth + "px"), "" === s.theme && "light" === s.theme || p.toast.classList.add(n + "-theme-" + s.theme), s.color && (y(s.color) ? p.toast.style.background = s.color : p.toast.classList.add(n + "-color-" + s.color)), s.backgroundColor && (p.toast.style.background = s.backgroundColor, s.balloon && (p.toast.style.borderColor = s.backgroundColor))
            }(),
            function () {
                s.image && (p.cover.classList.add(n + "-cover"), p.cover.style.width = s.imageWidth + "px", h(s.image.replace(/ /g, "")) ? p.cover.style.backgroundImage = "url(data:image/png;base64," + s.image.replace(/ /g, "") + ")" : p.cover.style.backgroundImage = "url(" + s.image + ")", s.rtl ? p.toastBody.style.marginRight = s.imageWidth + 10 + "px" : p.toastBody.style.marginLeft = s.imageWidth + 10 + "px", p.toast.appendChild(p.cover))
            }(),
            function () {
                s.close ? (p.buttonClose = document.createElement("button"), p.buttonClose.type = "button", p.buttonClose.classList.add(n + "-close"), p.buttonClose.addEventListener("click", function (t) {
                    t.target;
                    i.hide(s, p.toast, "button")
                }), p.toast.appendChild(p.buttonClose)) : s.rtl ? p.toast.style.paddingLeft = "18px" : p.toast.style.paddingRight = "18px"
            }(),
            function () {
                s.progressBar && (p.progressBar = document.createElement("div"), p.progressBarDiv = document.createElement("div"), p.progressBar.classList.add(n + "-progressbar"), p.progressBarDiv.style.background = s.progressBarColor, p.progressBar.appendChild(p.progressBarDiv), p.toast.appendChild(p.progressBar)), s.timeout && (s.pauseOnHover && !s.resetOnHover && (p.toast.addEventListener("mouseenter", function (t) {
                    i.progress(s, p.toast).pause()
                }), p.toast.addEventListener("mouseleave", function (t) {
                    i.progress(s, p.toast).resume()
                })), s.resetOnHover && (p.toast.addEventListener("mouseenter", function (t) {
                    i.progress(s, p.toast).reset()
                }), p.toast.addEventListener("mouseleave", function (t) {
                    i.progress(s, p.toast).start()
                })))
            }(),
            function () {
                s.iconUrl ? (p.icon.setAttribute("class", n + "-icon"), p.icon.setAttribute("src", s.iconUrl)) : s.icon && (p.icon.setAttribute("class", n + "-icon " + s.icon), s.iconText && p.icon.appendChild(document.createTextNode(s.iconText)), s.iconColor && (p.icon.style.color = s.iconColor)), (s.icon || s.iconUrl) && (s.rtl ? p.toastBody.style.paddingRight = "33px" : p.toastBody.style.paddingLeft = "33px", p.toastBody.appendChild(p.icon))
            }(),
            function () {
                s.title.length > 0 && (p.strong = document.createElement("strong"), p.strong.classList.add(n + "-title"), p.strong.appendChild(f(s.title)), p.toastTexts.appendChild(p.strong), s.titleColor && (p.strong.style.color = s.titleColor), s.titleSize && (isNaN(s.titleSize) ? p.strong.style.fontSize = s.titleSize : p.strong.style.fontSize = s.titleSize + "px"), s.titleLineHeight && (isNaN(s.titleSize) ? p.strong.style.lineHeight = s.titleLineHeight : p.strong.style.lineHeight = s.titleLineHeight + "px")), s.message.length > 0 && (p.p = document.createElement("p"), p.p.classList.add(n + "-message"), p.p.appendChild(f(s.message)), p.toastTexts.appendChild(p.p), s.messageColor && (p.p.style.color = s.messageColor), s.messageSize && (isNaN(s.titleSize) ? p.p.style.fontSize = s.messageSize : p.p.style.fontSize = s.messageSize + "px"), s.messageLineHeight && (isNaN(s.titleSize) ? p.p.style.lineHeight = s.messageLineHeight : p.p.style.lineHeight = s.messageLineHeight + "px")), s.title.length > 0 && s.message.length > 0 && (s.rtl ? p.strong.style.marginLeft = "10px" : 2 === s.layout || s.rtl || (p.strong.style.marginRight = "10px"))
            }(), p.toastBody.appendChild(p.toastTexts);
        var L;
        ! function () {
            s.inputs.length > 0 && (p.inputs.classList.add(n + "-inputs"), m(s.inputs, function (t, e) {
                p.inputs.appendChild(f(t[0])), L = p.inputs.childNodes, L[e].classList.add(n + "-inputs-child"), t[3] && setTimeout(function () {
                    L[e].focus()
                }, 300), L[e].addEventListener(t[1], function (e) {
                    var n = t[2];
                    return n(i, p.toast, this, e)
                })
            }), p.toastBody.appendChild(p.inputs))
        }(),
        function () {
            s.buttons.length > 0 && (p.buttons.classList.add(n + "-buttons"), m(s.buttons, function (t, e) {
                p.buttons.appendChild(f(t[0]));
                var o = p.buttons.childNodes;
                o[e].classList.add(n + "-buttons-child"), t[2] && setTimeout(function () {
                    o[e].focus()
                }, 300), o[e].addEventListener("click", function (e) {
                    e.preventDefault();
                    var n = t[1];
                    return n(i, p.toast, this, e, L)
                })
            })), p.toastBody.appendChild(p.buttons)
        }(), s.message.length > 0 && (s.inputs.length > 0 || s.buttons.length > 0) && (p.p.style.marginBottom = "0"), (s.inputs.length > 0 || s.buttons.length > 0) && (s.rtl ? p.toastTexts.style.marginLeft = "10px" : p.toastTexts.style.marginRight = "10px", s.inputs.length > 0 && s.buttons.length > 0 && (s.rtl ? p.inputs.style.marginLeft = "8px" : p.inputs.style.marginRight = "8px")),
            function () {
                p.toastCapsule.style.visibility = "hidden", setTimeout(function () {
                    var t = p.toast.offsetHeight,
                        e = p.toast.currentStyle || window.getComputedStyle(p.toast),
                        n = e.marginTop;
                    n = n.split("px"), n = parseInt(n[0]);
                    var o = e.marginBottom;
                    o = o.split("px"), o = parseInt(o[0]), p.toastCapsule.style.visibility = "", p.toastCapsule.style.height = t + o + n + "px", setTimeout(function () {
                        p.toastCapsule.style.height = "auto", s.target && (p.toastCapsule.style.overflow = "visible")
                    }, 500), s.timeout && i.progress(s, p.toast).start()
                }, 100)
            }(),
            function () {
                var t = s.position;
                if (s.target) p.wrapper = document.querySelector(s.target), p.wrapper.classList.add(n + "-target"), s.targetFirst ? p.wrapper.insertBefore(p.toastCapsule, p.wrapper.firstChild) : p.wrapper.appendChild(p.toastCapsule);
                else {
                    if (-1 == r.indexOf(s.position)) return void console.warn("[" + n + "] Incorrect position.\nIt can be › " + r);
                    t = o || window.innerWidth <= d ? "bottomLeft" == s.position || "bottomRight" == s.position || "bottomCenter" == s.position ? n + "-wrapper-bottomCenter" : "topLeft" == s.position || "topRight" == s.position || "topCenter" == s.position ? n + "-wrapper-topCenter" : n + "-wrapper-center" : n + "-wrapper-" + t, p.wrapper = document.querySelector("." + n + "-wrapper." + t), p.wrapper || (p.wrapper = document.createElement("div"), p.wrapper.classList.add(n + "-wrapper"), p.wrapper.classList.add(t), document.body.appendChild(p.wrapper)), "topLeft" == s.position || "topCenter" == s.position || "topRight" == s.position ? p.wrapper.insertBefore(p.toastCapsule, p.wrapper.firstChild) : p.wrapper.appendChild(p.toastCapsule)
                }
                isNaN(s.zindex) ? console.warn("[" + n + "] Invalid zIndex.") : p.wrapper.style.zIndex = s.zindex
            }(),
            function () {
                s.overlay && (null !== document.querySelector("." + n + "-overlay.fadeIn") ? (p.overlay = document.querySelector("." + n + "-overlay"), p.overlay.setAttribute("data-iziToast-ref", p.overlay.getAttribute("data-iziToast-ref") + "," + s.ref), isNaN(s.zindex) || null === s.zindex || (p.overlay.style.zIndex = s.zindex - 1)) : (p.overlay.classList.add(n + "-overlay"), p.overlay.classList.add("fadeIn"), p.overlay.style.background = s.overlayColor, p.overlay.setAttribute("data-iziToast-ref", s.ref), isNaN(s.zindex) || null === s.zindex || (p.overlay.style.zIndex = s.zindex - 1), document.querySelector("body").appendChild(p.overlay)), s.overlayClose ? (p.overlay.removeEventListener("click", {}), p.overlay.addEventListener("click", function (t) {
                    i.hide(s, p.toast, "overlay")
                })) : p.overlay.removeEventListener("click", {}))
            }(),
            function () {
                if (s.animateInside) {
                    p.toast.classList.add(n + "-animateInside");
                    var t = [200, 100, 300];
                    "bounceInLeft" != s.transitionIn && "bounceInRight" != s.transitionIn || (t = [400, 200, 400]), s.title.length > 0 && setTimeout(function () {
                        p.strong.classList.add("slideIn")
                    }, t[0]), s.message.length > 0 && setTimeout(function () {
                        p.p.classList.add("slideIn")
                    }, t[1]), (s.icon || s.iconUrl) && setTimeout(function () {
                        p.icon.classList.add("revealIn")
                    }, t[2]);
                    var e = 150;
                    s.buttons.length > 0 && p.buttons && setTimeout(function () {
                        m(p.buttons.childNodes, function (t, n) {
                            setTimeout(function () {
                                t.classList.add("revealIn")
                            }, e), e += 150
                        })
                    }, s.inputs.length > 0 ? 150 : 0), s.inputs.length > 0 && p.inputs && (e = 150, m(p.inputs.childNodes, function (t, n) {
                        setTimeout(function () {
                            t.classList.add("revealIn")
                        }, e), e += 150
                    }))
                }
            }(), s.onOpening.apply(null, [s, p.toast]);
        try {
            var C = new CustomEvent(n + "-opening", {
                detail: s,
                bubbles: !0,
                cancelable: !0
            });
            document.dispatchEvent(C)
        } catch (w) {
            console.warn(w)
        }
        setTimeout(function () {
            p.toast.classList.remove(n + "-opening"), p.toast.classList.add(n + "-opened");
            try {
                var t = new CustomEvent(n + "-opened", {
                    detail: s,
                    bubbles: !0,
                    cancelable: !0
                });
                document.dispatchEvent(t)
            } catch (e) {
                console.warn(e)
            }
            s.onOpened.apply(null, [s, p.toast])
        }, 1e3), s.drag && (a ? (p.toast.addEventListener("touchstart", function (t) {
            b.startMoving(this, i, s, t)
        }, !1), p.toast.addEventListener("touchend", function (t) {
            b.stopMoving(this, t)
        }, !1)) : (p.toast.addEventListener("mousedown", function (t) {
            t.preventDefault(), b.startMoving(this, i, s, t)
        }, !1), p.toast.addEventListener("mouseup", function (t) {
            t.preventDefault(), b.stopMoving(this, t)
        }, !1))), s.closeOnEscape && document.addEventListener("keyup", function (t) {
            t = t || window.event, 27 == t.keyCode && i.hide(s, p.toast, "esc")
        }), s.closeOnClick && p.toast.addEventListener("click", function (t) {
            i.hide(s, p.toast, "toast")
        }), i.toast = p.toast
    }, e
});

JS;

        $code3 = <<<'CSS'
.iziToast-capsule {
    font-size: 0;
    height: 0;
    width: 100%;
    transform: translateZ(0);
    backface-visibility: hidden;
    transition: transform .5s cubic-bezier(.25, .8, .25, 1), height .5s cubic-bezier(.25, .8, .25, 1)
}

.iziToast-capsule,
.iziToast-capsule * {
    box-sizing: border-box
}

.iziToast-overlay {
    display: block;
    position: fixed;
    top: -100px;
    left: 0;
    right: 0;
    bottom: -100px;
    z-index: 997
}

.iziToast {
    display: inline-block;
    clear: both;
    position: relative;
    font-family: "Comic Sans MS, cursive";
    font-size: 14px;
    padding: 8px 45px 9px 0;
    background: rgba(238, 238, 238, .9);
    border-color: rgba(238, 238, 238, .9);
    width: 100%;
    pointer-events: all;
    cursor: default;
    transform: translateX(0);
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    min-height: 54px
}

.iziToast>.iziToast-progressbar {
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    z-index: 1;
    background: rgba(255, 255, 255, .2)
}

.iziToast>.iziToast-progressbar>div {
    height: 2px;
    width: 100%;
    background: rgba(0, 0, 0, .3);
    border-radius: 0 0 3px 3px
}

.iziToast.iziToast-balloon:before {
    content: '';
    position: absolute;
    right: 8px;
    left: auto;
    width: 0;
    height: 0;
    top: 100%;
    border-right: 0 solid transparent;
    border-left: 15px solid transparent;
    border-top: 10px solid #000;
    border-top-color: inherit;
    border-radius: 0
}

.iziToast.iziToast-balloon .iziToast-progressbar {
    top: 0;
    bottom: auto
}

.iziToast.iziToast-balloon>div {
    border-radius: 0 0 0 3px
}

.iziToast>.iziToast-cover {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    height: 100%;
    margin: 0;
    background-size: 100%;
    background-position: 50% 50%;
    background-repeat: no-repeat;
    background-color: rgba(0, 0, 0, .1)
}

.iziToast>.iziToast-close {
    position: absolute;
    right: 0;
    top: 0;
    border: 0;
    padding: 0;
    opacity: .6;
    width: 42px;
    height: 100%;
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAJPAAACTwBcGfW0QAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAD3SURBVFiF1ZdtDoMgDEBfdi4PwAX8vLFn0qT7wxantojKupmQmCi8R4tSACpgjC2ICCUbEBa8ingjsU1AXRBeR8aLN64FiknswN8CYefBBDQ3whuFESy7WyQMeC0ipEI0A+0FeBvHUFN8xPaUhAH/iKoWsnXHGegy4J0yxialOfaHJAz4bhRzQzgDvdGnz4GbAonZbCQMuBm1K/kcFu8Mp1N2cFFpsxsMuJqqbIGExGl4loARajU1twskJLLhIsID7+tvUoDnIjTg5T9DPH9EBrz8rxjPzciAl9+O8SxI8CzJ8CxKFfh3ynK8Dyb8wNHM/XDqejx/AtNyPO87tNybAAAAAElFTkSuQmCC) no-repeat 50% 50%;
    background-size: 8px;
    cursor: pointer;
    outline: 0,
}

.iziToast>.iziToast-close:hover {
    opacity: 1
}

.iziToast>.iziToast-body {
    position: relative;
    padding: 0 0 0 10px;
    height: auto;
    min-height: 36px;
    margin: 0 0 0 15px;
    text-align: left
}

.iziToast>.iziToast-body:after {
    content: "";
    display: table;
    clear: both
}

.iziToast>.iziToast-body .iziToast-texts {
    margin: 10px 0 0;
    padding-right: 2px;
    display: inline-block;
    float: left
}

.iziToast>.iziToast-body .iziToast-inputs {
    min-height: 19px;
    float: left;
    margin: 3px -2px
}

.iziToast>.iziToast-body .iziToast-inputs>input:not([type=checkbox]):not([type=radio]),
.iziToast>.iziToast-body .iziToast-inputs>select {
    position: relative;
    display: inline-block;
    margin: 2px;
    border-radius: 2px;
    border: 0;
    padding: 4px 7px;
    font-size: 13px;
    letter-spacing: .02em;
    background: rgba(0, 0, 0, .1);
    color: #000;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, .2);
    min-height: 26px
}

.iziToast>.iziToast-body .iziToast-inputs>input:not([type=checkbox]):not([type=radio]):focus,
.iziToast>.iziToast-body .iziToast-inputs>select:focus {
    box-shadow: 0 0 0 1px rgba(0, 0, 0, .6)
}

.iziToast>.iziToast-body .iziToast-buttons {
    min-height: 17px;
    float: left;
    margin: 4px -2px
}

.iziToast>.iziToast-body .iziToast-buttons>a,
.iziToast>.iziToast-body .iziToast-buttons>button,
.iziToast>.iziToast-body .iziToast-buttons>input:not([type=checkbox]):not([type=radio]) {
    position: relative;
    display: inline-block;
    margin: 2px;
    border-radius: 2px;
    border: 0;
    padding: 5px 10px;
    font-size: 12px;
    letter-spacing: .02em;
    cursor: pointer;
    background: rgba(0, 0, 0, .1);
    color: #000
}

.iziToast>.iziToast-body .iziToast-buttons>a:hover,
.iziToast>.iziToast-body .iziToast-buttons>button:hover,
.iziToast>.iziToast-body .iziToast-buttons>input:not([type=checkbox]):not([type=radio]):hover {
    background: rgba(0, 0, 0, .2)
}

.iziToast>.iziToast-body .iziToast-buttons>a:focus,
.iziToast>.iziToast-body .iziToast-buttons>button:focus,
.iziToast>.iziToast-body .iziToast-buttons>input:not([type=checkbox]):not([type=radio]):focus {
    box-shadow: 0 0 0 1px rgba(0, 0, 0, .6)
}

.iziToast>.iziToast-body .iziToast-buttons>a:active,
.iziToast>.iziToast-body .iziToast-buttons>button:active,
.iziToast>.iziToast-body .iziToast-buttons>input:not([type=checkbox]):not([type=radio]):active {
    top: 1px
}

.iziToast>.iziToast-body .iziToast-icon {
    position: absolute;
    left: 0;
    top: 50%;
    display: table;
    font-size: 23px;
    line-height: 24px;
    margin-top: -12px;
    color: #000;
    width: 24px;
    height: 24px
}

.iziToast>.iziToast-body .iziToast-icon.ico-info {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAMAAACdt4HsAAAAflBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACCtoPsAAAAKXRSTlMA6PsIvDob+OapavVhWRYPrIry2MxGQ97czsOzpJaMcE0qJQOwVtKjfxCVFeIAAAI3SURBVFjDlJPZsoIwEETnCiGyb8q+qmjl/3/wFmGKwjBROS9QWbtnOqDDGPq4MdMkSc0m7gcDDhF4NRdv8NoL4EcMpzoJglPl/KTDz4WW3IdvXEvxkfIKn7BMZb1bFK4yZFqghZ03jk0nG8N5NBwzx9xU5cxAg8fXi20/hDdC316lcA8o7t16eRuQvW1XGd2d2P8QSHQDDbdIII/9CR3lUF+lbucfJy4WfMS64EJPORnrZxtfc2pjJdnbuags3l04TTtJMXrdTph4Pyg4XAjugAJqMDf5Rf+oXx2/qi4u6nipakIi7CsgiuMSEF9IGKg8heQJKkxIfFSUU/egWSwNrS1fPDtLfon8sZOcYUQml1Qv9a3kfwsEUyJEMgFBKzdV8o3Iw9yAjg1jdLQCV4qbd3no8yD2GugaC3oMbF0NYHCpJYSDhNI5N2DAWB4F4z9Aj/04Cna/x7eVAQ17vRjQZPh+G/kddYv0h49yY4NWNDWMMOMUIRYvlTECmrN8pUAjo5RCMn8KoPmbJ/+Appgnk//Sy90GYBCGgm7IAskQ7D9hFKW4ApB1ei3FSYD9PjGAKygAV+ARFYBH5BsVgG9kkBSAQWKUFYBRZpkUgGVinRWAdUZQDABBQdIcAElDVBUAUUXWHQBZx1gMAGMprM0AsLbVXHsA5trZe93/wp3svQ0YNb/jWV3AIOLsMtlznSNOH7JqjOpDVh7z8qCZR10ftvO4nxeOvPLkpSuvfXnxzKtvXr7j+v8C5ii0e71At7cAAAAASUVORK5CYII=) no-repeat 50% 50%;
    background-size: 85%
}

.iziToast>.iziToast-body .iziToast-icon.ico-warning {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEQAAABECAMAAAAPzWOAAAAAkFBMVEUAAAAAAAABAAIAAAABAAIAAAMAAAABAAIBAAIBAAIAAAIAAAABAAIAAAABAAICAAICAAIAAAIAAAAAAAAAAAABAAIBAAIAAAMAAAABAAIBAAMBAAECAAIAAAIAAAIAAAABAAIBAAIBAAMBAAIBAAEAAAIAAAMAAAAAAAABAAECAAICAAIAAAIAAAMAAAQAAAE05yNAAAAAL3RSTlMAB+kD7V8Q+PXicwv7I9iYhkAzJxnx01IV5cmnk2xmHfzexsK4eEw5L7Gei39aRw640awAAAHQSURBVFjD7ZfJdoJAEEWJgCiI4oDiPM8m7///LidErRO7sHrY5u7YXLr7vKqu9kTC0HPmo9n8cJbEQOzqqAdAUHeUZACQuTkGDQBoDJwkHZR0XBz9FkpafXuHP0SJ09mGeJLZ5wwlTmcbA0THPmdEK7XPGTG1zxmInn3OiJ19zkB0jSVTKExMHT0wjAwlWzC0fSPHF1gWRpIhWMYm7fYTFcQGlbemf4dFfdTGg0B/KXM8qBU/3wntbq7rSGqvJ9kla6IpueFJet8fxfem5yhykjyOgNaWF1qSGd5JMNNxpNF7SZQaVh5JzLrTCZIEJ1GyEyVyd+pClMjdaSJK5O40giSRu5PfFiVyd1pAksjdKRnrSsbVdbiHrgT7yss315fkVQPLFQrL+4FHeOXKO5YRFEKv5AiFaMlKLlBpJuVCJlC5sJfvCgztru/3NmBYccPgGTxRAzxn1XGEMUf58pXZvjoOsOCgjL08+b53mtfAM/SVsZcjKLtysQZPqIy9HPP3m/3zKItRwT0LyQo8sTr26tcO83DIUMWIJjierHLsJda/tbNBFY0BP/bKtcM8HNIWCK3aYR4OMzgxo5w5EFLOLKDExXAm9gI4E3iAO94/Ct/lKWuM2LMGbgAAAABJRU5ErkJggg==) no-repeat 50% 50%;
    background-size: 85%
}

.iziToast>.iziToast-body .iziToast-icon.ico-error {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAMAAACdt4HsAAAAeFBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAVyEiIAAAAJ3RSTlMA3BsB98QV8uSyWVUFz7+kcWMM2LuZioBpTUVBNcq2qaibj4d1azLZZYABAAACZElEQVRYw7WX25KCMAyGAxUoFDkpiohnV97/DXeGBtoOUprZ2dyo1K82fxKbwJJVp+KQZ7so2mX5oThVQLKwjDe9YZu4DF3ptAn6rxY0qQPOEq9fNC9ha3y77a22ba24v+9Xbe8v8x03dPOC2/NdvB6xeSreLfGJpnx0TyotKqLm2s7Jd/WO6ivXNp0tCy02R/aFz5VQ5wUPlUL5fIfj5KIlVGU0nWHm/5QtoTVMWY8mzIVu1K9O7XH2JiU/xnOOT39gnUfj+lFHddx4tFjL3/H8jjzaFCy2Rf0c/fdQyQszI8BDR973IyMSKa4krjxAiW/lkRvMP+bKK9WbYS1ASQg8dKjaUGlYPwRe/WoIkz8tiQchH5QAEMv6T0k8MD4mUyWr4E7jAWqZ+xWcMIYkXvlwggJ3IvFK+wIOcpXAo8n8P0COAaXyKH4OsjBuZB4ew0IGu+H1SebhNazsQBbWm8yj+hFuUJB5eMsN0IUXmYendAFFfJB5uEkRMYwxmcd6zDGRtmQePEykAgubymMRFmMxCSIPCRbTuFNN5OGORTjmNGc0Po0m8Uv0gcCry6xUhR2QeLii9tofbEfhz/qvNti+OfPqNm2Mq6105FUMvdT4GPmufMiV8PqBMkc+DdT1bjYYbjzU/ew23VP4n3mLAz4n8Jtv/Ui3ceTT2mzz5o1mZt0gnBpmsdjqRqVlmplcPdqa7X23kL9brdm2t/uBYDPn2+tyu48mtIGD10JTuUrukVrbCFiwDzcHrPjxKt7PW+AZQyT/WESO+1WL7f3o+WLHL2dYMSZsg6dg/z360ofvP4//v1NPzgs28WlWAAAAAElFTkSuQmCC) no-repeat 50% 50%;
    background-size: 80%
}

.iziToast>.iziToast-body .iziToast-icon.ico-success {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABABAMAAABYR2ztAAAAIVBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABt0UjBAAAACnRSTlMApAPhIFn82wgGv8mVtwAAAKVJREFUSMft0LEJAkEARNFFFEw1NFJb8CKjAy1AEOzAxNw+bEEEg6nyFjbY4LOzcBwX7S/gwUxoTdIn+Jbv4Lv8bx446+kB6VsBtK0B+wbMCKxrwL33wOrVeeChX28n7KTOTjgoEu6DRSYAgAAAAkAmAIAAAAIACQIkMkACAAgAIACAyECBKAOJuCagTJwSUCaUAEMAABEBRwAAEQFLbCJgO4bW+AZKGnktR+jAFAAAAABJRU5ErkJggg==) no-repeat 50% 50%;
    background-size: 85%
}

.iziToast>.iziToast-body .iziToast-icon.ico-question {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAQAAAAAYLlVAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAADdcAAA3XAUIom3gAAAAHdElNRQfhCQkUEhFovxTxAAAEDklEQVRo3s2ZTWgTQRTHf03ipTRUqghNSgsRjHgQrFUQC6JgD1Kak3gQUUoPqRdBglf1oBehBws9Cn4cGk+1SOmh2upBxAYVoeJHrR9tgq0i1Cq0lqYeks7MbpPdmU00/c8hm9n33v/t7Nt5M2+qMEWQI0QIibZKRrQpHvLL2KI2wnQzzBKrDm2RIeKEy01dTYKUI7G1ZRknQXV5yP10kTYgly1NF/5S6duZ8ES+1iZodyaocrjXxE0OFeifYYgp0mRIkwFChAkRJsIxGgrIP+I0n82fvZW5dc/zkss0O2o1c5mX6/TmaDWl77RFe5YkUW3tKEmyFv0lOvXJ/fTYnmCEFuMRbGHEZqVHLyT9DFjUJmkzJl9DG5MWWwM6Llif/gF1nukB6nhgGwUXdFrE+wiURA8QoM9i0zEWWpXQW+ZsyeRrOMuyEo5Fv4gmy4dXPvqcC+pH2VRYaMwy+OWG+iLGCgm0W0Kv9HdvR8ASjmKCXpuK/bxiV/76A/v5UdDIZuKcJGjrnec5KZ7wwsWFOp6xPX/9mt2sqDe7FO+Kf/fXHBPPDWpdXGhTpLvUG9VKwh1xMDDjkvu+cNDFBTk7ptX1QkKZ850m3duu6fcrWxwdaFFyREJ2j4vOpKP6Du6z4uJCv8sYJIVkCnJBGGZaBONO3roY2EqNrSfIPi7SKP4fdXyNUd6I6wbSAHEl33tFLe+FlSsusnK90A0+oEPcuufZgXnOi+u9LrKSJQZQw6LwqBnv2CKsfHORbFbyQhA6xN/pEuihSdj56Co7LWRjPiKie6gkB2LiKuUqK5kiPkLiz1QJ9K1cNXBAMoUCigNpQ9IqDtMI1HKA4/jyvUsaoSyZLA5kjOjDPFZen8Ql5TsvBskUgjciIPSX3QAXC86DT7VWvlEh/xZ+ij9BDVWJ0QL0SbZq6QaFxoLPcXPmBLveLCc4wXdDK6s+6/vwhCSniFLPXW0NJe5UB8zKCsviqpc7vGPVQFcyZbyPwGD+d5ZnxmNWlhG4xSBZZjivjIWHEQgoDkSMjMwTo54569JSE5IpA7EyJSMTyGTUAUFlO1ZKOtaHTMeL1PhYYFTcihmY2cQ5+ullj7EDkiVfVez2sCTz8yiv84djhg7IJVk81xFWJlPdfHBG0flkRC/zQFZ+DSllNtfDdUsOMCliyGX5uOzU3ZhIXFDof4m1gDuKbEx0t2YS25gVGpcMnr/I1kx3c6piB8P8ZoqEwfMX3ZyCXynJTmq/U7NUXqfUzCbWL1wqVKBQUeESzQYoUlW8TAcVL1RCxUu1G6BYXfFyfQ4VPbDI4T8d2WzgQ6sc/vmxnTsqfHCZQzUJxm1h5dxS5Tu6lQgTZ0ipqRVqSwzTbbLHMt+c19iO76tsx/cLZub+Ali+tYC93olEAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDE3LTA5LTA5VDIwOjE4OjE3KzAyOjAwjKtfjgAAACV0RVh0ZGF0ZTptb2RpZnkAMjAxNy0wOS0wOVQyMDoxODoxNyswMjowMP325zIAAAAZdEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC) no-repeat 50% 50%;
    background-size: 85%
}

.iziToast>.iziToast-body .iziToast-message,
.iziToast>.iziToast-body .iziToast-title {
    padding: 0;
    font-size: 14px;
    line-height: 16px;
    text-align: left;
    float: left;
    white-space: normal
}

.iziToast>.iziToast-body .iziToast-title {
    color: #000;
    margin: 0
}

.iziToast>.iziToast-body .iziToast-message {
    margin: 0 0 10px;
    color: rgba(0, 0, 0, .6)
}

.iziToast.iziToast-animateInside .iziToast-buttons-child,
.iziToast.iziToast-animateInside .iziToast-icon,
.iziToast.iziToast-animateInside .iziToast-inputs-child,
.iziToast.iziToast-animateInside .iziToast-message,
.iziToast.iziToast-animateInside .iziToast-title {
    opacity: 0
}

.iziToast-target {
    position: relative;
    width: 100%;
    margin: 0 auto
}

.iziToast-target .iziToast-capsule {
    overflow: hidden
}

.iziToast-target .iziToast-capsule:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0
}

.iziToast-target .iziToast-capsule .iziToast {
    width: 100%;
    float: left
}

.iziToast-wrapper {
    z-index: 99999;
    position: fixed;
    width: 100%;
    pointer-events: none;
    display: flex;
    flex-direction: column
}

.iziToast-wrapper .iziToast.iziToast-balloon:before {
    border-right: 0 solid transparent;
    border-left: 15px solid transparent;
    border-top: 10px solid #000;
    border-top-color: inherit;
    right: 8px;
    left: auto
}

.iziToast-wrapper-bottomLeft {
    left: 0;
    bottom: 0;
    text-align: left
}

.iziToast-wrapper-bottomLeft .iziToast.iziToast-balloon:before,
.iziToast-wrapper-topLeft .iziToast.iziToast-balloon:before {
    border-right: 15px solid transparent;
    border-left: 0 solid transparent;
    right: auto;
    left: 8px
}

.iziToast-wrapper-bottomRight {
    right: 0;
    bottom: 0;
    text-align: right
}

.iziToast-wrapper-topLeft {
    left: 0;
    top: 0;
    text-align: left
}

.iziToast-wrapper-topRight {
    top: 0;
    right: 0;
    text-align: right
}

.iziToast-wrapper-topCenter {
    top: 0;
    left: 0;
    right: 0;
    text-align: center
}

.iziToast-wrapper-bottomCenter,
.iziToast-wrapper-center {
    bottom: 0;
    left: 0;
    right: 0;
    text-align: center
}

.iziToast-wrapper-center {
    top: 0;
    justify-content: center;
    flex-flow: column;
    align-items: center
}

.iziToast-rtl {
    direction: rtl;
    padding: 8px 0 9px 45px;
    font-family: Tahoma, 'Lato', Arial
}

.iziToast-rtl .iziToast-cover {
    left: auto;
    right: 0
}

.iziToast-rtl .iziToast-close {
    right: auto;
    left: 0
}

.iziToast-rtl .iziToast-body {
    padding: 0 10px 0 0;
    margin: 0 16px 0 0;
    text-align: right
}

.iziToast-rtl .iziToast-body .iziToast-buttons,
.iziToast-rtl .iziToast-body .iziToast-inputs,
.iziToast-rtl .iziToast-body .iziToast-message,
.iziToast-rtl .iziToast-body .iziToast-texts,
.iziToast-rtl .iziToast-body .iziToast-title {
    float: right;
    text-align: right
}

.iziToast-rtl .iziToast-body .iziToast-icon {
    left: auto;
    right: 0
}

@media only screen and (min-width:568px) {
    .iziToast-wrapper {
        padding: 10px 15px
    }

    .iziToast {
        margin: 5px 0;
        border-radius: 3px;
        width: auto
    }

    .iziToast:after {
        content: '';
        z-index: -1;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 3px;
        box-shadow: inset 0 -10px 20px -10px rgba(0, 0, 0, .2), inset 0 0 5px rgba(0, 0, 0, .1), 0 8px 8px -5px rgba(0, 0, 0, .25)
    }

    .iziToast:not(.iziToast-rtl) .iziToast-cover {
        border-radius: 3px 0 0 3px
    }

    .iziToast.iziToast-rtl .iziToast-cover {
        border-radius: 0 3px 3px 0
    }

    .iziToast.iziToast-color-dark:after {
        box-shadow: inset 0 -10px 20px -10px rgba(255, 255, 255, .3), 0 10px 10px -5px rgba(0, 0, 0, .25)
    }

    .iziToast.iziToast-balloon .iziToast-progressbar {
        background: 0 0
    }

    .iziToast.iziToast-balloon:after {
        box-shadow: 0 10px 10px -5px rgba(0, 0, 0, .25), inset 0 10px 20px -5px rgba(0, 0, 0, .25)
    }

    .iziToast-target .iziToast:after {
        box-shadow: inset 0 -10px 20px -10px rgba(0, 0, 0, .2), inset 0 0 5px rgba(0, 0, 0, .1)
    }
}

.iziToast.iziToast-theme-dark {
    background: #565c70;
    border-color: #565c70
}

.iziToast.iziToast-theme-dark .iziToast-title {
    color: #fff
}

.iziToast.iziToast-theme-dark .iziToast-message {
    color: rgba(255, 255, 255, .7);
    font-weight: 300
}

.iziToast.iziToast-theme-dark .iziToast-close {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAQAAADZc7J/AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAADdcAAA3XAUIom3gAAAAHdElNRQfgCR4OIQIPSao6AAAAwElEQVRIx72VUQ6EIAwFmz2XB+AConhjzqTJ7JeGKhLYlyx/BGdoBVpjIpMJNjgIZDKTkQHYmYfwmR2AfAqGFBcO2QjXZCd24bEggvd1KBx+xlwoDpYmvnBUUy68DYXD77ESr8WDtYqvxRex7a8oHP4Wo1Mkt5I68Mc+qYqv1h5OsZmZsQ3gj/02h6cO/KEYx29hu3R+VTTwz6D3TymIP1E8RvEiiVdZfEzicxYLiljSxKIqlnW5seitTW6uYnv/Aqh4whX3mEUrAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDE2LTA5LTMwVDE0OjMzOjAyKzAyOjAwl6RMVgAAACV0RVh0ZGF0ZTptb2RpZnkAMjAxNi0wOS0zMFQxNDozMzowMiswMjowMOb59OoAAAAZdEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC) no-repeat 50% 50%;
    background-size: 8px
}

.iziToast.iziToast-theme-dark .iziToast-icon {
    color: #fff
}

.iziToast.iziToast-theme-dark .iziToast-icon.ico-info {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAMAAACdt4HsAAAAflBMVEUAAAD////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////vroaSAAAAKXRSTlMA6PsIvDob+OapavVhWRYPrIry2MxGQ97czsOzpJaMcE0qJQOwVtKjfxCVFeIAAAI3SURBVFjDlJPZsoIwEETnCiGyb8q+qmjl/3/wFmGKwjBROS9QWbtnOqDDGPq4MdMkSc0m7gcDDhF4NRdv8NoL4EcMpzoJglPl/KTDz4WW3IdvXEvxkfIKn7BMZb1bFK4yZFqghZ03jk0nG8N5NBwzx9xU5cxAg8fXi20/hDdC316lcA8o7t16eRuQvW1XGd2d2P8QSHQDDbdIII/9CR3lUF+lbucfJy4WfMS64EJPORnrZxtfc2pjJdnbuags3l04TTtJMXrdTph4Pyg4XAjugAJqMDf5Rf+oXx2/qi4u6nipakIi7CsgiuMSEF9IGKg8heQJKkxIfFSUU/egWSwNrS1fPDtLfon8sZOcYUQml1Qv9a3kfwsEUyJEMgFBKzdV8o3Iw9yAjg1jdLQCV4qbd3no8yD2GugaC3oMbF0NYHCpJYSDhNI5N2DAWB4F4z9Aj/04Cna/x7eVAQ17vRjQZPh+G/kddYv0h49yY4NWNDWMMOMUIRYvlTECmrN8pUAjo5RCMn8KoPmbJ/+Appgnk//Sy90GYBCGgm7IAskQ7D9hFKW4ApB1ei3FSYD9PjGAKygAV+ARFYBH5BsVgG9kkBSAQWKUFYBRZpkUgGVinRWAdUZQDABBQdIcAElDVBUAUUXWHQBZx1gMAGMprM0AsLbVXHsA5trZe93/wp3svQ0YNb/jWV3AIOLsMtlznSNOH7JqjOpDVh7z8qCZR10ftvO4nxeOvPLkpSuvfXnxzKtvXr7j+v8C5ii0e71At7cAAAAASUVORK5CYII=) no-repeat 50% 50%;
    background-size: 85%
}

.iziToast.iziToast-theme-dark .iziToast-icon.ico-warning {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEQAAABECAMAAAAPzWOAAAAAllBMVEUAAAD////+//3+//3+//3///////z+//3+//3+//3////////////9//3////+//39//3///3////////////+//3+//39//3///z+//z+//7///3///3///3///3////////+//3+//3+//3+//z+//3+//7///3///z////////+//79//3///3///z///v+//3///+trXouAAAAMHRSTlMAB+j87RBf+PXiCwQClSPYhkAzJxnx05tSyadzcmxmHRbp5d7Gwrh4TDkvsYt/WkdQzCITAAAB1UlEQVRYw+3XaXKCQBCGYSIIighoxCVqNJrEPfly/8vFImKXduNsf/Mc4K1y7FnwlMLQc/bUbj85R6bA1LXRDICg6RjJcZa7NQYtnLUGTpERSiOXxrOPkv9s30iGKDmtbYir3H7OUHJa2ylAuvZzRvzUfs7Ii/2cgfTt54x82s8ZSM848gJmYtroQzA2jHwA+LkBIEuMGt+QIng1igzlyMrkuP2CyOi47axRaYTL5jhDJehoR+aovC29s3iIyly3Eb+hRCvZo2qsGTnhKr2cLDS+J73GsqBI9W80UCmWWpEuhIjh6ZRGjyNRarjzKGJ2Ou2himCvjHwqI+rTqQdlRH06TZQR9ek0hiqiPp06mV4ke7QPX6ERUZxO8Uo3sqrfhxvoRrCpvXwL/UjR9GRHMIvLgke4d5QbiwhM6JV2YKKF4vIl7XIBkwm4keryJVmvk/TfwcmPwQNkUQuyA2/sYGwnXL7GPu4bW1jYsmevrNj09/MGZMOEPXslQVqO8hqykD17JfPHP/bmo2yGGpdZiH3IZvzZa7B3+IdDjjpjesHJcvbs5dZ/e+cddVoDdvlq7x12Nac+iN7e4R8OXTjp0pw5CGnOLNDEzeBs5gVwFniAO+8f8wvfeXP2hyqnmwAAAABJRU5ErkJggg==) no-repeat 50% 50%;
    background-size: 85%
}

.iziToast.iziToast-theme-dark .iziToast-icon.ico-error {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAMAAACdt4HsAAAAeFBMVEUAAAD////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////GqOSsAAAAJ3RSTlMA3BsB98QV8uSyWVUFz6RxYwzYvbupmYqAaU1FQTXKv7abj4d1azKNUit3AAACZElEQVRYw7WXaZOCMAyGw30UORRQBLxX/v8/3BkaWjrY2szO5otKfGrzJrEp6Kw6F8f8sI+i/SE/FucKSBaWiT8p5idlaEtnXTB9tKDLLHAvdSatOan3je93k9F2vRF36+mr1a6eH2NFNydoHq/ieU/UXcWjjk9XykdNWq2ywtp4tXL6Wb2T/MqtzzZutsrNyfvA51KoQROhVCjfrnASIRpSVUZiD5v4RbWExjRdJzSmOsZFvzYz59kRSr6V5zE+/QELHkNdb3VRx45HS1b1u+zfkkcbRAZ3qJ9l/A4qefHUDMShJe+6kZKJDD2pLQ9Q4lu+5Q7rz7Plperd7AtQEgIPI6o2dxr2D4GXvxqCiKcn8cD4gxIAEt7/GYkHL16KqeJd0NB4gJbXfgVnzCGJlzGcocCVSLzUvoAj9xJ4NF7/R8gxoVQexc/hgBpSebjPjgPs59cHmYfn7NkDb6wXmUf1I1ygIPPw4gtgCE8yDw8eAop4J/PQcBExjQmZx37MsZB2ZB4cLKQCG5vKYxMWSzMxIg8pNtOyUkvkocEmXGo69mh8FgnxS4yBwMvDrJSNHZB4uC3ayz/YkcIP4lflwVIT+OU07ZSjrbTkZQ6dTPkYubZ8GC/Cqxu6WvJZII93dcCw46GdNqdpTeF/tiMOuDGB9z/NI6NvyWetGPM0g+bVNeovBmamHXWj0nCbEaGeTMN2PWrqd6cM26ZxP2DeJvj+ph/30Zi/GmRbtlK5SptI+nwGGnvH6gUruT+L16MJHF+58rwNIifTV0vM8+hwMeOXAb6Yx0wXT+b999WXfvn+8/X/F7fWzjdTord5AAAAAElFTkSuQmCC) no-repeat 50% 50%;
    background-size: 80%
}

.iziToast.iziToast-theme-dark .iziToast-icon.ico-success {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABABAMAAABYR2ztAAAAIVBMVEUAAAD////////////////////////////////////////PIev5AAAACnRSTlMApAPhIFn82wgGv8mVtwAAAKVJREFUSMft0LEJAkEARNFFFEw1NFJb8CKjAy1AEOzAxNw+bEEEg6nyFjbY4LOzcBwX7S/gwUxoTdIn+Jbv4Lv8bx446+kB6VsBtK0B+wbMCKxrwL33wOrVeeChX28n7KTOTjgoEu6DRSYAgAAAAkAmAIAAAAIACQIkMkACAAgAIACAyECBKAOJuCagTJwSUCaUAEMAABEBRwAAEQFLbCJgO4bW+AZKGnktR+jAFAAAAABJRU5ErkJggg==) no-repeat 50% 50%;
    background-size: 85%
}

.iziToast.iziToast-theme-dark .iziToast-icon.ico-question {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAQAAAAAYLlVAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAADdcAAA3XAUIom3gAAAAHdElNRQfhCQkUEg18vki+AAAETUlEQVRo3s1ZTWhbRxD+VlIuxsLFCYVIIQYVopBDoK5bKDWUBupDMNbJ5FBKg/FBziUQdE9yaC+FHBrwsdCfQ9RTGoLxwWl+DqHEojUFFydxnB9bInZDqOsErBrr6yGvs/ueX97bldTKo4Pe7puZb3Z33s7srIIjMY1jyCEjP6ImvyX8pF64arSHznKC06wzijY5xSKz7YbuYokV2lODsyyxqz3gSY6z6gCuqcpxJluFH+Z8U+D/0jyHoxFUBHgfvsGHIS9WMIUlVFFDFTUAGWSRQRY5HMeBEP6b+Ew9dh/7INd2jGeO59kfKdXP85zbIbfGQVf4sYC3N1hm3lo6zzIbPvk6x+zBk7wQGMEMB5xncIAzAS0XrFySSV72iS1yyBVcdA1x0afrsoUJgdFfY2+z8ADAXl7zz0KcwJiPfZKpVuABgClO+nRG+QIHDdfb4qlWwUXvKW4Z7vi6L4J9vg+vbfCeCeZH2RfOdMOc/HbCA4BvIW6EMQz7XK/ltd+hP+VzR9mgva2YSfyGI17fA7ynnocqeQNFfIJ0oHsdv6CC2+rXGBN6cQdveY3fcVRtmy/HDete+93zy8jA8zV7YkwYMrjHzRddRsCdiVCwwmh6wg9iTNC7Y9XIF1iS7kbUpsvvGEdPuTfSgAEjRpR096x0liPFD/Eqt2NMuBQzB2XhrACAApjFsuQFh9XdGAX70B3oSuNdnMVBaX+sopYxjwVpHFBVACyKTXNoktjD+6Ll8xhenS9MAAkAI/Lux2YNUOs4I413Ypg1SgEAu7kpFvWjaeJe0fJHDGe/cNaZBkekudw8PMA+0fMwlndZeAsJ5KR/qhUDUJCnSiyvRsolkJHGUgvjH8QXDgZopEzKMKDqCKrwEQ4C6MH7GEXC665buLJG8hlQc4LP4paxfJrOqYVYYY2UARfEIazTbgDg2dB98GebzJd54b8L/iWNdLyooeR6CHyZ+6xk0yKxkYg6nEVSUG4VJ9QJ9cxRCxO+9WiOyvgUeexXP1hLGH5nGuBWVtiSp4vqe3VP0UFWI9Wan4Er3v8q7jjPWVtm4FtcQQMrOKO2nOQCM5AyDMi56FDrKHA/1nyppS1ppBpYaE8wciEjGI2AaeM41kI4doDX4XiT3Qm1gevyruCgZg9P8xIv8m1nCzTKq6oiJ9xTMiZ505P5m8cdZ0CnZMVXHVljM7WMBzxpyDxygtdxoCEFTaMIWbZU85UvBjgUMYy0fBaAF8V1Lj9qWQ1aMZ5f4k9r+AGMSkMP1vZoZih6k6sicc5h/OFHM9vDqU/VIU7zJZdYYsKGH4g4nAJMGiXZRds1pVMoZ69RM5vfkbh0qkBhsnS2RLMLilQdL9MBHS9UAh0v1e6CYnXHy/WeeCcvLDwl/9OVze69tPKM+M+v7eJN6OzFpWdEF0ucDbhVNFXadnVrmJFlkVNGTS2M6pzmhMvltfPhnN2B63sVuL7fcNP3D1TSk2ihosPrAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDE3LTA5LTA5VDIwOjE4OjEzKzAyOjAweOR7nQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAxNy0wOS0wOVQyMDoxODoxMyswMjowMAm5wyEAAAAZdEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC) no-repeat 50% 50%;
    background-size: 85%
}

.iziToast.iziToast-theme-dark .iziToast-buttons>a,
.iziToast.iziToast-theme-dark .iziToast-buttons>button,
.iziToast.iziToast-theme-dark .iziToast-buttons>input {
    color: #fff;
    background: rgba(255, 255, 255, .1)
}

.iziToast.iziToast-theme-dark .iziToast-buttons>a:hover,
.iziToast.iziToast-theme-dark .iziToast-buttons>button:hover,
.iziToast.iziToast-theme-dark .iziToast-buttons>input:hover {
    background: rgba(255, 255, 255, .2)
}

.iziToast.iziToast-theme-dark .iziToast-buttons>a:focus,
.iziToast.iziToast-theme-dark .iziToast-buttons>button:focus,
.iziToast.iziToast-theme-dark .iziToast-buttons>input:focus {
    box-shadow: 0 0 0 1px rgba(255, 255, 255, .6)
}

.iziToast.iziToast-color-red {
    background: rgba(255, 175, 180, .9);
    border-color: rgba(255, 175, 180, .9)
}

.iziToast.iziToast-color-orange {
    background: rgba(255, 207, 165, .9);
    border-color: rgba(255, 207, 165, .9)
}

.iziToast.iziToast-color-yellow {
    background: rgba(255, 249, 178, .9);
    border-color: rgba(255, 249, 178, .9)
}

.iziToast.iziToast-color-blue {
    background: rgba(157, 222, 255, .9);
    border-color: rgba(157, 222, 255, .9)
}

.iziToast.iziToast-color-green {
    background: rgba(166, 239, 184, .9);
    border-color: rgba(166, 239, 184, .9)
}

.iziToast.iziToast-layout2 .iziToast-body .iziToast-message,
.iziToast.iziToast-layout2 .iziToast-body .iziToast-texts {
    width: 100%
}

.iziToast.iziToast-layout3 {
    border-radius: 2px
}

.iziToast.iziToast-layout3::after {
    display: none
}

.iziToast .revealIn,
.iziToast.revealIn {
    -webkit-animation: iziT-revealIn 1s cubic-bezier(.25, 1.6, .25, 1) both;
    -moz-animation: iziT-revealIn 1s cubic-bezier(.25, 1.6, .25, 1) both;
    animation: iziT-revealIn 1s cubic-bezier(.25, 1.6, .25, 1) both
}

.iziToast .slideIn,
.iziToast.slideIn {
    -webkit-animation: iziT-slideIn 1s cubic-bezier(.16, .81, .32, 1) both;
    -moz-animation: iziT-slideIn 1s cubic-bezier(.16, .81, .32, 1) both;
    animation: iziT-slideIn 1s cubic-bezier(.16, .81, .32, 1) both
}

.iziToast.bounceInLeft {
    -webkit-animation: iziT-bounceInLeft .7s ease-in-out both;
    animation: iziT-bounceInLeft .7s ease-in-out both
}

.iziToast.bounceInRight {
    -webkit-animation: iziT-bounceInRight .85s ease-in-out both;
    animation: iziT-bounceInRight .85s ease-in-out both
}

.iziToast.bounceInDown {
    -webkit-animation: iziT-bounceInDown .7s ease-in-out both;
    animation: iziT-bounceInDown .7s ease-in-out both
}

.iziToast.bounceInUp {
    -webkit-animation: iziT-bounceInUp .7s ease-in-out both;
    animation: iziT-bounceInUp .7s ease-in-out both
}

.iziToast .fadeIn,
.iziToast.fadeIn {
    -webkit-animation: iziT-fadeIn .5s ease both;
    animation: iziT-fadeIn .5s ease both
}

.iziToast.fadeInUp {
    -webkit-animation: iziT-fadeInUp .7s ease both;
    animation: iziT-fadeInUp .7s ease both
}

.iziToast.fadeInDown {
    -webkit-animation: iziT-fadeInDown .7s ease both;
    animation: iziT-fadeInDown .7s ease both
}

.iziToast.fadeInLeft {
    -webkit-animation: iziT-fadeInLeft .85s cubic-bezier(.25, .8, .25, 1) both;
    animation: iziT-fadeInLeft .85s cubic-bezier(.25, .8, .25, 1) both
}

.iziToast.fadeInRight {
    -webkit-animation: iziT-fadeInRight .85s cubic-bezier(.25, .8, .25, 1) both;
    animation: iziT-fadeInRight .85s cubic-bezier(.25, .8, .25, 1) both
}

.iziToast.flipInX {
    -webkit-animation: iziT-flipInX .85s cubic-bezier(.35, 0, .25, 1) both;
    animation: iziT-flipInX .85s cubic-bezier(.35, 0, .25, 1) both
}

.iziToast.fadeOut {
    -webkit-animation: iziT-fadeOut .7s ease both;
    animation: iziT-fadeOut .7s ease both
}

.iziToast.fadeOutDown {
    -webkit-animation: iziT-fadeOutDown .7s cubic-bezier(.4, .45, .15, .91) both;
    animation: iziT-fadeOutDown .7s cubic-bezier(.4, .45, .15, .91) both
}

.iziToast.fadeOutUp {
    -webkit-animation: iziT-fadeOutUp .7s cubic-bezier(.4, .45, .15, .91) both;
    animation: iziT-fadeOutUp .7s cubic-bezier(.4, .45, .15, .91) both
}

.iziToast.fadeOutLeft {
    -webkit-animation: iziT-fadeOutLeft .5s ease both;
    animation: iziT-fadeOutLeft .5s ease both
}

.iziToast.fadeOutRight {
    -webkit-animation: iziT-fadeOutRight .5s ease both;
    animation: iziT-fadeOutRight .5s ease both
}

.iziToast.flipOutX {
    -webkit-backface-visibility: visible !important;
    backface-visibility: visible !important;
    -webkit-animation: iziT-flipOutX .7s cubic-bezier(.4, .45, .15, .91) both;
    animation: iziT-flipOutX .7s cubic-bezier(.4, .45, .15, .91) both
}

.iziToast-overlay.fadeIn {
    -webkit-animation: iziT-fadeIn .5s ease both;
    animation: iziT-fadeIn .5s ease both
}

.iziToast-overlay.fadeOut {
    -webkit-animation: iziT-fadeOut .7s ease both;
    animation: iziT-fadeOut .7s ease both
}

@-webkit-keyframes iziT-revealIn {
    0% {
        opacity: 0;
        -webkit-transform: scale3d(.3, .3, 1)
    }

    to {
        opacity: 1
    }
}

@-moz-keyframes iziT-revealIn {
    0% {
        opacity: 0;
        -moz-transform: scale3d(.3, .3, 1)
    }

    to {
        opacity: 1
    }
}

@-webkit-keyframes iziT-slideIn {
    0% {
        opacity: 0;
        -webkit-transform: translateX(50px)
    }

    to {
        opacity: 1;
        -webkit-transform: translateX(0)
    }
}

@-moz-keyframes iziT-slideIn {
    0% {
        opacity: 0;
        -moz-transform: translateX(50px)
    }

    to {
        opacity: 1;
        -moz-transform: translateX(0)
    }
}

@-webkit-keyframes iziT-bounceInLeft {
    0% {
        opacity: 0;
        -webkit-transform: translateX(280px)
    }

    50% {
        opacity: 1;
        -webkit-transform: translateX(-20px)
    }

    70% {
        -webkit-transform: translateX(10px)
    }

    to {
        -webkit-transform: translateX(0)
    }
}

@-webkit-keyframes iziT-bounceInRight {
    0% {
        opacity: 0;
        -webkit-transform: translateX(-280px)
    }

    50% {
        opacity: 1;
        -webkit-transform: translateX(20px)
    }

    70% {
        -webkit-transform: translateX(-10px)
    }

    to {
        -webkit-transform: translateX(0)
    }
}

@-webkit-keyframes iziT-bounceInDown {
    0% {
        opacity: 0;
        -webkit-transform: translateY(-200px)
    }

    50% {
        opacity: 1;
        -webkit-transform: translateY(10px)
    }

    70% {
        -webkit-transform: translateY(-5px)
    }

    to {
        -webkit-transform: translateY(0)
    }
}

@-webkit-keyframes iziT-bounceInUp {
    0% {
        opacity: 0;
        -webkit-transform: translateY(200px)
    }

    50% {
        opacity: 1;
        -webkit-transform: translateY(-10px)
    }

    70% {
        -webkit-transform: translateY(5px)
    }

    to {
        -webkit-transform: translateY(0)
    }
}

@-webkit-keyframes iziT-fadeIn {
    0% {
        opacity: 0
    }

    to {
        opacity: 1
    }
}

@-webkit-keyframes iziT-fadeInUp {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-webkit-keyframes iziT-fadeInDown {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, -100%, 0);
        transform: translate3d(0, -100%, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-webkit-keyframes iziT-fadeInLeft {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(300px, 0, 0);
        transform: translate3d(300px, 0, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-webkit-keyframes iziT-fadeInRight {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(-300px, 0, 0);
        transform: translate3d(-300px, 0, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-webkit-keyframes iziT-flipInX {
    0% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        opacity: 0
    }

    40% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -20deg)
    }

    60% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
        opacity: 1
    }

    80% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -5deg)
    }

    to {
        -webkit-transform: perspective(400px);
        transform: perspective(400px)
    }
}

@-webkit-keyframes iziT-fadeOut {
    0% {
        opacity: 1
    }

    to {
        opacity: 0
    }
}

@-webkit-keyframes iziT-fadeOutDown {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0)
    }
}

@-webkit-keyframes iziT-fadeOutUp {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(0, -100%, 0);
        transform: translate3d(0, -100%, 0)
    }
}

@-webkit-keyframes iziT-fadeOutLeft {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(-200px, 0, 0);
        transform: translate3d(-200px, 0, 0)
    }
}

@-webkit-keyframes iziT-fadeOutRight {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(200px, 0, 0);
        transform: translate3d(200px, 0, 0)
    }
}

@-webkit-keyframes iziT-flipOutX {
    0% {
        -webkit-transform: perspective(400px);
        transform: perspective(400px)
    }

    30% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        opacity: 1
    }

    to {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        opacity: 0
    }
}

@-moz-keyframes iziT-revealIn {
    0% {
        opacity: 0;
        transform: scale3d(.3, .3, 1)
    }

    to {
        opacity: 1
    }
}

@-webkit-keyframes iziT-revealIn {
    0% {
        opacity: 0;
        transform: scale3d(.3, .3, 1)
    }

    to {
        opacity: 1
    }
}

@-o-keyframes iziT-revealIn {
    0% {
        opacity: 0;
        transform: scale3d(.3, .3, 1)
    }

    to {
        opacity: 1
    }
}

@keyframes iziT-revealIn {
    0% {
        opacity: 0;
        transform: scale3d(.3, .3, 1)
    }

    to {
        opacity: 1
    }
}

@-moz-keyframes iziT-slideIn {
    0% {
        opacity: 0;
        transform: translateX(50px)
    }

    to {
        opacity: 1;
        transform: translateX(0)
    }
}

@-webkit-keyframes iziT-slideIn {
    0% {
        opacity: 0;
        transform: translateX(50px)
    }

    to {
        opacity: 1;
        transform: translateX(0)
    }
}

@-o-keyframes iziT-slideIn {
    0% {
        opacity: 0;
        transform: translateX(50px)
    }

    to {
        opacity: 1;
        transform: translateX(0)
    }
}

@keyframes iziT-slideIn {
    0% {
        opacity: 0;
        transform: translateX(50px)
    }

    to {
        opacity: 1;
        transform: translateX(0)
    }
}

@-moz-keyframes iziT-bounceInLeft {
    0% {
        opacity: 0;
        transform: translateX(280px)
    }

    50% {
        opacity: 1;
        transform: translateX(-20px)
    }

    70% {
        transform: translateX(10px)
    }

    to {
        transform: translateX(0)
    }
}

@-webkit-keyframes iziT-bounceInLeft {
    0% {
        opacity: 0;
        transform: translateX(280px)
    }

    50% {
        opacity: 1;
        transform: translateX(-20px)
    }

    70% {
        transform: translateX(10px)
    }

    to {
        transform: translateX(0)
    }
}

@-o-keyframes iziT-bounceInLeft {
    0% {
        opacity: 0;
        transform: translateX(280px)
    }

    50% {
        opacity: 1;
        transform: translateX(-20px)
    }

    70% {
        transform: translateX(10px)
    }

    to {
        transform: translateX(0)
    }
}

@keyframes iziT-bounceInLeft {
    0% {
        opacity: 0;
        transform: translateX(280px)
    }

    50% {
        opacity: 1;
        transform: translateX(-20px)
    }

    70% {
        transform: translateX(10px)
    }

    to {
        transform: translateX(0)
    }
}

@-moz-keyframes iziT-bounceInRight {
    0% {
        opacity: 0;
        transform: translateX(-280px)
    }

    50% {
        opacity: 1;
        transform: translateX(20px)
    }

    70% {
        transform: translateX(-10px)
    }

    to {
        transform: translateX(0)
    }
}

@-webkit-keyframes iziT-bounceInRight {
    0% {
        opacity: 0;
        transform: translateX(-280px)
    }

    50% {
        opacity: 1;
        transform: translateX(20px)
    }

    70% {
        transform: translateX(-10px)
    }

    to {
        transform: translateX(0)
    }
}

@-o-keyframes iziT-bounceInRight {
    0% {
        opacity: 0;
        transform: translateX(-280px)
    }

    50% {
        opacity: 1;
        transform: translateX(20px)
    }

    70% {
        transform: translateX(-10px)
    }

    to {
        transform: translateX(0)
    }
}

@keyframes iziT-bounceInRight {
    0% {
        opacity: 0;
        transform: translateX(-280px)
    }

    50% {
        opacity: 1;
        transform: translateX(20px)
    }

    70% {
        transform: translateX(-10px)
    }

    to {
        transform: translateX(0)
    }
}

@-moz-keyframes iziT-bounceInDown {
    0% {
        opacity: 0;
        transform: translateY(-200px)
    }

    50% {
        opacity: 1;
        transform: translateY(10px)
    }

    70% {
        transform: translateY(-5px)
    }

    to {
        transform: translateY(0)
    }
}

@-webkit-keyframes iziT-bounceInDown {
    0% {
        opacity: 0;
        transform: translateY(-200px)
    }

    50% {
        opacity: 1;
        transform: translateY(10px)
    }

    70% {
        transform: translateY(-5px)
    }

    to {
        transform: translateY(0)
    }
}

@-o-keyframes iziT-bounceInDown {
    0% {
        opacity: 0;
        transform: translateY(-200px)
    }

    50% {
        opacity: 1;
        transform: translateY(10px)
    }

    70% {
        transform: translateY(-5px)
    }

    to {
        transform: translateY(0)
    }
}

@keyframes iziT-bounceInDown {
    0% {
        opacity: 0;
        transform: translateY(-200px)
    }

    50% {
        opacity: 1;
        transform: translateY(10px)
    }

    70% {
        transform: translateY(-5px)
    }

    to {
        transform: translateY(0)
    }
}

@-moz-keyframes iziT-bounceInUp {
    0% {
        opacity: 0;
        transform: translateY(200px)
    }

    50% {
        opacity: 1;
        transform: translateY(-10px)
    }

    70% {
        transform: translateY(5px)
    }

    to {
        transform: translateY(0)
    }
}

@-webkit-keyframes iziT-bounceInUp {
    0% {
        opacity: 0;
        transform: translateY(200px)
    }

    50% {
        opacity: 1;
        transform: translateY(-10px)
    }

    70% {
        transform: translateY(5px)
    }

    to {
        transform: translateY(0)
    }
}

@-o-keyframes iziT-bounceInUp {
    0% {
        opacity: 0;
        transform: translateY(200px)
    }

    50% {
        opacity: 1;
        transform: translateY(-10px)
    }

    70% {
        transform: translateY(5px)
    }

    to {
        transform: translateY(0)
    }
}

@keyframes iziT-bounceInUp {
    0% {
        opacity: 0;
        transform: translateY(200px)
    }

    50% {
        opacity: 1;
        transform: translateY(-10px)
    }

    70% {
        transform: translateY(5px)
    }

    to {
        transform: translateY(0)
    }
}

@-moz-keyframes iziT-fadeIn {
    0% {
        opacity: 0
    }

    to {
        opacity: 1
    }
}

@-webkit-keyframes iziT-fadeIn {
    0% {
        opacity: 0
    }

    to {
        opacity: 1
    }
}

@-o-keyframes iziT-fadeIn {
    0% {
        opacity: 0
    }

    to {
        opacity: 1
    }
}

@keyframes iziT-fadeIn {
    0% {
        opacity: 0
    }

    to {
        opacity: 1
    }
}

@-moz-keyframes iziT-fadeInUp {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-webkit-keyframes iziT-fadeInUp {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-o-keyframes iziT-fadeInUp {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@keyframes iziT-fadeInUp {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-moz-keyframes iziT-fadeInDown {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, -100%, 0);
        transform: translate3d(0, -100%, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-webkit-keyframes iziT-fadeInDown {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, -100%, 0);
        transform: translate3d(0, -100%, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-o-keyframes iziT-fadeInDown {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, -100%, 0);
        transform: translate3d(0, -100%, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@keyframes iziT-fadeInDown {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, -100%, 0);
        transform: translate3d(0, -100%, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-moz-keyframes iziT-fadeInLeft {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(300px, 0, 0);
        transform: translate3d(300px, 0, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-webkit-keyframes iziT-fadeInLeft {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(300px, 0, 0);
        transform: translate3d(300px, 0, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-o-keyframes iziT-fadeInLeft {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(300px, 0, 0);
        transform: translate3d(300px, 0, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@keyframes iziT-fadeInLeft {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(300px, 0, 0);
        transform: translate3d(300px, 0, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-moz-keyframes iziT-fadeInRight {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(-300px, 0, 0);
        transform: translate3d(-300px, 0, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-webkit-keyframes iziT-fadeInRight {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(-300px, 0, 0);
        transform: translate3d(-300px, 0, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-o-keyframes iziT-fadeInRight {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(-300px, 0, 0);
        transform: translate3d(-300px, 0, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@keyframes iziT-fadeInRight {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(-300px, 0, 0);
        transform: translate3d(-300px, 0, 0)
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none
    }
}

@-moz-keyframes iziT-flipInX {
    0% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        opacity: 0
    }

    40% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -20deg)
    }

    60% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
        opacity: 1
    }

    80% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -5deg)
    }

    to {
        -webkit-transform: perspective(400px);
        transform: perspective(400px)
    }
}

@-webkit-keyframes iziT-flipInX {
    0% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        opacity: 0
    }

    40% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -20deg)
    }

    60% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
        opacity: 1
    }

    80% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -5deg)
    }

    to {
        -webkit-transform: perspective(400px);
        transform: perspective(400px)
    }
}

@-o-keyframes iziT-flipInX {
    0% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        opacity: 0
    }

    40% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -20deg)
    }

    60% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
        opacity: 1
    }

    80% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -5deg)
    }

    to {
        -webkit-transform: perspective(400px);
        transform: perspective(400px)
    }
}

@keyframes iziT-flipInX {
    0% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        opacity: 0
    }

    40% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -20deg)
    }

    60% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
        opacity: 1
    }

    80% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -5deg)
    }

    to {
        -webkit-transform: perspective(400px);
        transform: perspective(400px)
    }
}

@-moz-keyframes iziT-fadeOut {
    0% {
        opacity: 1
    }

    to {
        opacity: 0
    }
}

@-webkit-keyframes iziT-fadeOut {
    0% {
        opacity: 1
    }

    to {
        opacity: 0
    }
}

@-o-keyframes iziT-fadeOut {
    0% {
        opacity: 1
    }

    to {
        opacity: 0
    }
}

@keyframes iziT-fadeOut {
    0% {
        opacity: 1
    }

    to {
        opacity: 0
    }
}

@-moz-keyframes iziT-fadeOutDown {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0)
    }
}

@-webkit-keyframes iziT-fadeOutDown {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0)
    }
}

@-o-keyframes iziT-fadeOutDown {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0)
    }
}

@keyframes iziT-fadeOutDown {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0)
    }
}

@-moz-keyframes iziT-fadeOutUp {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(0, -100%, 0);
        transform: translate3d(0, -100%, 0)
    }
}

@-webkit-keyframes iziT-fadeOutUp {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(0, -100%, 0);
        transform: translate3d(0, -100%, 0)
    }
}

@-o-keyframes iziT-fadeOutUp {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(0, -100%, 0);
        transform: translate3d(0, -100%, 0)
    }
}

@keyframes iziT-fadeOutUp {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(0, -100%, 0);
        transform: translate3d(0, -100%, 0)
    }
}

@-moz-keyframes iziT-fadeOutLeft {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(-200px, 0, 0);
        transform: translate3d(-200px, 0, 0)
    }
}

@-webkit-keyframes iziT-fadeOutLeft {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(-200px, 0, 0);
        transform: translate3d(-200px, 0, 0)
    }
}

@-o-keyframes iziT-fadeOutLeft {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(-200px, 0, 0);
        transform: translate3d(-200px, 0, 0)
    }
}

@keyframes iziT-fadeOutLeft {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(-200px, 0, 0);
        transform: translate3d(-200px, 0, 0)
    }
}

@-moz-keyframes iziT-fadeOutRight {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(200px, 0, 0);
        transform: translate3d(200px, 0, 0)
    }
}

@-webkit-keyframes iziT-fadeOutRight {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(200px, 0, 0);
        transform: translate3d(200px, 0, 0)
    }
}

@-o-keyframes iziT-fadeOutRight {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(200px, 0, 0);
        transform: translate3d(200px, 0, 0)
    }
}

@keyframes iziT-fadeOutRight {
    0% {
        opacity: 1
    }

    to {
        opacity: 0;
        -webkit-transform: translate3d(200px, 0, 0);
        transform: translate3d(200px, 0, 0)
    }
}

@-moz-keyframes iziT-flipOutX {
    0% {
        -webkit-transform: perspective(400px);
        transform: perspective(400px)
    }

    30% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        opacity: 1
    }

    to {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        opacity: 0
    }
}

@-webkit-keyframes iziT-flipOutX {
    0% {
        -webkit-transform: perspective(400px);
        transform: perspective(400px)
    }

    30% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        opacity: 1
    }

    to {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        opacity: 0
    }
}

@-o-keyframes iziT-flipOutX {
    0% {
        -webkit-transform: perspective(400px);
        transform: perspective(400px)
    }

    30% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        opacity: 1
    }

    to {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        opacity: 0
    }
}

@keyframes iziT-flipOutX {
    0% {
        -webkit-transform: perspective(400px);
        transform: perspective(400px)
    }

    30% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
        opacity: 1
    }

    to {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
        opacity: 0
    }
}
CSS;

        File::put($iziToastJsFilePath, $code);
        File::put($iziToastMinJsFilePath, $code2);
        File::put($iziToastMinCssFilePath, $code3);

        $this->info('The iziToast.js/iziToast.min.js file has been updated successfully.');
    }
}
