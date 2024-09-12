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
    }

    public function deleteProblem($id){
        $problem = Problem::findOrFail($id);
        $problem->delete();

        session()->flash('message', 'Problem successfully deleted.');
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

    <div class="mt-8 overflow-hidden bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700">Your Assigned Problems</h3>
        </div>
        <table class="w-full">
            <thead>
                <tr class="text-left bg-gray-50">
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Ticket</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Client</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Department</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Sample row, repeat as needed -->
                @foreach (Auth::user()->problems as $problem)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $problem->ticket }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $problem->clientReported->name ?? '' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $problem->clientReported->department->name ?? '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($problem->status === 'open') bg-red-100 text-red-800
                            @elseif($problem->status === 'elevated') bg-yellow-100 text-yellow-800
                            @elseif($problem->status === 'resolved') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $problem->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                        <a href="{{ route('officer.problems.show', $problem->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>

