<?php

namespace App\Console\Commands\Lebify\Auth\Download\Translation;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupLocalization extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:localization';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up localization for the application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Setting up localization...');

        // 1. Publish the language files
        $this->call('lang:publish');

        // 2. Require the laravel-lang/common package
        $this->info('Installing laravel-lang/common package...');
        exec('composer require --dev laravel-lang/common');

        // 3. Update the language files with the common translations
        exec('php artisan lang:update');

        // 4-6. Add French, Arabic, and Spanish language files


        // 7. Require the mcamara/laravel-localization package
        $this->info('Installing mcamara/laravel-localization package...');
        exec('composer require mcamara/laravel-localization');

        // 8. Publish the mcamara/laravel-localization package resources
        exec('php artisan vendor:publish --provider="Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider"');

        $this->info('Localization setup completed successfully!');

        // 9. Update the localization configuration file
        $this->updateKernel();

        // 10. Update the localization configuration file
        $this->updateLocalizationConfig();

        $this->createLanguageFiles_AR();
        $this->createLanguageFiles_FR();
        $this->createLanguageFiles_EN();
        exec('php artisan lang:add ar');
        exec('php artisan lang:add en');
        exec('php artisan lang:add fr');

        return 0;
    }

    /**
     * Update the localization configuration file.
     *
     * @return void
     */
    protected function updateLocalizationConfig()
    {
        $configFilePath = config_path('laravellocalization.php');
        $configFileContent = file_get_contents($configFilePath);

        // Uncomment the French and Arabic languages
        $configFileContent = preg_replace('/\/\/\s*\'fr\'\s*=>\s*\[(.*?)\],/s', "'fr' => ['name' => 'French', 'script' => 'Latn', 'native' => 'français', 'regional' => 'fr_FR'],", $configFileContent);
        $configFileContent = preg_replace('/\/\/\s*\'ar\'\s*=>\s*\[(.*?)\],/s', "'ar' => ['name' => 'Arabic', 'script' => 'Arab', 'native' => 'العربية', 'regional' => 'ar_AE'],", $configFileContent);

        // Comment out the Spanish language
        $configFileContent = preg_replace('/\'es\'\s*=>\s*\[(.*?)\],/s', "// 'es' => $1,", $configFileContent);

        // Write the updated content back to the configuration file
        file_put_contents($configFilePath, $configFileContent);

        $this->info('Localization configuration updated.');
    }

    /**
     * Update the Kernel.php file with the middleware aliases.
     *
     * @return void
     */
    protected function updateKernel()
    {
        $kernelFilePath = app_path('Http/Kernel.php');
        $kernelFileContent = file_get_contents($kernelFilePath);

        // Add the middleware aliases
        $middlewareAliasesPattern = '/protected \$middlewareAliases = \[(.*?)\];/s';
        $middlewareAliasesReplacement = 'protected $middlewareAliases = [$1' . PHP_EOL . '    /**** LOCALIZATION MIDDLEWARE ****/' . PHP_EOL . '    \'localize\' => \\Mcamara\\LaravelLocalization\\Middleware\\LaravelLocalizationRoutes::class,' . PHP_EOL . '    \'localizationRedirect\' => \\Mcamara\\LaravelLocalization\\Middleware\\LaravelLocalizationRedirectFilter::class,' . PHP_EOL . '    \'localeSessionRedirect\' => \\Mcamara\\LaravelLocalization\\Middleware\\LocaleSessionRedirect::class,' . PHP_EOL . '    \'localeCookieRedirect\' => \\Mcamara\\LaravelLocalization\\Middleware\\LocaleCookieRedirect::class,' . PHP_EOL . '    \'localeViewPath\' => \\Mcamara\\LaravelLocalization\\Middleware\\LaravelLocalizationViewPath::class,' . PHP_EOL . '];';

        // Remove the trailing comma from the 'verified' middleware
        $kernelFileContent = preg_replace('/,(\s*\/\*\*\*\* LOCALIZATION MIDDLEWARE \*\*\*\*)/', '$1', $kernelFileContent);

        $kernelFileContent = preg_replace($middlewareAliasesPattern, $middlewareAliasesReplacement, $kernelFileContent);

        // Write the updated content back to the Kernel.php file
        file_put_contents($kernelFilePath, $kernelFileContent);

        $this->info('Kernel.php file updated with middleware aliases.');
    }

    protected function createLanguageFiles_AR()
    {
        $langPath = base_path('lang/ar');

        // Create the 'ar' directory if it doesn't exist
        if (!is_dir($langPath)) {
            mkdir($langPath, 0755, true);
        }

        // Create the language files
        $files = [
            'auth.php' => "<?php\n\nreturn [
                \n    // Arabic translations for authentication\n
                'failed' => 'هذه البيانات لا تتطابق مع سجلاتنا.',
                'password' => 'كلمة المرور المقدمة غير صحيحة.',
                'throttle' => 'عدد محاولات تسجيل الدخول كثيرة جدًا. يرجى المحاولة مرة أخرى بعد :seconds ثانية.',

                // COMMON
                'not_a_member' => 'لست عضوًا بعد؟',
                'entrance_point' => 'نقطة الدخول',
                'sign_up' => 'التسجيل',
                'explore_a_sanctuary' => 'استكشف ملاذًا للدعم. قم بتسجيل الدخول للحصول على اتصالات تتسم بالتعاطف ومجتمع رعاية.',
                'forget_password' => 'هل نسيت كلمة المرور؟',
                'or' => 'أو',
                'already_have_account' => 'هل لديك حساب بالفعل؟',
                'join_now' => 'انضم الآن',
                'dive_into_our_community' => 'انغمس في مجتمعنا الديناميكي، حيث يبدأ كل رحلة.',
                'use_8_character' => 'استخدم ٨ أحرف أو أكثر مع مزيج من الحروف والأرقام والرموز.',
                'register' => 'تسجيل',
                'enter_reset_email' => 'أدخل بريدك الإلكتروني لإعادة تعيين كلمة المرور.',
                'send_pass' => 'ارسال رابط',
                'reset_password' => 'إعادة تعيين كلمة المرور',
                'setup_new_password' => 'إعداد كلمة مرور جديدة',
                'Has_reset_password' => 'هل تمت إعادة تعيين كلمة المرور بنجاح؟',
                'email_verification' => 'تأكيد البريد الإلكتروني',
                'access_features' => 'قبل الوصول إلى جميع الميزات، يرجى التحقق من بريدك الإلكتروني للعثور على رابط التحقق الذي ينتظر تأكيدك.',
                'send_verification_email' => 'إعادة إرسال بريد التحقق',
                'Verification_email_sent' => 'تم إرسال بريد التحقق، يرجى التحقق من بريدك الإلكتروني.',

            ];",
            'passwords.php' => "<?php\n\nreturn [\n
                // Arabic translations for password reset\n
                'reset' => 'تم إعادة تعيين كلمة المرور الخاصة بك.',
                'sent' => 'لقد قمنا بإرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني.',
                'throttled' => 'الرجاء الانتظار قبل المحاولة مرة أخرى.',
                'token' => 'رمز إعادة تعيين كلمة المرور هذا غير صالح.',
                'user' => 'لا يمكننا العثور على مستخدم بهذا البريد الإلكتروني.',
            ];",
            'common.php' => "<?php\n\nreturn[\n
            'english' => 'الإنجليزية',
            'french' => 'الفرنسية',
            'arabic' => 'العربية',
            'language' => 'اللغة',

            'cancel' => 'إلغاء',
            'save'   => 'حفظ',
            'close'  => 'إغلاق',
            'update' => 'تحديث',
            'edit'   => 'تعديل',
            'delete' => 'حذف',
            'add'    => 'إضافة',
            'create' => 'إنشاء',
            'view'   => 'عرض',
            'browse' => 'تصفح',
            'import' => 'استيراد',
            'export' => 'تصدير',
            'upload' => 'تحميل',
            'upload_file' => 'تحميل ملف',
            'upload_image' => 'تحميل صورة',
            'upload_files' => 'تحميل ملفات',
            'upload_images' => 'تحميل صور',
            'upload_file_or_image' => 'تحميل ملف أو صورة',
            'upload_files_or_images' => 'تحميل ملفات أو صور',
            'upload_file_or_images' => 'تحميل ملف أو صور',
            'upload_files_or_file' => 'تحميل ملفات أو ملف',
            'upload_images_or_image' => 'تحميل صور أو صورة',
            'upload_images_or_images' => 'تحميل صور أو صور',
            'upload_images_or_files' => 'تحميل صور أو ملفات',
            'upload_images_or_file' => 'تحميل صور أو ملف',
            'upload_file_or_files' => 'تحميل ملف أو ملفات',
            'retry'  => 'إعادة المحاولة',
            'back'   => 'عودة',
            'finish' => 'انتهاء',
            'apply'  => 'تطبيق',

            // REGISTER/LOGIN
    'email' => 'البريد الإلكتروني',
    'password' => 'كلمة المرور',
    'confirm_password' => 'تأكيد كلمة المرور',
    'full_name' => 'الاسم الكامل',
    'sending' => 'جاري الارسال...',
    'loggingin' => 'يتم الدخول...',
    'registering' => 'يتم التسجيل...',
    'reseting' => 'جاري إعادة تعيين كلمة المرور...'
        ];",
        ];

        foreach ($files as $fileName => $fileContent) {
            $filePath = $langPath . '/' . $fileName;

            // Create the file if it doesn't exist
            if (!file_exists($filePath)) {
                file_put_contents($filePath, $fileContent);
                $this->info("Created language file: {$filePath}");
            } else {
                $this->info("Language file already exists: {$filePath}");
            }
        }

        // Update the validation.php file
        $validationFilePath = $langPath . '/validation.php';
        $validationTranslations = [
            'accepted'             => 'يجب قبول :attribute.',
            'accepted_if'          => 'يجب قبول :attribute عندما يكون :other هو :value.',
            'active_url'           => 'يجب أن يكون :attribute عنوان URL صالحًا.',
            'after'                => 'يجب أن يكون :attribute تاريخًا بعد :date.',
            'after_or_equal'       => 'يجب أن يكون :attribute تاريخًا بعد أو يساوي :date.',
            'alpha'                => 'يجب أن يحتوي :attribute على أحرف فقط.',
            'alpha_dash'           => 'يجب أن يحتوي :attribute على أحرف وأرقام وشرطات وشرطات تحتية فقط.',
            'alpha_num'            => 'يجب أن يحتوي :attribute على أحرف وأرقام فقط.',
            'array'                => 'يجب أن يكون :attribute مصفوفة.',
            'before'               => 'يجب أن يكون :attribute تاريخًا قبل :date.',
            'before_or_equal'      => 'يجب أن يكون :attribute تاريخًا قبل أو يساوي :date.',
            'between'              => [
                'array'   => 'يجب أن يحتوي :attribute بين :min و :max عنصر.',
                'file'    => 'يجب أن يكون حجم :attribute بين :min و :max كيلوبايت.',
                'numeric' => 'يجب أن يكون :attribute بين :min و :max.',
                'string'  => 'يجب أن يكون :attribute بين :min و :max حرف.',
            ],
            'boolean'              => 'يجب أن يكون :attribute صحيحًا أو خاطئًا.',
            'confirmed'            => 'لا يتطابق تأكيد :attribute.',
            'date'                 => 'يجب أن يكون :attribute تاريخًا صحيحًا.',
            'date_equals'          => 'يجب أن يكون :attribute تاريخًا مساويًا ل :date.',
            'date_format'          => 'لا يتطابق :attribute مع الشكل :format.',
            'different'            => 'يجب أن يكون :attribute و :other مختلفين.',
            'digits'               => 'يجب أن يكون :attribute :digits أرقام.',
            'digits_between'       => 'يجب أن يكون :attribute بين :min و :max أرقام.',
            'dimensions'           => 'الصورة :attribute غير صالحة.',
            'distinct'             => 'يحتوي حقل :attribute على قيمة مكررة.',
            'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيحًا.',
            'ends_with'            => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values.',
            'exists'               => 'القيمة المحددة لـ :attribute غير صالحة.',
            'file'                 => 'يجب أن يكون :attribute ملفًا.',
            'filled'               => 'يجب أن يحتوي حقل :attribute على قيمة.',
            'gt'                   => [
                'array'   => 'يجب أن يحتوي :attribute على أكثر من :value عنصر.',
                'file'    => 'يجب أن يكون حجم :attribute أكبر من :value كيلوبايت.',
                'numeric' => 'يجب أن يكون :attribute أكبر من :value.',
                'string'  => 'يجب أن يحتوي :attribute على أكثر من :value حرف.',
            ],
            'gte'                  => [
                'array'   => 'يجب أن يحتوي :attribute على :value عنصر أو أكثر.',
                'file'    => 'يجب أن يكون حجم :attribute أكبر من أو يساوي :value كيلوبايت.',
                'numeric' => 'يجب أن يكون :attribute أكبر من أو يساوي :value.',
                'string'  => 'يجب أن يحتوي :attribute على :value حرف أو أكثر.',
            ],
            'image'                => 'يجب أن يكون :attribute صورة.',
            'in'                   => 'القيمة المحددة لـ :attribute غير صالحة.',
            'in_array'             => 'القيمة المحددة لـ :attribute غير موجودة في :other.',
            'integer'              => 'يجب أن يكون :attribute عددًا صحيحًا.',
            'ip'                   => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
            'ipv4'                 => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
            'ipv6'                 => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
            'json'                 => 'يجب أن يكون :attribute نص JSON صالحًا.',
            'lt'                   => [
                'array'   => 'يجب أن يحتوي :attribute على أقل من :value عنصر.',
                'file'    => 'يجب أن يكون حجم :attribute أقل من :value كيلوبايت.',
                'numeric' => 'يجب أن يكون :attribute أقل من :value.',
                'string'  => 'يجب أن يحتوي :attribute على أقل من :value حرف.',
            ],
            'lte'                  => [
                'array'   => 'يجب أن يحتوي :attribute على :value عنصر أو أقل.',
                'file'    => 'يجب أن يكون حجم :attribute أقل من أو يساوي :value كيلوبايت.',
                'numeric' => 'يجب أن يكون :attribute أقل من أو يساوي :value.',
                'string'  => 'يجب أن يحتوي :attribute على :value حرف أو أقل.',
            ],
            'max'                  => [
                'array'   => 'قد لا يحتوي :attribute على أكثر من :max عنصر.',
                'file'    => 'قد لا يكون حجم :attribute أكبر من :max كيلوبايت.',
                'numeric' => 'قد لا يكون :attribute أكبر من :max.',
                'string'  => 'قد لا يكون :attribute أكبر من :max حرف.',
            ],
            'mimes'                => 'يجب أن يكون :attribute ملف من النوع: :values.',
            'min'                  => [
                'array'   => 'يجب أن يحتوي :attribute على الأقل على :min عنصر.',
                'file'    => 'يجب أن يكون حجم :attribute على الأقل :min كيلوبايت.',
                'numeric' => 'يجب أن يكون :attribute على الأقل :min.',
                'string'  => 'يجب أن يكون :attribute على الأقل :min حرف.',
            ],
            'not_in'               => 'القيمة المحددة لـ :attribute غير صالحة.',
            'not_regex'            => 'الصيغة المحددة لـ :attribute غير صالحة.',
            'numeric'              => 'يجب أن يكون :attribute رقمًا.',
            'password'             => 'كلمة المرور غير صحيحة.',
            'present'              => 'يجب أن يكون حقل :attribute موجودًا.',
            'regex'                => 'الصيغة المحددة لـ :attribute غير صالحة.',
            'required'             => 'يجب تعبئة حقل :attribute.',
            'required_if'          => 'يجب تعبئة حقل :attribute عندما يكون :other هو :value.',
            'required_unless'      => 'يجب تعبئة حقل :attribute ما لم يكن :other في :values.',
            'required_with'        => 'يجب تعبئة حقل :attribute عندما يكون :values موجودًا.',
            'required_with_all'    => 'يجب تعبئة حقل :attribute عندما يكون :values موجودًا.',
            'required_without'     => 'يجب تعبئة حقل :attribute عندما لا يكون :values موجودًا.',
            'required_without_all' => 'يجب تعبئة حقل :attribute عندما لا يكون أي من :values موجودًا.',
            'same'                 => 'يجب أن يتطابق :attribute و :other.',
            'size'                 => [
                'array'   => 'يجب أن يحتوي :attribute على :size عنصر.',
                'file'    => 'يجب أن يكون حجم :attribute :size كيلوبايت.',
                'numeric' => 'يجب أن يكون :attribute :size.',
                'string'  => 'يجب أن يكون :attribute :size حرف.',
            ],
            'starts_with'          => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values.',
            'string'               => 'يجب أن يكون :attribute نصًا.',
            'timezone'             => 'يجب أن يكون :attribute منطقة زمنية صحيحة.',
            'unique'               => 'قيمة :attribute مُستخدمة مسبقًا.',
            'uploaded'             => 'فشل في تحميل :attribute.',
            'url'                  => 'الصيغة غير صحيحة لـ :attribute.',

            'attributes' => [
                'address'                  => 'العنوان',
                'affiliate_url'            => 'رابط الأفلييت',
                'age'                      => 'العمر',
                'amount'                   => 'الكمية',
                'announcement'             => 'إعلان',
                'area'                     => 'المنطقة',
                'audience_prize'           => 'جائزة الجمهور',
                'available'                => 'مُتاح',
                'birthday'                 => 'عيد الميلاد',
                'body'                     => 'المُحتوى',
                'city'                     => 'المدينة',
                'compilation'              => 'التحويل البرمجي',
                'concept'                  => 'مفهوم',
                'conditions'               => 'شروط',
                'content'                  => 'المُحتوى',
                'country'                  => 'الدولة',
                'cover'                    => 'الغلاف',
                'created_at'               => 'تاريخ الإضافة',
                'creator'                  => 'المنشئ',
                'currency'                 => 'العملة',
                'current_password'         => 'كلمة المرور الحالية',
                'customer'                 => 'عميل',
                'date'                     => 'التاريخ',
                'date_of_birth'            => 'تاريخ الميلاد',
                'dates'                    => 'التواريخ',
                'day'                      => 'اليوم',
                'deleted_at'               => 'تاريخ الحذف',
                'description'              => 'الوصف',
                'display_type'             => 'نوع العرض',
                'district'                 => 'الحي',
                'duration'                 => 'المدة',
                'email'                    => 'البريد الالكتروني',
                'excerpt'                  => 'المُلخص',
                'filter'                   => 'تصفية',
                'finished_at'              => 'تاريخ الانتهاء',
                'first_name'               => 'الاسم الأول',
                'gender'                   => 'النوع',
                'grand_prize'              => 'الجائزة الكبرى',
                'group'                    => 'مجموعة',
                'hour'                     => 'ساعة',
                'image'                    => 'صورة',
                'image_desktop'            => 'صورة سطح المكتب',
                'image_main'               => 'الصورة الرئيسية',
                'image_mobile'             => 'صورة الجوال',
                'images'                   => 'الصور',
                'is_audience_winner'       => 'الجمهور الفائز',
                'is_hidden'                => 'مخفي',
                'is_subscribed'            => 'مشترك',
                'is_visible'               => 'مرئي',
                'is_winner'                => 'الفائز',
                'items'                    => 'العناصر',
                'key'                      => 'مفتاح',
                'last_name'                => 'اسم العائلة',
                'lesson'                   => 'الدرس',
                'line_address_1'           => 'العنوان 1',
                'line_address_2'           => 'العنوان 2',
                'login'                    => 'تسجيل الدخول',
                'message'                  => 'الرسالة',
                'middle_name'              => 'الاسم الأوسط',
                'minute'                   => 'دقيقة',
                'mobile'                   => 'الجوال',
                'month'                    => 'الشهر',
                'name'                     => 'الاسم',
                'national_code'            => 'الرمز الدولي',
                'number'                   => 'الرقم',
                'password'                 => 'كلمة المرور',
                'password_confirmation'    => 'تأكيد كلمة المرور',
                'phone'                    => 'الهاتف',
                'photo'                    => 'الصورة',
                'portfolio'                => 'ملف',
                'postal_code'              => 'الرمز البريدي',
                'preview'                  => 'معاينة',
                'price'                    => 'السعر',
                'product_id'               => 'معرف المنتج',
                'product_uid'              => 'معرف المنتج',
                'product_uuid'             => 'معرف المنتج',
                'promo_code'               => 'رمز ترويجي',
                'province'                 => 'المحافظة',
                'quantity'                 => 'الكمية',
                'reason'                   => 'سبب',
                'recaptcha_response_field' => 'حقل استجابة recaptcha',
                'referee'                  => 'حكَم',
                'referees'                 => 'حكّام',
                'reject_reason'            => 'سبب الرفض',
                'remember'                 => 'تذكير',
                'restored_at'              => 'تاريخ الاستعادة',
                'result_text_under_image'  => 'نص النتيجة أسفل الصورة',
                'role'                     => 'الصلاحية',
                'rule'                     => 'قاعدة',
                'rules'                    => 'قواعد',
                'second'                   => 'ثانية',
                'sex'                      => 'الجنس',
                'shipment'                 => 'الشحنة',
                'short_text'               => 'نص مختصر',
                'size'                     => 'الحجم',
                'skills'                   => 'مهارات',
                'slug'                     => 'نص صديق',
                'specialization'           => 'تخصص',
                'started_at'               => 'تاريخ الابتداء',
                'state'                    => 'الولاية',
                'status'                   => 'حالة',
                'street'                   => 'الشارع',
                'student'                  => 'طالب',
                'subject'                  => 'الموضوع',
                'tag'                      => 'علامة',
                'tags'                     => 'العلامات',
                'teacher'                  => 'معلّم',
                'terms'                    => 'الأحكام',
                'test_description'         => 'وصف الاختبار',
                'test_locale'              => 'لغة الاختبار',
                'test_name'                => 'اسم الاختبار',
                'text'                     => 'نص',
                'time'                     => 'الوقت',
                'title'                    => 'اللقب',
                'type'                     => 'يكتب',
                'updated_at'               => 'تاريخ التحديث',
                'user'                     => 'مستخدم',
                'username'                 => 'اسم المُستخدم',
                'value'                    => 'قيمة',
                'year'                     => 'السنة',
            ],
        ];

        if (file_exists($validationFilePath)) {
            // Read the existing validation.php file
            $existingTranslations = require $validationFilePath;

            // Merge the new translations with the existing ones
            $validationTranslations = array_merge($existingTranslations, $validationTranslations);
        }

        // Convert the updated array to a string representation
        $validationFileContent = "<?php\n\nreturn " . $this->arrayToString($validationTranslations) . ";";

        // Write the updated content back to the validation.php file
        file_put_contents($validationFilePath, $validationFileContent);

        $this->info('Updated validation.php file with new translations.');
    }

    protected function createLanguageFiles_FR()
    {
        $langPath = base_path('lang/fr');

        // Create the 'ar' directory if it doesn't exist
        if (!is_dir($langPath)) {
            mkdir($langPath, 0755, true);
        }

        // Create the language files
        $files = [
            'auth.php' => "<?php\n\nreturn [
                \n    // French translations for authentication\n
                'failed' => 'Ces informations d\'identification ne correspondent pas à nos dossiers.',
                'password' => 'Le mot de passe fourni est incorrect.',
                'throttle' => 'Trop de tentatives de connexion. Veuillez réessayer dans :seconds secondes.',
                // COMMON
                'not_a_member' => 'Pas encore membre?',
                'entrance_point' => 'Point d\'entrée',
                ' sign_up' => 'Créer un compte',
                'explore_a_sanctuary' => 'Explorez un sanctuaire de soutien. Connectez-vous pour des connexions empathiques et une communauté attentionnée.',
                'forget_password' => 'Mot de passe oublié?',
                'or' => 'Ou',
                'already_have_account' => 'Vous avez déjà un compte?',
                'join_now' => 'joignez maintenant',
                'dive_into_our_community' => 'Plongez dans notre communauté dynamique, où chaque voyage commence.',
                'use_8_character' => 'Utilisez 8 caractères ou plus avec un mélange de lettres, de chiffres et de symboles.',
                'register' => 'S\'inscrire',
                'enter_reset_email' => 'Entrez votre adresse e-mail pour réinitialiser votre mot de passe.',
                'send_pass' => 'envoyer une lien',
                'reset_password' => 'Réinitialiser le mot de passe',
                'setup_new_password' => 'Nouveau mot de passe',
                'Has_reset_password' => 'Votre mot de passe a-t-il été réinitialisé avec succès?',
                'email_verification' => 'Vérification de l\'adresse e-mail',
                'access_features' => 'Avant d\'accéder à toutes les fonctionnalités, veuillez vérifier votre e-mail pour trouver le lien de vérification en attente de votre confirmation.',
                'send_verification_email' => 'Renvoyer l\'\e-mail de vérification',
                'Verification_email_sent' => 'E-mail de vérification envoyé, veuillez vérifier votre boîte de réception.',

            ];",
            'pagination.php' => "<?php\n\nreturn [
                \n    // French translations for pagination\n
                'previous' => '&laquo; Précédent',
                'next' => 'Suivant &raquo;',
        ];",
            'passwords.php' => "<?php\n\nreturn [\n
                // French translations for password reset\n
                'reset' => 'Votre mot de passe a été réinitialisé.',
                'sent' => 'Nous avons envoyé par e-mail votre lien de réinitialisation de mot de passe.',
                'throttled' => 'Veuillez patienter avant de réessayer.',
                'token' => 'Ce jeton de réinitialisation de mot de passe est invalide.',
                'user' => 'Nous ne pouvons pas trouver un utilisateur avec cette adresse e-mail.',
            ];",
            'common.php' => "<?php\n\nreturn [\n
            'english' => 'Anglais',
            'french' => 'Français',
            'arabic' => 'Arabe',
            'language' => 'La langue',

            'cancel' => 'Annuler',
            'save'   => 'Enregistrer',
            'close'  => 'Fermer',
            'update' => 'Mettre à jour',
            'edit'   => 'Modifier',
            'delete' => 'Supprimer',
            'add'    => 'Ajouter',
            'create' => 'Créer',
            'view'   => 'Voir',
            'browse' => 'Parcourir',
            'import' => 'Importer',
            'export' => 'Exporter',
            'upload' => 'Télécharger',
            'upload_file' => 'Télécharger un fichier',
            'upload_image' => 'Télécharger une image',
            'upload_files' => 'Télécharger des fichiers',
            'upload_images' => 'Télécharger des images',
            'upload_file_or_image' => 'Télécharger un fichier ou une image',
            'upload_files_or_images' => 'Télécharger des fichiers ou des images',
            'upload_file_or_images' => 'Télécharger un fichier ou des images',
            'upload_files_or_file' => 'Télécharger des fichiers ou un fichier',
            'upload_images_or_image' => 'Télécharger des images ou une image',
            'upload_images_or_images' => 'Télécharger des images ou des images',
            'upload_images_or_files' => 'Télécharger des images ou des fichiers',
            'upload_images_or_file' => 'Télécharger des images ou un fichier',
            'upload_file_or_files' => 'Télécharger un fichier ou des fichiers',
            'retry'  => 'Réessayer',
            'back'   => 'Retour',
            'finish' => 'Terminer',
            'apply'  => 'Appliquer',

            // REGISTER/LOGIN
    'email' => 'E-mail',
    'password' => 'Mot de passe',
    'confirm_password' => 'Confirmez le mot de passe',
    'full_name' => 'Nom complet',
    'sending' => 'Envoi en cours',
    'loggingin' => 'Connexion en cours...',
    'registering' => 'Enregistrement en cours...',
    'reseting' => 'Réinitialisation en cours...',
            ];",
        ];

        foreach ($files as $fileName => $fileContent) {
            $filePath = $langPath . '/' . $fileName;

            // Create the file if it doesn't exist
            if (!file_exists($filePath)) {
                file_put_contents($filePath, $fileContent);
                $this->info("Created language file: {$filePath}");
            } else {
                $this->info("Language file already exists: {$filePath}");
            }
        }

        // Update the validation.php file
        $validationFilePath = $langPath . '/validation.php';
        $validationTranslations = [
            'accepted'             => 'Le champ :attribute doit être accepté.',
            'accepted_if'          => 'Le champ :attribute doit être accepté lorsque :other est :value.',
            'active_url'           => 'Le champ :attribute n\'est pas une URL valide.',
            'after'                => 'Le champ :attribute doit être une date postérieure au :date.',
            'after_or_equal'       => 'Le champ :attribute doit être une date postérieure ou égale au :date.',
            'alpha'                => 'Le champ :attribute ne doit contenir que des lettres.',
            'alpha_dash'           => 'Le champ :attribute ne doit contenir que des lettres, des chiffres, des tirets et des underscores.',
            'alpha_num'            => 'Le champ :attribute ne doit contenir que des chiffres et des lettres.',
            'array'                => 'Le champ :attribute doit être un tableau.',
            'before'               => 'Le champ :attribute doit être une date antérieure au :date.',
            'before_or_equal'      => 'Le champ :attribute doit être une date antérieure ou égale au :date.',
            'between'              => [
                'array'   => 'Le champ :attribute doit avoir entre :min et :max éléments.',
                'file'    => 'Le champ :attribute doit être compris entre :min et :max kilo-octets.',
                'numeric' => 'Le champ :attribute doit être compris entre :min et :max.',
                'string'  => 'Le champ :attribute doit être compris entre :min et :max caractères.',
            ],
            'boolean'              => 'Le champ :attribute doit être vrai ou faux.',
            'confirmed'            => 'La confirmation du champ :attribute ne correspond pas.',
            'date'                 => 'Le champ :attribute n\'est pas une date valide.',
            'date_equals'          => 'Le champ :attribute doit être une date égale à :date.',
            'date_format'          => 'Le champ :attribute ne correspond pas au format :format.',
            'different'            => 'Les champs :attribute et :other doivent être différents.',
            'digits'               => 'Le champ :attribute doit comporter :digits chiffres.',
            'digits_between'       => 'Le champ :attribute doit avoir entre :min et :max chiffres.',
            'dimensions'           => 'Le champ :attribute a des dimensions d\'image non valides.',
            'distinct'             => 'Le champ :attribute a une valeur en double.',
            'email'                => 'Le champ :attribute doit être une adresse e-mail valide.',
            'ends_with'            => 'Le champ :attribute doit se terminer par une des valeurs suivantes : :values.',
            'exists'               => 'Le champ :attribute sélectionné est invalide.',
            'file'                 => 'Le champ :attribute doit être un fichier.',
            'filled'               => 'Le champ :attribute doit avoir une valeur.',
            'gt'                   => [
                'array'   => 'Le champ :attribute doit avoir plus de :value éléments.',
                'file'    => 'Le champ :attribute doit être supérieur à :value kilo-octets.',
                'numeric' => 'Le champ :attribute doit être supérieur à :value.',
                'string'  => 'Le champ :attribute doit contenir plus de :value caractères.',
            ],
            'gte'                  => [
                'array'   => 'Le champ :attribute doit avoir au moins :value éléments.',
                'file'    => 'Le champ :attribute doit être supérieur ou égal à :value kilo-octets.',
                'numeric' => 'Le champ :attribute doit être supérieur ou égal à :value.',
                'string'  => 'Le champ :attribute doit contenir au moins :value caractères.',
            ],
            'image'                => 'Le champ :attribute doit être une image.',
            'in'                   => 'Le champ :attribute sélectionné est invalide.',
            'in_array'             => 'Le champ :attribute n\'existe pas dans :other.',
            'integer'              => 'Le champ :attribute doit être un entier.',
            'ip'                   => 'Le champ :attribute doit être une adresse IP valide.',
            'ipv4'                 => 'Le champ :attribute doit être une adresse IPv4 valide.',
            'ipv6'                 => 'Le champ :attribute doit être une adresse IPv6 valide.',
            'json'                 => 'Le champ :attribute doit être une chaîne JSON valide.',
            'lt'                   => [
                'array'   => 'Le champ :attribute doit avoir moins de :value éléments.',
                'file'    => 'Le champ :attribute doit être inférieur à :value kilo-octets.',
                'numeric' => 'Le champ :attribute doit être inférieur à :value.',
                'string'  => 'Le champ :attribute doit contenir moins de :value caractères.',
            ],
            'lte'                  => [
                'array'   => 'Le champ :attribute ne doit pas avoir plus de :value éléments.',
                'file'    => 'Le champ :attribute doit être inférieur ou égal à :value kilo-octets.',
                'numeric' => 'Le champ :attribute doit être inférieur ou égal à :value.',
                'string'  => 'Le champ :attribute ne doit pas contenir plus de :value caractères.',
            ],
            'max'                  => [
                'array'   => 'Le champ :attribute ne peut pas avoir plus de :max éléments.',
                'file'    => 'Le champ :attribute ne peut pas être supérieur à :max kilo-octets.',
                'numeric' => 'Le champ :attribute ne peut pas être supérieur à :max.',
                'string'  => 'Le champ :attribute ne peut pas être supérieur à :max caractères.',
            ],
            'mimes'                => 'Le champ :attribute doit être un fichier de type : :values.',
            'min'                  => [
                'array'   => 'Le champ :attribute doit avoir au moins :min éléments.',
                'file'    => 'Le champ :attribute doit être d\'au moins :min kilo-octets.',
                'numeric' => 'Le champ :attribute doit être d\'au moins :min.',
                'string'  => 'Le champ :attribute doit contenir au moins :min caractères.',
            ],
            'not_in'               => 'Le champ :attribute sélectionné est invalide.',
            'not_regex'            => 'Le format du champ :attribute est invalide.',
            'numeric'              => 'Le champ :attribute doit être un nombre.',
            'password'             => [
                'letters'       => 'Le champ :attribute doit contenir au moins une lettre.',
                'mixed'         => 'Le champ :attribute doit contenir au moins une lettre et un chiffre.',
                'numbers'       => 'Le champ :attribute doit contenir au moins un chiffre.',
                'symbols'       => 'Le champ :attribute doit contenir au moins un caractère spécial.',
                'uncompromised' => 'Le mot de passe fourni a été compromis et ne peut pas être utilisé. Veuillez en choisir un autre.',
            ],
            'present'              => 'Le champ :attribute doit être présent.',
            'regex'                => 'Le format du champ :attribute est invalide.',
            'required'             => 'Le champ :attribute est requis.',
            'required_if'          => 'Le champ :attribute est requis lorsque :other est :value.',
            'required_unless'      => 'Le champ :attribute est requis sauf si :other est :values.',
            'required_with'        => 'Le champ :attribute est requis lorsque :values est présent.',
            'required_with_all'    => 'Le champ :attribute est requis lorsque :values sont présents.',
            'required_without'     => 'Le champ :attribute est requis lorsque :values n\'est pas présent.',
            'required_without_all' => 'Le champ :attribute est requis lorsqu\'aucun des :values ne sont présents.',
            'same'                 => 'Les champs :attribute et :other doivent correspondre.',
            'size'                 => [
                'array'   => 'Le champ :attribute doit contenir :size éléments.',
                'file'    => 'Le champ :attribute doit être de :size kilo-octets.',
                'numeric' => 'Le champ :attribute doit être de :size.',
                'string'  => 'Le champ :attribute doit être de :size caractères.',
            ],
            'starts_with'          => 'Le champ :attribute doit commencer par une des valeurs suivantes : :values.',
            'string'               => 'Le champ :attribute doit être une chaîne de caractères.',
            'timezone'             => 'Le champ :attribute doit être un fuseau horaire valide.',
            'unique'               => 'La valeur du champ :attribute est déjà utilisée.',
            'uploaded'             => 'Le fichier du champ :attribute n\'a pu être téléversé.',
            'url'                  => 'Le format de l\'URL du champ :attribute n\'est pas valide.',

            'attributes' => [
                'address'                  => 'adresse',
                'affiliate_url'            => 'URL d\'affiliation',
                'age'                      => 'âge',
                'amount'                   => 'montant',
                'announcement'             => 'annonce',
                'area'                     => 'zone',
                'audience_prize'           => 'prix du public',
                'available'                => 'disponible',
                'birthday'                 => 'anniversaire',
                'body'                     => 'corps',
                'city'                     => 'ville',
                'compilation'              => 'compilation',
                'concept'                  => 'concept',
                'conditions'               => 'conditions',
                'content'                  => 'contenu',
                'country'                  => 'pays',
                'cover'                    => 'couverture',
                'created_at'               => 'créé à',
                'creator'                  => 'créateur',
                'currency'                 => 'devise',
                'current_password'         => 'mot de passe actuel',
                'customer'                 => 'client',
                'date'                     => 'Date',
                'date_of_birth'            => 'date de naissance',
                'dates'                    => 'Rendez-vous',
                'day'                      => 'jour',
                'deleted_at'               => 'supprimé à',
                'description'              => 'la description',
                'display_type'             => 'Type d\'affichage',
                'district'                 => 'quartier',
                'duration'                 => 'durée',
                'email'                    => 'adresse e-mail',
                'excerpt'                  => 'extrait',
                'filter'                   => 'filtre',
                'finished_at'              => 'terminé à',
                'first_name'               => 'prénom',
                'gender'                   => 'genre',
                'grand_prize'              => 'grand prize',
                'group'                    => 'groupe',
                'hour'                     => 'heure',
                'image'                    => 'image',
                'image_desktop'            => 'image de bureau',
                'image_main'               => 'image principale',
                'image_mobile'             => 'image mobile',
                'images'                   => 'images',
                'is_audience_winner'       => 'est le gagnant du public',
                'is_hidden'                => 'est caché',
                'is_subscribed'            => 'est abonné',
                'is_visible'               => 'est visible',
                'is_winner'                => 'est gagnant',
                'items'                    => 'articles',
                'key'                      => 'clé',
                'last_name'                => 'nom',
                'lesson'                   => 'leçon',
                'line_address_1'           => 'ligne d\'adresse 1',
                'line_address_2'           => 'ligne d\'adresse 2',
                'login'                    => 'se connecter',
                'message'                  => 'message',
                'middle_name'              => 'deuxième prénom',
                'minute'                   => 'minute',
                'mobile'                   => 'portable',
                'month'                    => 'mois',
                'name'                     => 'nom',
                'national_code'            => 'code national',
                'number'                   => 'numéro',
                'password'                 => 'mot de passe',
                'password_confirmation'    => 'confirmation du mot de passe',
                'phone'                    => 'téléphone',
                'photo'                    => 'photo',
                'portfolio'                => 'portefeuille',
                'postal_code'              => 'code postal',
                'preview'                  => 'Aperçu',
                'price'                    => 'prix',
                'product_id'               => 'identifiant du produit',
                'product_uid'              => 'UID du produit',
                'product_uuid'             => 'UUID du produit',
                'promo_code'               => 'code promo',
                'province'                 => 'région',
                'quantity'                 => 'quantité',
                'reason'                   => 'raison',
                'recaptcha_response_field' => 'champ de réponse recaptcha',
                'referee'                  => 'arbitre',
                'referees'                 => 'arbitres',
                'reject_reason'            => 'motif de rejet',
                'remember'                 => 'se souvenir',
                'restored_at'              => 'restauré à',
                'result_text_under_image'  => 'texte de résultat sous l\'image',
                'role'                     => 'rôle',
                'rule'                     => 'règle',
                'rules'                    => 'règles',
                'second'                   => 'seconde',
                'sex'                      => 'sexe',
                'shipment'                 => 'expédition',
                'short_text'               => 'texte court',
                'size'                     => 'taille',
                'skills'                   => 'compétences',
                'slug'                     => 'limace',
                'specialization'           => 'spécialisation',
                'started_at'               => 'commencé à',
                'state'                    => 'état',
                'status'                   => 'statut',
                'street'                   => 'rue',
                'student'                  => 'étudiant',
                'subject'                  => 'sujet',
                'tag'                      => 'étiqueter',
                'tags'                     => 'Mots clés',
                'teacher'                  => 'professeur',
                'terms'                    => 'conditions',
                'test_description'         => 'description test',
                'test_locale'              => 'localisation test',
                'test_name'                => 'nom test',
                'text'                     => 'texte',
                'time'                     => 'heure',
                'title'                    => 'titre',
                'type'                     => 'taper',
                'updated_at'               => 'mis à jour à',
                'user'                     => 'utilisateur',
                'username'                 => 'nom d\'utilisateur',
                'value'                    => 'valeur',
                'year'                     => 'année',
            ],
        ];

        if (file_exists($validationFilePath)) {
            // Read the existing validation.php file
            $existingTranslations = require $validationFilePath;

            // Merge the new translations with the existing ones
            $validationTranslations = array_merge($existingTranslations, $validationTranslations);
        }

        // Convert the updated array to a string representation
        $validationFileContent = "<?php\n\nreturn " . $this->arrayToString($validationTranslations) . ";";

        // Write the updated content back to the validation.php file
        file_put_contents($validationFilePath, $validationFileContent);

        $this->info('Updated validation.php file with new translations.');
    }

    protected function createLanguageFiles_EN()
    {
        $langPath = base_path('lang/en');

        // Create the 'ar' directory if it doesn't exist
        if (!is_dir($langPath)) {
            mkdir($langPath, 0755, true);
        }

        // Create the language files
        $files = [
            'common.php' => "<?php\n\nreturn [\n
            'english' => 'English',
            'french' => 'French',
            'arabic' => 'Arabic',
            'language' => 'Language',

            'cancel' => 'Cancel',
            'save'   => 'Save',
            'close'  => 'Close',
            'update' => 'Update',
            'edit'   => 'Edit',
            'delete' => 'Delete',
            'add'    => 'Add',
            'create' => 'Create',
            'view'   => 'View',
            'browse' => 'Browse',
            'import' => 'Import',
            'export' => 'Export',
            'upload' => 'Upload',
            'upload_file' => 'Upload File',
            'upload_image' => 'Upload Image',
            'upload_files' => 'Upload Files',
            'upload_images' => 'Upload Images',
            'upload_file_or_image' => 'Upload File or Image',
            'upload_files_or_images' => 'Upload Files or Images',
            'upload_file_or_images' => 'Upload File or Images',
            'upload_files_or_file' => 'Upload Files or File',
            'upload_images_or_image' => 'Upload Images or Image',
            'upload_images_or_images' => 'Upload Images or Images',
            'upload_images_or_files' => 'Upload Images or Files',
            'upload_images_or_file' => 'Upload Images or File',
            'upload_file_or_files' => 'Upload File or Files',
            'retry'  => 'Retry',
            'back'   => 'Back',
            'finish' => 'Finish',
            'apply'  => 'Apply',

            // REGISTER/LOGIN
    'email' => 'Email',
    'password' => 'Password',
    'confirm_password' => 'Confirm Password',
    'full_name' => 'Full Name',
    'sending' => 'Sending...',
    'loggingin' => 'logging in...',
    'registering' => 'Registering...',
    'reseting' => 'Reseting...'
            ];",
        ];

        foreach ($files as $fileName => $fileContent) {
            $filePath = $langPath . '/' . $fileName;

            // Create the file if it doesn't exist
            if (!file_exists($filePath)) {
                file_put_contents($filePath, $fileContent);
                $this->info("Created language file: {$filePath}");
            } else {
                $this->info("Language file already exists: {$filePath}");
            }
        }

        // Update the validation.php file
        $validationFilePath = $langPath . '/auth.php';
        $validationTranslations = [
            'failed' => 'These credentials do not match our records.',
            'password' => 'The provided password is incorrect.',
            'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

            'not_a_member' => 'Not a Member yet?',
            'entrance_point' => 'Entrance Point',
            'sign_up' => "Sign Up",
            'explore_a_sanctuary' => 'Explore a sanctuary of support. Sign in forempathetic connections and caring community.',
            'forget_password' => 'Forgot Your Password ?',
            'or' => 'Or',
            'already_have_account' => 'Already have an account ?',
            'join_now' => 'Join Now',
            'dive_into_our_community' => 'Dive into our dynamic community, where every journey finds its start.',
            'use_8_character' => 'Use 8 or more characters with a mix of letters, numbers & symbols.',
            'register' => 'Register',
            'enter_reset_email' => 'Enter your email to reset your password.',
            'send_pass' => 'Send Reset Link',
            'reset_password' => 'Reset Password',
            'setup_new_password' => 'Setup New Password',
            'Has_reset_password' => 'Has your password been successfully reset?',
            'email_verification' => 'Email Verification',
            'access_features' => 'Before accessing all the features, kindly check your email for the verification link awaiting your confirmation.',
            'send_verification_email' => 'Resend Verification Email',
            'Verification_email_sent' => 'Verification email sent, please check your email.',
        ];

        if (file_exists($validationFilePath)) {
            // Read the existing validation.php file
            $existingTranslations = require $validationFilePath;

            // Merge the new translations with the existing ones
            $validationTranslations = array_merge($existingTranslations, $validationTranslations);
        }

        // Convert the updated array to a string representation
        $validationFileContent = "<?php\n\nreturn " . $this->arrayToString($validationTranslations) . ";";

        // Write the updated content back to the validation.php file
        file_put_contents($validationFilePath, $validationFileContent);

        $this->info('Updated validation.php file with new translations.');
    }

    protected function arrayToString($array, $indent = '')
    {
        $string = "[\n";

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $string .= $indent . '    ' . "'" . $key . "' => " . $this->arrayToString($value, $indent . '    ') . ",\n";
            } else {
                $string .= $indent . '    ' . "'" . $key . "' => '" . str_replace("'", "\'", $value) . "',\n";
            }
        }

        $string .= $indent . ']';

        return $string;
    }
}
