<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Problem;
use App\Models\User;

new
#[Layout('layouts.officer-layout')]
class extends Component {

    public $problem;
    public $status;
    public $assigned_to;
    public $solution;

    public function mount($id){
        $this->problem = Problem::findOrFail($id);
        $this->officers = User::where('role', 'officer')->get();
        $this->solution = $this->problem->solution;
    }

    public function updateProblem()
    {
        $this->validate([
            'status' => 'required|in:Open,In Progress,Resolved,Elevated,Closed',
            'solution' => 'required|string',
        ]);

        $this->problem->update([
            'status' => $this->status,
            'solution' => $this->solution,
        ]);

        session()->flash('message', 'Problem updated successfully.');
    }

};
?>

<div class="py-8">
    <h2 class="text-2xl font-semibold mb-6">Problem Details</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Problem #{{ $problem->id }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Created on {{ $problem->created_at->format('F j, Y, g:i a') }}
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Client Name
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $problem->client_name }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Client Contact
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $problem->client_phone }} / {{ $problem->client_email }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Problem Description
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $problem->description }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Status
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <select wire:model="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="Open">Open</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Resolved">Resolved</option>
                            <option value="Elevate">Elevate</option>
                            <option value="Closed">Closed</option>
                        </select>
                    </dd>
                </div>

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Solution
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <textarea wire:model="solution" rows="4" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="mt-6">
        <button wire:click="updateProblem" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Update Problem
        </button>
    </div>
</div>
