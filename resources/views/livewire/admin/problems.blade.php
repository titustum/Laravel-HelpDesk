<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Problem;
use Livewire\WithPagination;

new
#[Layout('layouts.admin-layout')]
class extends Component
{
    use WithPagination;

    public $search;
    public $flashMessage = '';

    protected $paginationTheme = 'tailwind'; // Optional, depends on your styling

    public function deleteProblem($id)
    {
        $problem = Problem::findOrFail($id);
        $problem->delete();

        session()->flash('message', 'Problem successfully deleted.');
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Resets to page 1 when search query changes
    }

    public function with()
    {
        $problems = Problem::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->paginate(15); // Pagination added, adjust the number as necessary

        return [
            "problems" => $problems,
        ];
    }
}
?>


<div class="p-4 mt-8 overflow-hidden bg-white rounded-lg shadow">

    <h2 class="mb-4 text-2xl font-semibold">Tasks</h2>

    @if (session()->has('message'))
    <div class="p-3 mb-4 text-green-600 bg-green-200 rounded-md">
        {{ $flashMessage }}
    </div>
    @endif

    <div class="flex items-center justify-between mb-4">
        <div>
            <input wire:live="search" type="text" placeholder="Search problems..."
                   class="px-4 py-2 border rounded-lg">
        </div>
        <a href="{{ route('admin.problems.create') }}"
           class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            Add New Task
        </a>
    </div>

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
            @foreach($problems as $problem)
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

    <div class="mt-4">
        {{ $problems->links() }}
    </div>
</div>

