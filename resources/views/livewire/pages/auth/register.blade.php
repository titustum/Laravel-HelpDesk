<?php

use App\Models\User;
use App\Models\Department;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $role = '';
    public string $designation = '';
    public string $department_id = '';
    public string $extension_number = '';
    public string $office_number = '';
    public string $password = '';
    public $departments = [];

    public function mount(){
        $this->departments = Department::all();
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'numeric'],
            'extension_number' => ['required', 'string', 'max:255'],
            'office_number' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required', 'string', 'in:client,officer,admin,superadmin'],
            'password' => ['required', 'string', Rules\Password::defaults()],
        ]);



        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        if (Auth::user()->role == 'admin') {
            $this->redirect(route('admin.dashboard'));
        }
        elseif (Auth::user()->role == 'officer') {
            $this->redirect(route('officer.dashboard'));
        }
        else{
            $this->redirect(route('client.dashboard'));
        }
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block w-full mt-1" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Department -->
        <div class="mt-4">
            <x-input-label for="department_id" :value="__('Department')" />
            <select wire:model="department_id" id="department_id" class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="text" name="department_id" required>
                <option value="">Choose...</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
        </div>

        <!-- Ext. No -->
        <div class="mt-4">
            <x-input-label for="office_number" :value="__('Office Number')" />
            <x-text-input wire:model="office_number" id="office_number" class="block w-full mt-1" type="text" name="office_number" required/>
            <x-input-error :messages="$errors->get('office_number')" class="mt-2" />
        </div>


        <!-- Designation -->
        <div class="mt-4">
            <x-input-label for="designation" :value="__('Designation')" />
            <x-text-input wire:model="designation" id="designation" class="block w-full mt-1" type="text" name="designation" required placeholder="e.g. Human Resource Officer" />
            <x-input-error :messages="$errors->get('designation')" class="mt-2" />
        </div>

        <!-- Ext. No -->
        <div class="mt-4">
            <x-input-label for="extension_number" :value="__('Extension Number')" />
            <x-text-input wire:model="extension_number" id="extension_number" class="block w-full mt-1" type="number" name="extension_number" required/>
            <x-input-error :messages="$errors->get('extension_number')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block w-full mt-1" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- User role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Your Role')" />
            <select wire:model="role" id="role" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="text" name="role" required>
                <option value="">Choose..</option>
                <option value="client">Client</option>
                <option value="officer">Officer</option>
                <option value="admin">Admin</option>
                <option value="superadmin">Superadmin</option>

            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
