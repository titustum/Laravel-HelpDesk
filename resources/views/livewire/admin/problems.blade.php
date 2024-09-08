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
            ->paginate(20); // Pagination added, adjust the number as necessary

        return [
            "problems" => $problems,
        ];
    }
}
?>


<div>
    <h2 class="mb-4 text-2xl font-semibold">Problems</h2>

    @if (session()->has('message'))
    <div class="p-3 mb-4 text-green-600 bg-green-200 rounded-md">
        {{ $flashMessage }}
    </div>
    @endif

    <div class="flex items-center justify-between mb-4">
        <div>
            <input wire:model.debounce.300ms="search" type="text" placeholder="Search problems..."
                   class="px-4 py-2 border rounded-lg">
        </div>
        <a href="{{ route('admin.problems.create') }}"
           class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            Add New Problem
        </a>
    </div>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                    ID
                </th>
                <th class="px-4 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                    Client Name
                </th>
                <th class="px-4 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                    Status
                </th>
                <th class="px-4 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                    Created At
                </th>
                <th class="px-4 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($problems as $problem)
                <tr>
                    <td class="px-4 py-2 border-b border-gray-200">{{ $problem->id }}</td>
                    <td class="px-4 py-2 border-b border-gray-200">{{ $problem->client_name }}</td>
                    <td class="px-4 py-2 border-b border-gray-200">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($problem->status === 'Open') bg-red-100 text-red-800
                            @elseif($problem->status === 'In Progress') bg-yellow-100 text-yellow-800
                            @elseif($problem->status === 'Resolved') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $problem->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border-b border-gray-200">{{ $problem->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-4 py-2 border-b border-gray-200">
                        <a href="{{ route('admin.problems.show', $problem->id) }}" class="mr-2 text-blue-600 hover:text-blue-900">View</a>
                        <a href="{{ route('admin.problems.edit', $problem->id) }}" class="mr-2 text-green-600 hover:text-green-900">Edit</a>
                        <button
                            wire:click="deleteProblem({{ $problem->id }})"
                            wire:confirm="Are you sure you want to delete this problem?"
                        class="text-red-600 hover:text-red-900">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $problems->links() }}
    </div>
</div>

