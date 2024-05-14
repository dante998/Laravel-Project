<x-app-web-layout>

    <x-slot name="header">
        <!-- Header content if needed -->
    </x-slot>
 
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <h2>All Users</h2>
                @if ($users->count() > 0)
                    <ul class="list-group">
                        @foreach ($users as $user)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                @if ($user->id === Auth::id())
                                <a href="{{ url('dashboard') }}">{{ $user->name }}</a> 
                                @else
                                {{ $user->name }} 
                                @endif
                                <span class="badge bg-secondary">{{ $user->images_count }} photos</span>
                                @if ($user->id === Auth::id())
                                <a href="{{ url('dashboard') }}"></a> <!-- Button to current user's dashboard -->
                                @else
                                <a href="{{ url('user-profile/'.strtolower($user->name)) }}" class="btn btn-primary">View Profile</a>
                                @endif
                            </div>
                        </li>
                    @endforeach
                    </ul>
                    <!-- Pagination links -->
                    {{ $users->links() }}
                    @else
                    <p>No users found.</p>
                    @endif
            </div>
        </div>
    </div>
                
</x-app-web-layout>