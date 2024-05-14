<x-app-web-layout>

    @include('role-permission.nav-links')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if (@session('status'))
                 <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Users
                            <a href="{{ url('users/create') }}" class="btn btn-primary float-end">Add User</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $roleName)
                                        <label class="badge bg-primary mx-1">{{ $roleName }}</label>    
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-success">Edit</a>
                                        <a href="{{ url('users/'.$user->id.'/delete') }}" class="btn btn-danger mx-2">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-web-layout>