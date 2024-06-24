<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}







    <nav class="py-2 px-3 bg-white">
        <div class="flex justify-between mx-auto w-[90%]">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <x-application-logo class="h-14"/>
                <h1 class="text-2xl font-bold text-cyan-700 font-['Righteous'] py-1 border-b-4 border-cyan-600">HelpDesk</h1>
            </a>

            <a href="#" class="flex items-center">
                <i class="fas fa-2x fa-user-circle"></i>
                <div class="flex flex-col ml-2">
                    <h1 class="font-bold">James</h1>
                    <div class="text-[.75rem] -mt-1 text-orange-600">Profile</div>
                </div>
            </a>

        </div>
    </nav>


    <section class="mt-6">
        <div class="bg-white w-[90%] mx-auto p-6 rounded-md">
            <h1 class="border-b border-orange-600 py-2 font-bold text-xl mb-6">Client Dashboard</h1>
        </div>
    </section>

</x-app-layout>
