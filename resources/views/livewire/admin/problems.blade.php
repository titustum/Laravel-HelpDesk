<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Problem;
use App\Models\User;

new
#[Layout('layouts.admin-layout')]
class extends Component {

    public $search;
    public $problems;
    public $flashMessage = '';

    public function mount()
    {
        $this->search = '';
        $this->problems = Problem::get();
    }

    public function deleteProblem($id){
        $problem = Problem::findOrFail($id);
        $problem->delete();
        $this->problems = Problem::get();

        session()->flash('message', 'Problem successfully deleted.');
    }
}
?>

<div>
    <h2 class="text-2xl font-semibold mb-4">Problems</h2>

    @if (session()->has('message'))
    <div class="text-green-600 mb-4 bg-green-200 rounded-md p-3">
        {{ $flashMessage }}
    </div>
    @endif

    <div class="mb-4 flex justify-between items-center">
        <div>
            <input wire:model.debounce.300ms="search" type="text" placeholder="Search problems..."
                   class="px-4 py-2 border rounded-lg">
        </div>
        <a href="{{ route('admin.problems.create') }}"
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Problem
        </a>
    </div>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    ID
                </th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Client Name
                </th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Created At
                </th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($problems as $problem)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $problem->id }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $problem->client_name }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($problem->status === 'Open') bg-red-100 text-red-800
                            @elseif($problem->status === 'In Progress') bg-yellow-100 text-yellow-800
                            @elseif($problem->status === 'Resolved') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $problem->status }}
                        </span>
                    </td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $problem->created_at->format('Y-m-d H:i') }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">
                        <a href="{{ route('admin.problems.show', $problem->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">View</a>
                        <a href="{{ route('admin.problems.edit', $problem->id) }}" class="text-green-600 hover:text-green-900 mr-2">Edit</a>
                        <button
                            wire:click="deleteProblem({{ $problem->id }})"
                            wire:confirm="Are you sure you want to delete this problem?"
                        class="text-red-600 hover:text-red-900">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

