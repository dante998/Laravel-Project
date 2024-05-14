<x-app-web-layout>

    <x-slot name="title">
        {{ $image->name }}
    </x-slot>    

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        <a href="{{ url('/dashboard') }}" class="btn btn-primary float-end me-2">Back</a>
                        <a href="{{ url('user-profile/'.strtolower($image->user->name)) }}" class="btn btn-primary float-end me-2">View Profile</a>
                        @role('Admin')
                        <a href="{{ url('images') }}" class="btn btn-primary float-end me-2">Back</a>
                        @endrole

                        @role('User')
                        <a href="{{ url('userprofile', ['id' => $image->user_id]) }}"></a>
                        {{-- <a href="{{ url('dashboard') }}" class="btn btn-primary float-end me-2">Back</a> --}}
                        @endrole
                        <h4>{{ $image->name }}</h4>
                    </div>
                    <div class="card-body" style="position: relative;">
                        <h5>  {{ $image->description }} </h5>
                        <img src="{{ asset($image->image_url) }}" style="max-width: 100%;" alt="{{ $image->name }}">
                        
                        

                        
                        <!-- Render comments -->
                        @if($image->comments->isNotEmpty())
                        <div class="card-footer">
                            <h5>Comments:</h5>
                            @foreach ($image->comments as $comment)
                                <div class="card mb-3">
                                    <div class="card-body">
                               
                                        @if($comment->user)
                                            <strong>{{ $comment->user->name }}:</strong>
                                        @else
                                            <strong>Unknown User:</strong>
                                        @endif
                                        {{ $comment->content }}
                                    </div>
                                    @auth
                                    @if ($comment->user_id === auth()->id())
                                    
                                    <!-- Button to delete comment -->
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger ms-auto">Delete</button>
                                                </form>
                                            
                                        @endif
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Form to add a new comment -->
                    <div class="card-footer">
                        <form action="{{ route('images.comments.store', $image->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="content">Add Comment:</label>
                                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-web-layout>