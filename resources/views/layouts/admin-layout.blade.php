<x-overall-layout>

    <div class="min-h-screen bg-gray-100">
        <!-- Side Navigation -->
        <nav class="fixed top-0 left-0 w-64 min-h-screen overflow-y-auto bg-indigo-800">
            <div class="flex items-center justify-center h-16 bg-indigo-900">
                <span class="text-2xl font-semibold text-white">Ecoplan HelpDesk</span>
            </div>
            <ul class="mt-6">
                @if (Auth::user()->role === 'client')

                <li class="mb-2">
                    <a href="{{ route('client.dashboard') }}" class="flex items-center px-6 py-2 text-white hover:bg-indigo-700">
                        <i class="mr-3 fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('client.problems') }}" class="flex items-center px-6 py-2 text-white hover:bg-indigo-700">
                        <i class="mr-3 fas fa-clipboard-list"></i> Problems
                    </a>
                </li>

                @elseif (Auth::user()->role === 'officer')

                <li class="mb-2">
                    <a href="{{ route('officer.dashboard') }}" class="flex items-center px-6 py-2 text-white hover:bg-indigo-700">
                        <i class="mr-3 fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('officer.problems') }}" class="flex items-center px-6 py-2 text-white hover:bg-indigo-700">
                        <i class="mr-3 fas fa-clipboard-list"></i> My Problems
                    </a>
                </li>

                @else
                <li class="mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-2 text-white hover:bg-indigo-700">
                        <i class="mr-3 fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.problems.index') }}" class="flex items-center px-6 py-2 text-white hover:bg-indigo-700">
                        <i class="mr-3 fas fa-clipboard-list"></i> Problems
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.officers.index') }}" class="flex items-center px-6 py-2 text-white hover:bg-indigo-700">
                        <i class="mr-3 fas fa-users"></i> Officers
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.reports') }}" class="flex items-center px-6 py-2 text-white hover:bg-indigo-700">
                        <i class="mr-3 fas fa-chart-bar"></i> Reports
                    </a>
                </li>
                @endif

            </ul>
        </nav>

        <!-- Main Content Area -->
        <div class="ml-64">
            <!-- Top Navigation -->
            <nav class="bg-white shadow-sm">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="flex items-center flex-shrink-0">
                                <x-application-logo class="h-16"/>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ml-1">
                                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="py-10">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>


</x-overall-layout>

