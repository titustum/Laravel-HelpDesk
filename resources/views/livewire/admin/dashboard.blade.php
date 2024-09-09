<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Problem;
use App\Models\User;

new
#[Layout('layouts.admin-layout')]
class extends Component {
    public $totalProblems;
    public $assignedProblems;
    public $unassignedProblems;
    public $totalOfficers;
    public $recentProblems;

    public function mount()
    {
        $this->totalProblems = Problem::count();
        $this->assignedProblems = Problem::whereNotNull('assigned_to')->count();
        $this->unassignedProblems = Problem::whereNull('assigned_to')->count();
        $this->totalOfficers = User::where('role', 'officer')->count();
        $this->recentProblems = Problem::with('assignedOfficer')
                                       ->latest()
                                       ->take(5)
                                       ->get();
    }
};
?>

<section class="p-6 bg-gray-100">
    <h2 class="mb-4 text-2xl font-bold">Admin Dashboard</h2>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
        <!-- Total Problems Card -->
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Total Problems</h3>
                <i class="text-2xl text-blue-500 fas fa-clipboard-list"></i>
            </div>
            <p class="mt-2 text-3xl font-bold">{{ $totalProblems }}</p>
        </div>

        <!-- Assigned Problems Card -->
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Assigned Problems</h3>
                <i class="text-2xl text-green-500 fas fa-tasks"></i>
            </div>
            <p class="mt-2 text-3xl font-bold">{{ $assignedProblems }}</p>
        </div>

        <!-- Unassigned Problems Card -->
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Unassigned Problems</h3>
                <i class="text-2xl text-red-500 fas fa-exclamation-circle"></i>
            </div>
            <p class="mt-2 text-3xl font-bold">{{ $unassignedProblems }}</p>
        </div>

        <!-- Total Officers Card -->
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Total Officers</h3>
                <i class="text-2xl text-purple-500 fas fa-users"></i>
            </div>
            <p class="mt-2 text-3xl font-bold">{{ $totalOfficers }}</p>
        </div>
    </div>

    <!-- Recent Problems Table -->
    <div class="mt-8 overflow-hidden bg-white rounded-lg shadow">
        <h3 class="p-4 text-lg font-semibold bg-gray-200">Recent Problems</h3>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Ticket</th>
                    <th class="px-4 py-2 text-left">Client</th>
                    <th class="px-4 py-2 text-left">Department</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Assigned To</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentProblems as $problem)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $problem->ticket }}</td>
                    <td class="px-4 py-2">{{ $problem->clientReported->name }}</td>
                    <td class="px-4 py-2">{{ $problem->clientReported->department->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($problem->status === 'open') bg-red-100 text-red-800
                            @elseif($problem->status === 'elevated') bg-yellow-100 text-yellow-800
                            @elseif($problem->status === 'resolved') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $problem->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $problem->assignedOfficer->name ?? 'Unassigned' }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.problems.show', $problem->id) }}" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
