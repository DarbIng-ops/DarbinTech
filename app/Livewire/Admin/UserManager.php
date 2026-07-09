<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class UserManager extends Component
{
    use WithPagination;

    public string $search    = '';
    public bool   $showModal = false;
    public ?int   $editingId = null;

    public string $name     = '';
    public string $email    = '';
    public string $password = '';
    public string $role     = 'client';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function openCreate(): void
    {
        $this->reset(['name', 'email', 'password', 'editingId']);
        $this->role = 'client';
        $this->resetValidation();
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $user = User::findOrFail($id);

        $this->editingId = $id;
        $this->name      = $user->name;
        $this->email     = $user->email;
        $this->role      = $user->role;
        $this->password  = '';
        $this->resetValidation();
        $this->showModal = true;
    }

    public function save(): void
    {
        $rules = [
            'name'  => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->editingId)],
            'role'  => 'required|in:admin,client',
        ];

        if ($this->editingId === null) {
            $rules['password'] = 'required|string|min:8';
        } elseif ($this->password !== '') {
            $rules['password'] = 'string|min:8';
        }

        $this->validate($rules);

        if ($this->editingId) {
            $data = ['name' => $this->name, 'email' => $this->email, 'role' => $this->role];
            if ($this->password !== '') {
                $data['password'] = $this->password;
            }
            User::findOrFail($this->editingId)->update($data);
        } else {
            User::create([
                'name'     => $this->name,
                'email'    => $this->email,
                'password' => $this->password,
                'role'     => $this->role,
            ]);
        }

        $this->showModal = false;
        $this->reset(['name', 'email', 'password', 'editingId']);
        $this->role = 'client';
    }

    public function delete(int $id): void
    {
        User::destroy($id);
    }

    public function render(): \Illuminate\View\View
    {
        $users = User::query()
            ->when($this->search, fn ($q) => $q
                ->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%"))
            ->latest()
            ->paginate(15);

        return view('livewire.admin.user-manager', compact('users'));
    }
}
