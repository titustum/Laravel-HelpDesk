<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Problem;
use App\Models\User;

new
#[Layout('layouts.admin-layout')]
class extends Component {
    public $client_phone = '';
    public $description = '';

    private function generateTicket()
    {
        return "TKT-" . strtoupper(uniqid());
    }

    public function store()
    {
        $validatedData = $this->validate([
            'client_phone' => 'nullable|string|max:20',
            'description' => 'required|string',
        ]);

        $problem = Problem::create($validatedData + [
            'client_name' => Auth::user()->name,
            'client_email' => Auth::user()->email,
            'created_by' => Auth::user()->id,
            'ticket' => $this->generateTicket(),
            'assigned_to' => null
        ]);

        $this->reset();

        session()->flash('success', 'Problem added successfully.');
        $this->redirect(route('client.problems'));
    }
};

?>

<section class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="mb-4 text-2xl font-bold">Add New Problem</h2>

    <form wire:submit="store">
        <div class="grid grid-cols-1 gap-4 ">

            <!-- Client Phone -->
            <div>
                <label for="client_phone" class="block text-sm font-medium text-gray-700">Client Phone</label>
                <input type="tel" wire:model="client_phone" id="client_phone"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('client_phone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>


            <!-- Problem Description -->
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Problem Description</label>
                <textarea wire:model="description" id="description" rows="4" required
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('description') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="mt-6">
            <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25">
                <i class="mr-2 fas fa-plus-circle"></i> Add Problem
            </button>
        </div>
    </form>
</section>
