@extends('layouts.dashboard')
@section('title', 'User | Velzon')
@section('sub-title', 'User Account')
@section('content')

    <div class="row">
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title flex-grow-1 mb-0">Users</h4>
                    <div class="d-flex align-items-center">
                        <form action="{{route('users.index')}}" class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search...">
                            <button class="btn btn-outline-secondary" type="submit">
                                Search
                            </button>
                        </form>
                        <button type="button" class="btn btn-soft-success btn-sm ms-2" data-bs-toggle="modal"
                            data-bs-target="#createModal">Create User</button>
                    </div>
                </div><!-- end cardheader -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-centered align-middle">
                            <thead class="bg-light text-muted">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr><!-- end tr -->
                            </thead><!-- thead -->

                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <th scope="row">{{ $users->firstItem() + $key }}</th>
                                        <td>{{ $user['username'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>{{ $user->roles['name'] }}</td>
                                        <td class="d-flex gap-1">
                                            <button type="button" class="badge badge-soft-warning edit-btn"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="{{ $user['id'] }}" data-username="{{ $user['username'] }}"
                                                data-email="{{ $user['email'] }}" data-password="{{ $user['password'] }}"
                                                data-role="{{ $user->roles['name'] }}">Edit</button>
                                            <button type="button" class="badge badge-soft-danger delete-btn"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $user['id'] }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div>
                    <div class="mt-3">
                        {{ $users->links() }}
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

    {{-- Modal Create User --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Role:</label>
                            <select class="form-select" id="role_id" name="role_id" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editUsername" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="editUsername" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="editPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="editRoleId" class="form-label">Supplier:</label>
                            <select class="form-select" id="editRoleId" name="role_id" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <p>Are you sure you want to delete this account?</p>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const username = this.getAttribute('data-username');
                    const email = this.getAttribute('data-email');
                    const password = this.getAttribute('data-password');
                    const role = this.getAttribute('data-role');
                    const editFormAction = `{{ route('users.update', ':id') }}`;

                    document.getElementById('editUsername').value = username;
                    document.getElementById('editEmail').value = email;
                    document.getElementById('editPassword').value = password;
                    document.getElementById('editRoleId').text = role;
                    document.getElementById('editForm').action = editFormAction.replace(':id',
                        id);

                    const modal = new bootstrap.Modal(document.getElementById('editModal'));
                    modal.show();
                });
            });
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const deleteFormAction = `{{ route('users.destroy', ':id') }}`;
                    document.getElementById('deleteForm').action = deleteFormAction.replace(':id',
                        id);

                    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                    modal.show();
                });
            });
        });
    </script>

    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "{{ Session::get('success') }}",
                showConfirmButton: false,
                timer: 4000,
            });
        </script>
    @endif
@endsection
