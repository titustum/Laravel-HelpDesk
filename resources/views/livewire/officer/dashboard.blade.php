<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\Problem;

new
#[Layout('layouts.officer-layout')]
class extends Component  {
    public $user;
    public $resolved_count;
    public $progress_count;
    public $all_count;

    function mount(){

    }

}; ?>

<section class="bg-gray-100 p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Officer Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Assigned Problems Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Assigned Problems</h3>
                <i class="fas fa-tasks text-blue-500 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ Auth::user()->problems->count() }}</p>
            <p class="text-sm text-gray-600 mt-2">Current assigned issues</p>
        </div>

        <!-- Resolved Problems Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Resolved Problems</h3>
                <i class="fas fa-check-circle text-green-500 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ Auth::user()->problems->where('status', 'Resolved')->count() }}</p>
            <p class="text-sm text-gray-600 mt-2">Issues resolved this month</p>
        </div>

        <!-- Pending Problems Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Pending Problems</h3>
                <i class="fas fa-clock text-yellow-500 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{
                Auth::user()->problems
                ->where('status', 'Open')
                ->count()
            }}</p>
            <p class="text-sm text-gray-600 mt-2">Issues awaiting resolution</p>
        </div>
    </div>

    <!-- Recent Assigned Problems Table -->
    <div class="mt-8 bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700">Recent Assigned Problems</h3>
        </div>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 text-left">
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Problem</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Sample row, repeat as needed -->
                @foreach (Auth::user()->problems as $problem)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $problem->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $problem->description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $problem->client_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($problem->status === 'Open') bg-red-100 text-red-800
                            @elseif($problem->status === 'In Progress') bg-yellow-100 text-yellow-800
                            @elseif($problem->status === 'Resolved') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $problem->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('officer.problems.show', $problem->id) }}" class="text-indigo-600 hover:text-indigo-900">Update</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</section>
