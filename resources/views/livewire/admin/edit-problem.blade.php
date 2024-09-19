<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Problem;
use App\Models\User;


new
#[Layout('layouts.admin-layout')]
class extends Component
{
    public Problem $problem;
    public $client_name = '';
    public $client_phone = '';
    public $client_email = '';
    public $description = '';
    public $status = '';
    public $assigned_to = '';
    public $solution = '';
    public $officers;


    public function mount($id)
    {
        $this->problem = Problem::findOrFail($id);
        $this->client_name = $this->problem->client_name;
        $this->client_phone = $this->problem->client_phone;
        $this->client_email = $this->problem->client_email;
        $this->description = $this->problem->description;
        $this->status = $this->problem->status;
        $this->assigned_to = $this->problem->assigned_to;
        $this->solution = $this->problem->solution;
        $this->officers = User::where('role', 'officer')->get();
    }

    public function rules()
    {
        return [
            'client_name' => 'required|string|max:255',
            'client_phone' => 'nullable|string|max:20',
            'client_email' => 'nullable|email|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Open,In Progress,Resolved,Closed',
            'assigned_to' => 'nullable|exists:users,id',
            'solution' => 'nullable|string',
        ];
    }

    public function updateProblem()
    {
        $this->validate();

        $this->problem->update([
            'client_name' => $this->client_name,
            'client_phone' => $this->client_phone,
            'client_email' => $this->client_email,
            'description' => $this->description,
            'status' => $this->status,
            'assigned_to' => $this->assigned_to,
            'solution' => $this->solution,
        ]);

        session()->flash('message', 'Problem updated successfully.');
        $this->redirect(route('admin.problems.show', $this->problem->id));
    }
}
?>


<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-semibold mb-6">Edit Task</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <form wire:submit="updateProblem" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="client_name">
                Client Name
            </label>
            <input wire:model="client_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="client_name" type="text" placeholder="Client Name">
            @error('client_name') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="client_phone">
                Client Phone
            </label>
            <input wire:model="client_phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="client_phone" type="tel" placeholder="Client Phone">
            @error('client_phone') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="client_email">
                Client Email
            </label>
            <input wire:model="client_email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="client_email" type="email" placeholder="Client Email">
            @error('client_email') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Description
            </label>
            <textarea wire:model="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" placeholder="Problem Description"></textarea>
            @error('description') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                Status
            </label>
            <select wire:model="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status">
                <option value="Open">Open</option>
                <option value="In Progress">In Progress</option>
                <option value="Resolved">Resolved</option>
                <option value="Closed">Closed</option>
            </select>
            @error('status') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="assigned_to">
                Assigned To
            </label>
            <select wire:model="assigned_to" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="assigned_to">
                <option value="">Unassigned</option>
                @foreach($officers as $officer)
                    <option value="{{ $officer->id }}">{{ $officer->name }}</option>
                @endforeach
            </select>
            @error('assigned_to') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="solution">
                Solution
            </label>
            <textarea wire:model="solution" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="solution" placeholder="Solution"></textarea>
            @error('solution') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Update Task
            </button>
        </div>
    </form>
</div>
