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
            Add New Officer
        </a>
    </div>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                    ID
                </th>
                <th class="px-4 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                    Name
                </th>
                <th class="px-4 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                    Email
                </th>
                <th class="px-4 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                    Role
                </th>
                <th class="px-4 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($officers as $officer)
                <tr>
                    <td class="px-4 py-2 border-b border-gray-200">{{ $officer->id }}</td>
                    <td class="px-4 py-2 border-b border-gray-200">{{ $officer->name }}</td>
                    <td class="px-4 py-2 border-b border-gray-200">{{ $officer->email }}</td>
                    <td class="px-4 py-2 border-b border-gray-200">{{ $officer->role }}</td>
                    <td class="px-4 py-2 border-b border-gray-200"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
