<?php
namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserManagement extends Component
{
    public $users;
    public $name, $email, $password, $role;
    public $editing = false;
    public $editUserId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:8',
        'role' => 'required|in:admin,user',
    ];

    public function mount()
    {
        $this->users = User::with('roles')->get();
    }

    public function render()
    {
        return view('livewire.user-management');
    }

    public function create()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        if ($this->role) {
            $user->assignRole($this->role);
        } else {
            $user->assignRole('user'); // Default role
        }

        $this->resetForm();
        $this->users = User::with('roles')->get();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->editUserId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = optional($user->roles->first())->name ?? '';
        $this->editing = true;

        $this->rules['email'] = 'required|string|email|max:255|unique:users,email,' . $id;
        $this->rules['password'] = 'nullable|string|min:8';
    }

    public function update()
    {
        $this->validate();

        $user = User::findOrFail($this->editUserId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : $user->password,
        ]);

        if ($this->role) {
            $user->syncRoles([$this->role]);
        } else {
            $user->syncRoles(['user']); // Default role
        }

        $this->resetForm();
        $this->users = User::with('roles')->get();
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        $this->users = User::with('roles')->get();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = '';
        $this->editing = false;
        $this->editUserId = null;
        $this->resetValidation();
    }
}
