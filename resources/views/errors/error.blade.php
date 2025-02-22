<!DOCTYPE html>
<html lang="en" class="dark theme-dark" :class="{ 'theme-dark': dark }" x-data="data()">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @include('errors.favicon_error')

        <title>@yield('title')</title>

        <script src="{{url('/js/sweet-alert.min.js')}}"></script>

        @vite('resources/css/app.css')

        @vite('resources/js/app.js')
    </head>
    <body class="bg-gray-50 dark:bg-gray-800 font-vazir">
    @include('sweetalert::alert')
        <main class="bg-gray-50 dark:bg-gray-900">

        <div class="flex flex-col justify-center items-center px-6 mx-auto h-screen xl:px-0 dark:bg-gray-900">
            <div class="block md:max-w-lg">
                @yield('image')
            </div>
            <div class="text-center xl:max-w-4xl">
                <h1 class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl lg:text-5xl dark:text-white">@yield('code')</h1>
                <p class="mb-5 text-xl font-normal text-gray-500 md:text-lg dark:text-gray-400">@yield('message')</p>
                <a href="{{url('/')}}" class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-3 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                    <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    بازگشت به صفحه اصلی
                </a>
            </div>
        </div>

    </main>
        <!-- Dark Mode Toggle Button -->
        <div class="fixed bottom-4 left-4">
            <button id="theme-toggle" type="button" class="bg-blue-500 text-white p-3 rounded-full shadow-lg">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
            </button>
        </div>
        <script src="{{asset('/js/buttons.js')}}"></script>
        <script src="{{asset('/js/app.bundle.js')}}"></script>
        <script src="{{asset('/js/datepicker.js')}}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const loadingSpinner = document.getElementById('loading-spinner');

                // Function to show the loading spinner
                function showLoadingSpinner() {
                    loadingSpinner.classList.remove('hidden');
                }

                // Function to hide the loading spinner
                function hideLoadingSpinner() {
                    loadingSpinner.classList.add('hidden');
                }

                // Example usage: Show spinner on page load and hide after 2 seconds
                showLoadingSpinner();
                setTimeout(hideLoadingSpinner, 2000);
            });
            document.addEventListener('DOMContentLoaded', () => {
                const themeToggle = document.getElementById('theme-toggle');
                const darkIcon = document.getElementById('theme-toggle-dark-icon');
                const lightIcon = document.getElementById('theme-toggle-light-icon');

                // Show the correct initial icon
                if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                    darkIcon.classList.add('hidden');
                    lightIcon.classList.remove('hidden');
                } else {
                    document.documentElement.classList.remove('dark');
                    lightIcon.classList.add('hidden');
                    darkIcon.classList.remove('hidden');
                }

                themeToggle.addEventListener('click', () => {
                    document.documentElement.classList.toggle('dark');
                    darkIcon.classList.toggle('hidden');
                    lightIcon.classList.toggle('hidden');

                    if (document.documentElement.classList.contains('dark')) {
                        localStorage.setItem('theme', 'dark');
                    } else {
                        localStorage.setItem('theme', 'light');
                    }
                    window.location.reload();
                });
            });
        </script>
    </body>
</html>
