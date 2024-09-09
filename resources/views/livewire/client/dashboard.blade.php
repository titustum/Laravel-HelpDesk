<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\Problem;

new
#[Layout('layouts.admin-layout')]
class extends Component  {
    public $user;
    public $resolved_count;
    public $progress_count;
    public $all_count;

    function mount(){

    }

}; ?>

<section class="p-6 bg-gray-100">
    <h2 class="mb-6 text-2xl font-semibold text-gray-800">Client Dashboard</h2>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <!-- Assigned Problems Card -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Reported Problems</h3>
                <i class="text-2xl text-blue-500 fas fa-tasks"></i>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ Auth::user()->problemsReported->count() }}</p>
            <p class="mt-2 text-sm text-gray-600">Current reported issues</p>
        </div>

        <!-- Resolved Problems Card -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Resolved Problems</h3>
                <i class="text-2xl text-green-500 fas fa-check-circle"></i>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ Auth::user()->problemsReported->where('status', 'Resolved')->count() }}</p>
            <p class="mt-2 text-sm text-gray-600">Issues resolved this month</p>
        </div>

        <!-- Pending Problems Card -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Pending Problems</h3>
                <i class="text-2xl text-yellow-500 fas fa-clock"></i>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{
                Auth::user()->problemsReported
                ->where('status', 'Open')
                ->count()
            }}</p>
            <p class="mt-2 text-sm text-gray-600">Issues awaiting resolution</p>
        </div>
    </div>

    <!-- Recent Assigned Problems Table -->
    <div class="mt-8 overflow-hidden bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700">Recently Reported Problems</h3>
        </div>
        <table class="w-full">
            <thead>
                <tr class="text-left bg-gray-50">
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Ticket</th>
                    {{-- <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Problem</th> --}}
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Officer Assigned</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Sample row, repeat as needed -->
                @foreach (Auth::user()->problemsReported()->limit(5)->get() as $problem)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">#{{ $problem->ticket }}</td>
                    {{-- <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $problem->description }}</td> --}}
                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $problem->assignedOfficer->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($problem->status === 'open') bg-red-100 text-red-800
                            @elseif($problem->status === 'elevated') bg-yellow-100 text-yellow-800
                            @elseif($problem->status === 'resolved') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $problem->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                        <a href="{{ route('client.problems.show', $problem->id) }}" class="text-indigo-600 hover:text-indigo-900">Update</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</section>
