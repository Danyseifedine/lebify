<!DOCTYPE html>
<html data-navigation-type="default" data-navbar-horizontal-shape="default"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Join Our Community - Lebify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .select2-container .select2-selection--single {
            height: 42px;
            border-radius: 0.5rem;
            border-color: #D1D5DB;
            background-color: #fff;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px;
            color: #374151;
        }

        .select2-selection__arrow {
            margin: 7px !important;
            background: transparent !important;
            border: transparent !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #6366F1;
        }

        .select2-dropdown {
            border-color: #D1D5DB;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .select2-search--dropdown .select2-search__field {
            border-radius: 0.25rem;
            border-color: #D1D5DB;
            padding: 0.5rem;
        }

        .select2-results__option {
            padding: 0.5rem 1rem;
        }
    </style>
</head>

<body class=" min-h-screen flex items-center justify-center p-4">
    @if (session('success'))
        <div id="successAlert" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-8 rounded-lg shadow-xl text-center max-w-md w-full mx-4">
                <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-xl text-gray-600 mb-6">{{ session('success') }}</p>
                <p class="text-sm text-gray-500 mb-6">{{ __('form.appreciate_your_participation') }}</p>
                <button onclick="document.getElementById('successAlert').style.display='none';"
                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300 inline-block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('form.close') }}
                </button>
            </div>
        </div>
    @endif
    <div id="app" class="bg-white bg-opacity-95 p-8 rounded-2xl shadow-2xl max-w-4xl w-full backdrop-blur-sm">
        <h2 class="text-4xl font-bold text-center mb-2 text-indigo-800 mt-12">{{ __('form.join_our_community') }}</h2>
        <p class="text-gray-600 mb-8 text-center">
            {{ __('form.help_us_tailor_our_services_to_your_needs_by_providing_some_information_about_yourself') }}</p>
        <div class="absolute top-4 left-4">
            <div class="relative inline-block text-left">
                <div>
                    <button type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        id="language-menu-button" aria-expanded="false" aria-haspopup="true">
                        {{ LaravelLocalization::getCurrentLocaleNative() }}
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden"
                    role="menu" aria-orientation="vertical" aria-labelledby="language-menu-button" tabindex="-1"
                    id="language-menu">
                    <div class="py-1" role="none">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem"
                                tabindex="-1">{{ $properties['native'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <form id="userForm" action="{{ route('landing.form') }}" onsubmit="return validateForm();" method="POST"
            class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="firstName"
                        class="block text-sm font-medium text-gray-700 mb-1">{{ __('form.first_name') }} *</label>
                    <input placeholder="{{ __('form.first_name_placeholder') }}" type="text" id="firstName"
                        name="firstName"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400
                        focus:border-transparent transition">
                </div>
                <div>
                    <label for="lastName"
                        class="block text-sm font-medium text-gray-700 mb-1">{{ __('form.last_name') }} *</label>
                    <input placeholder="{{ __('form.last_name_placeholder') }}" type="text" id="lastName"
                        name="lastName"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400
                        focus:border-transparent transition">
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('form.email') }}
                    *</label>
                <input placeholder="{{ __('form.email_placeholder') }}" type="email" id="email" name="email"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400
                    focus:border-transparent transition">
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">{{ __('form.phone') }}
                    *</label>
                <input placeholder="{{ __('form.phone_placeholder') }}" type="tel" id="phone" name="phone"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400
                    focus:border-transparent transition">
            </div>

            <div>
                <label for="age" class="block text-sm font-medium text-gray-700 mb-1">{{ __('form.age') }}</label>
                <div class="flex items-center space-x-4">
                    <button type="button" id="decreaseAge"
                        class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-md hover:bg-indigo-200 focus:outline-none
                        focus:ring-2 focus:ring-indigo-400">-</button>
                    <input type="range" required id="age" name="age" min="10" max="60"
                        value="25"
                        class="w-full h-2 bg-indigo-200 rounded-lg appearance-none
                        cursor-pointer">
                    <button type="button" id="increaseAge"
                        class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-md hover:bg-indigo-200
                        focus:outline-none focus:ring-2 focus:ring-indigo-400">+</button>
                </div>
                <p id="ageDisplay" class="text-center mt-2 text-gray-600 font-medium">{{ __('form.age_display') }}
                </p>
            </div>
            <div id="additionalQuestions" class="space-y-4">
                <!-- Additional questions will be dynamically added here based on age -->
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('form.interests_label') }}</label>
                <div id="interestsContainer" class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                    <!-- Interests checkboxes will be dynamically added here -->
                </div>
            </div>
            <div>
                <label
                    class="block text-sm font-medium text-gray-700 mb-2">{{ __('form.contact_preferences') }}</label>
                <div class="grid grid-cols-2 gap-4">
                    <label
                        class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="contact_preferences[]" value="whatsapp"
                            class="form-checkbox h-5 w-5 text-indigo-600">
                        <span class="text-gray-700">{{ __('form.whatsapp') }}</span>
                    </label>
                    <label
                        class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="contact_preferences[]" value="group"
                            class="form-checkbox h-5 w-5 text-indigo-600">
                        <span class="text-gray-700">{{ __('form.enter_group') }}</span>
                    </label>
                    <label
                        class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="contact_preferences[]" value="email"
                            class="form-checkbox h-5 w-5 text-indigo-600">
                        <span class="text-gray-700">{{ __('form.email') }}</span>
                    </label>
                    <label
                        class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="contact_preferences[]" value="no_contact"
                            class="form-checkbox h-5 w-5 text-indigo-600">
                        <span class="text-gray-700">{{ __('form.dont_contact') }}</span>
                    </label>
                </div>
            </div>
            <div class="mt-8">
                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-4 rounded-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                    {{ __('form.submit') }}
                </button>
            </div>
        </form>


        <footer class="mt-8 text-center text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} Dany Seifeddine. All rights reserved.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <script>
        const interests = @php echo json_encode(__('form.interests')) @endphp;
        const schools = @php echo json_encode(__('form.schools')) @endphp;
        const universities = @php echo json_encode(__('form.universities')) @endphp;
        const expertises = @php echo json_encode(__('form.expertises')) @endphp;
        const occupations = @php echo json_encode(__('form.occupations')) @endphp;

        function createSelectOptions(options) {
            return Object.entries(options).map(([value, label]) => `<option value="${value}">${label}</option>`).join('');
        }

        confetti({
            particleCount: 100,
            spread: 70,
            origin: {
                y: 0.6
            }
        });

        document.getElementById('language-menu-button').addEventListener('click', function() {
            document.getElementById('language-menu').classList.toggle('hidden');
        });


        function validateForm() {
            let isValid = true;
            const errorMessages = [];

            // Remove existing error messages
            const existingErrorContainer = document.querySelector('.bg-red-100');
            if (existingErrorContainer) {
                existingErrorContainer.remove();
            }

            // Validate first name
            const firstName = document.getElementById('firstName');
            if (!firstName.value.trim()) {
                isValid = false;
                firstName.classList.add('border-red-500');
                errorMessages.push('{{ __('form.first_name_required') }}');
            } else {
                firstName.classList.remove('border-red-500');
            }

            // Validate last name
            const lastName = document.getElementById('lastName');
            if (!lastName.value.trim()) {
                isValid = false;
                lastName.classList.add('border-red-500');
                errorMessages.push('{{ __('form.last_name_required') }}');
            } else {
                lastName.classList.remove('border-red-500');
            }

            // Validate email
            const email = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.value.trim() || !emailRegex.test(email.value)) {
                isValid = false;
                email.classList.add('border-red-500');
                errorMessages.push('{{ __('form.valid_email_required') }}');
            } else {
                email.classList.remove('border-red-500');
            }

            // Validate phone number
            const phone = document.getElementById('phone');
            if (!phone.value.trim()) {
                isValid = false;
                phone.classList.add('border-red-500');
                errorMessages.push('{{ __('form.valid_phone_required') }}');
            } else {
                phone.classList.remove('border-red-500');
            }

            // Validate age
            const age = document.getElementById('age');
            if (age.value < 10 || age.value > 60) {
                isValid = false;
                age.classList.add('border-red-500');
                errorMessages.push('{{ __('form.age_range_error') }}');
            } else {
                age.classList.remove('border-red-500');
            }

            // Validate preferences
            const preferences = document.querySelectorAll('input[name="contact_preferences[]"]:checked');
            if (preferences.length === 0) {
                isValid = false;
                document.querySelector('.grid.grid-cols-2.gap-4').classList.add('border', 'border-red-500', 'rounded-lg');
                errorMessages.push('{{ __('form.preferences_required') }}');
            } else {
                document.querySelector('.grid.grid-cols-2.gap-4').classList.remove('border', 'border-red-500',
                    'rounded-lg');
            }

            // Display error messages
            if (!isValid) {
                const errorContainer = document.createElement('div');
                errorContainer.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4';
                errorContainer.innerHTML = `
                    <strong class="font-bold">{{ __('form.error') }}:</strong>
                    <ul class="list-disc list-inside">
                        ${errorMessages.map(msg => `<li>${msg}</li>`).join('')}
                    </ul>
                `;
                const form = document.getElementById('userForm');
                form.insertBefore(errorContainer, form.firstChild);

                // Scroll to the top of the form
                form.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }

            return isValid;
        }

        function populateInterests() {
            const container = document.getElementById('interestsContainer');
            interests.forEach(interest => {
                const div = document.createElement('div');
                div.innerHTML = `
                    <label class="inline-flex items-center p-2 rounded-lg border border-gray-200 cursor-pointer transition-all hover:bg-indigo-50 w-full">
                        <input type="checkbox" name="interests[]" value="${interest.value}" class="form-checkbox h-5 w-5 text-indigo-600 rounded focus:ring-indigo-400">
                        <span class="ml-2 text-gray-700 text-sm">${interest.label}</span>
                    </label>
                `;
                container.appendChild(div);
            });
        }

        function updateAdditionalQuestions(age) {
            const additionalQuestions = document.getElementById('additionalQuestions');
            additionalQuestions.innerHTML = '';

            if (age >= 10 && age < 18) {
                additionalQuestions.innerHTML += `
                    <div>
                        <label for="school" class="block text-sm font-medium text-gray-700 mb-1">{{ __('form.school_name') }}</label>
                        <select id="school" name="school" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            <option value="">{{ __('form.school_placeholder') }}</option>
                            ${createSelectOptions(schools)}
                        </select>
                    </div>
                `;
            }

            if (age >= 10 && age <= 20) {
                additionalQuestions.innerHTML += `
                    <div>
                        <label for="futureExpertise" class="block text-sm font-medium text-gray-700 mb-1">{{ __('form.future_expertise') }}</label>
                        <select id="futureExpertise" name="futureExpertise" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            <option value="">{{ __('form.future_expertise_placeholder') }}</option>
                            ${createSelectOptions(expertises)}
                        </select>
                    </div>
                `;
            }

            if (age >= 18 && age < 25) {
                additionalQuestions.innerHTML += `
                    <div>
                        <label for="education" class="block text-sm font-medium text-gray-700 mb-1">{{ __('form.highest_education_level') }}</label>
                        <select id="education" name="education" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            <option value="">{{ __('form.education_level_placeholder') }}</option>
                            <option value="high_school">{{ __('form.high_school') }}</option>
                            <option value="college">{{ __('form.college') }}</option>
                            <option value="graduate">{{ __('form.graduate') }}</option>
                        </select>
                    </div>
                    <div>
                        <label for="university" class="block text-sm font-medium text-gray-700 mb-1">{{ __('form.university') }}</label>
                        <select id="university" name="university" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            <option value="">{{ __('form.university_placeholder') }}</option>
                            ${createSelectOptions(universities)}
                        </select>
                    </div>
                `;
            }

            if (age >= 25 && age <= 60) {
                additionalQuestions.innerHTML += `
                    <div>
                        <label for="occupation" class="block text-sm font-medium text-gray-700 mb-1">{{ __('form.occupation') }}</label>
                        <select id="occupation" name="occupation" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            <option value="">{{ __('form.occupation_placeholder') }}</option>
                            ${createSelectOptions(occupations)}
                        </select>
                    </div>
                `;
            }

            // Initialize Select2 for all select elements
            $(document).ready(function() {
                $('select').select2({
                    theme: 'classic',
                    width: '100%',
                    minimumResultsForSearch: 6,
                    placeholder: '{{ __('form.select_an_option') }}',
                    allowClear: true
                });
            });
        }

        const ageInput = document.getElementById('age');
        const ageDisplay = document.getElementById('ageDisplay');
        const decreaseAgeBtn = document.getElementById('decreaseAge');
        const increaseAgeBtn = document.getElementById('increaseAge');

        function updateAge(newAge) {
            newAge = Math.max(10, Math.min(60, newAge));
            ageInput.value = newAge;
            ageDisplay.textContent = `${newAge} {{ __('form.years_old') }}`;
            updateAdditionalQuestions(newAge);
        }

        ageInput.addEventListener('input', function() {
            updateAge(parseInt(this.value));
        });

        decreaseAgeBtn.addEventListener('click', function() {
            updateAge(parseInt(ageInput.value) - 1);
        });

        increaseAgeBtn.addEventListener('click', function() {
            updateAge(parseInt(ageInput.value) + 1);
        });

        // Initialize interests and additional questions
        populateInterests();
        updateAge(25);

        // Handle contact preference checkboxes
        const noContactCheckbox = document.querySelector('input[value="no_contact"]');
        const otherContactCheckboxes = document.querySelectorAll(
            'input[name="contact_preferences[]"]:not([value="no_contact"])');

        noContactCheckbox.addEventListener('change', function() {
            if (this.checked) {
                otherContactCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                    checkbox.disabled = true;
                });
            } else {
                otherContactCheckboxes.forEach(checkbox => {
                    checkbox.disabled = false;
                });
            }
        });

        otherContactCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (Array.from(otherContactCheckboxes).some(cb => cb.checked)) {
                    noContactCheckbox.checked = false;
                    noContactCheckbox.disabled = true;
                } else {
                    noContactCheckbox.disabled = false;
                }
            });
        });
    </script>
</body>

</html>
