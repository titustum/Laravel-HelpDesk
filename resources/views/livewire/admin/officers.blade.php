<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\User;

new
#[Layout('layouts.admin-layout')]
class extends Component  {

    public $officers = [];

    public function mount(){
        $this->officers = User::where('role','officer')->get();
    }


}; ?>

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
            Add New Officer
        </a>
    </div>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    ID
                </th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($officers as $officer)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $officer->id }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $officer->name }}</td>
                    <td class="py-2 px-4 border-b border-gray-200"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
