    <button id="theme-dark" aria-label="Switch to light theme" style="z-index: 99999"
        class="position-fixed rounded-circle bottom-0 p-5 end-0 m-5">
        <i class="bi bi-moon fs-1" aria-hidden="true"></i>
    </button>
    <button id="theme-light" aria-label="Switch to dark theme" style="z-index: 99999"
        class="position-fixed rounded-circle bottom-0 p-5 end-0 m-5">
        <i class="bi bi-sun fs-1" aria-hidden="true"></i>
    </button>


    @push('scripts')
        <script>
            var mode = KTThemeMode.getMode();
            var btn_dark = document.getElementById('theme-dark');
            var btn_light = document.getElementById('theme-light');

            if (mode === 'dark') {
                btn_light.style.display = 'none';
                btn_dark.style.display = 'block';
            } else {
                btn_light.style.display = 'block';
                btn_dark.style.display = 'none';
            }

            btn_dark.addEventListener('click', function() {

                KTThemeMode.setMode('light');
                localStorage.setItem('data-bs-theme', 'light');
                btn_light.style.display = 'block';
                btn_dark.style.display = 'none';

            });

            btn_light.addEventListener('click', function() {
                KTThemeMode.setMode('dark');
                localStorage.setItem('data-bs-theme', 'dark');
                btn_light.style.display = 'none';
                btn_dark.style.display = 'block';
            });
        </script>
    @endpush
