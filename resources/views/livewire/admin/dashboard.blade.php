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

<section class="bg-gray-100 p-6">
    <h2 class="text-2xl font-bold mb-4">Admin Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Problems Card -->
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Total Problems</h3>
                <i class="fas fa-clipboard-list text-blue-500 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold mt-2">{{ $totalProblems }}</p>
        </div>

        <!-- Assigned Problems Card -->
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Assigned Problems</h3>
                <i class="fas fa-tasks text-green-500 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold mt-2">{{ $assignedProblems }}</p>
        </div>

        <!-- Unassigned Problems Card -->
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Unassigned Problems</h3>
                <i class="fas fa-exclamation-circle text-red-500 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold mt-2">{{ $unassignedProblems }}</p>
        </div>

        <!-- Total Officers Card -->
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Total Officers</h3>
                <i class="fas fa-users text-purple-500 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold mt-2">{{ $totalOfficers }}</p>
        </div>
    </div>

    <!-- Recent Problems Table -->
    <div class="mt-8 bg-white rounded-lg shadow overflow-hidden">
        <h3 class="text-lg font-semibold p-4 bg-gray-200">Recent Problems</h3>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Client</th>
                    <th class="px-4 py-2 text-left">Problem</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Assigned To</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentProblems as $problem)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $problem->id }}</td>
                    <td class="px-4 py-2">{{ $problem->client_name }}</td>
                    <td class="px-4 py-2">{{ Str::limit($problem->description, 30) }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-xs
                            @if($problem->status == 'Open') bg-red-200 text-red-800
                            @elseif($problem->status == 'In Progress') bg-yellow-200 text-yellow-800
                            @else bg-green-200 text-green-800 @endif">
                            {{ $problem->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $problem->assigned_to ?? 'Unassigned' }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.problems.edit', $problem->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
