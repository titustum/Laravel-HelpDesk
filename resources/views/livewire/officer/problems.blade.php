<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Problem;
use App\Models\User;

new
#[Layout('layouts.officer-layout')]
class extends Component {

    public $search;
    public $problems;
    public $flashMessage = '';

    public function mount()
    {
        $this->search = '';
    }

    public function deleteProblem($id){
        $problem = Problem::findOrFail($id);
        $problem->delete();

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

    <div class="mt-8 bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700">Your Assigned Problems</h3>
        </div>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 text-left">
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    {{-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Problem</th> --}}
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Sample row, repeat as needed -->
                @foreach (Auth::user()->problems as $problem)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $problem->id }}</td>
                    {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $problem->description }}</td> --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $problem->client_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($problem->status === 'Open') bg-red-100 text-red-800
                            @elseif($problem->status === 'In Progress') bg-yellow-100 text-yellow-800
                            @elseif($problem->status === 'Resolved') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $problem->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('officer.problems.show', $problem->id) }}" class="text-indigo-600 hover:text-indigo-900">Update</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>

