<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Problem;
use App\Models\User;

new
#[Layout('layouts.admin-layout')]
class extends Component {
    public $officers;
    public $client_name = '';
    public $client_phone = '';
    public $client_email = '';
    public $description = '';
    public $assigned_to = '';
    public $status = 'open';

    private function generateTicket()
    {
        return "TKT-" . strtoupper(uniqid());
    }

    public function mount() {
        $this->officers = User::where('role', 'officer')->get();
    }

    public function store()
    {
        $validatedData = $this->validate([
            'client_name' => 'required|string|max:255',
            'client_phone' => 'nullable|string|max:20',
            'client_email' => 'nullable|email|max:255',
            'description' => 'required|string',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:open,elevated,resolved,closed',
        ]);

        $problem = Problem::create($validatedData + ['created_by' => auth()->id(), 'ticket' => $this->generateTicket()]);

        $this->reset(['client_name', 'client_phone', 'client_email', 'description', 'assigned_to', 'status']);

        session()->flash('success', 'Problem added successfully.');
        $this->redirect(route('admin.problems.index'));
    }
};

?>

<section class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Add New Problem</h2>

    <form wire:submit="store">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Client Name -->
            <div>
                <label for="client_name" class="block text-sm font-medium text-gray-700">Client Name</label>
                <input type="text" wire:model="client_name" id="client_name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('client_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Client Phone -->
            <div>
                <label for="client_phone" class="block text-sm font-medium text-gray-700">Client Phone</label>
                <input type="tel" wire:model="client_phone" id="client_phone"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('client_phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Client Email -->
            <div>
                <label for="client_email" class="block text-sm font-medium text-gray-700">Client Email</label>
                <input type="email" wire:model="client_email" id="client_email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('client_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Problem Description -->
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Problem Description</label>
                <textarea wire:model="description" id="description" rows="4" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Assign to Officer -->
            <div>
                <label for="assigned_to" class="block text-sm font-medium text-gray-700">Assign to Officer</label>
                <select wire:model="assigned_to" id="assigned_to"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select an officer</option>
                    @foreach($officers as $officer)
                        <option value="{{ $officer->id }}">{{ $officer->name }}</option>
                    @endforeach
                </select>
                @error('assigned_to') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select wire:model="status" id="status"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="open">Open</option>
                    <option value="elevated">Elevated</option>
                    <option value="resolved">Resolved</option>
                    <option value="closed">Closed</option>
                </select>
                @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                <i class="fas fa-plus-circle mr-2"></i> Add Problem
            </button>
        </div>
    </form>
</section>
