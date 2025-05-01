<div class="card">
    <div class="card-header">Manage Users</div>
    <div class="card-body">
        <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" wire:model="name">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" wire:model="email">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" wire:model="password">
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" id="role" wire:model="role">
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                {{ $editing ? 'Update User' : 'Create User' }}
            </button>
            @if($editing)
                <button type="button" class="btn btn-secondary" wire:click="resetForm">Cancel</button>
            @endif
        </form>

        <hr>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->first()->name }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" wire:click="edit({{ $user->id }})">Edit</button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $user->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
