@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-light fw-bold" style="float: left;">Add Users</h4>
                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addUser">
                        <i class="fa fa-plus"></i> Add New Users
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    @if($user->is_admin == 1) Admin 
                                    @else Cashier 
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editUser{{ $user->id }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $user->id }}">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            {{-- Edit User Modal --}}
                            <div class="modal right fade" id="editUser{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="staticBackdropLabel">Edit User</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Enter name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="Enter Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Phone</label>
                                                    <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" placeholder="Enter phone">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Password</label>
                                                    <input type="password" name="password" readonly value="{{ $user->password }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Role</label>
                                                    <select name="is_admin" class="form-control">
                                                        <option value="1" @if($user->is_admin == 1) selected @endif>Admin</option>
                                                        <option value="2" @if($user->is_admin == 2) selected @endif>Cashier</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-warning btn-block">Update User</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

          {{-- Delete User Modal --}}
          <div class="modal right fade" id="deleteUser{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Delete User</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            
                           <p>Are you sure you want to delete this {{ $user->name }}?</p>
                            
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-default" data-bs-dismiss="modal">Cancel</button>

                                <button type="submit" class="btn btn-danger" >Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>                    

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Sidebar: Search User -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-light">Search User</h4>
                </div>
                <div class="card-body">
                    <input type="text" class="form-control" placeholder="Search user...">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Add User -->
<div class="modal right fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter phone">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="is_admin" class="form-control">
                            <option value="1">Admin</option>
                            <option value="2">Cashier</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
