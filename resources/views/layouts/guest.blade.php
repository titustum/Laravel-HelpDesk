<x-overall-layout>

    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">

        <!-- Left Side: Description Section -->
        <div class="flex-col justify-center hidden lg:flex">
            <h1 class="text-center font-bold text-4xl text-cyan-600 font-['Righteous']">Ecoplan HelpDesk</h1>
            <img src="{{ asset('images/helpdesk-illustrator.webp') }}" class="mx-auto">
        </div>

        <!-- Right Side: Login/Register Forms -->
        <div class="flex flex-col items-center justify-center w-full p-8 lg:w-1/2 lg:p-16">
            <div class="w-full max-w-md p-6 mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="mb-8 text-center">
                    <a href="/" class="text-orange-600">
                        <img src="{{ asset('images/logo1.png') }}" alt="Logo Image"  class="w-24 h-24 mx-auto text-gray-500 fill-current">
                    </a>
                </div>
                <div class="w-full max-w-md px-6 py-4 mt-6 overflow-auto dark:bg-gray-800 sm:rounded-lg">
                {{ $slot }}
                </div>
            </div>
        </div>

    </div>



</x-overall-layout>
