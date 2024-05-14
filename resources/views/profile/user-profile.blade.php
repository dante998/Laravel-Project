<x-app-web-layout> <!-- Assuming you have a layout file, adjust as needed -->

    <x-slot name="header">
        <!-- Header content if needed -->
    </x-slot>
    
    <div class="container py-4">
        <div class="row">
            <div class="col-md-9 mx-auto">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Profile
                        @role('Admin') @endrole

                       {{-- @role ('User')<a href="{{ url('user-profiles') }}" class="btn btn-primary float-end me-2">Back</a> @endrole --}} 
                        
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <!-- Display other user information like profile picture, bio, etc. -->
                        
                        
                        @if ($images->count() > 0)
                            <div class="row">
                                @foreach ($images as $image)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="{{ asset($image->image_url) }}" class="card-img-top" alt="Upload">
                                            <div class="card-footer">
                                                <a href="{{ route('images.show', ['user' => strtolower($image->user->name), 'id' => $image->id]) }}" class="btn btn-primary btn-sm mx-1">View Post</a>
                                                {{-- <a href="{{ url('images/'.$image->id) }}" class="btn btn-primary btn-sm mx-1">View</a> -}}
                                                {{-- working <a href="{{ url('user-profile/'.$user->name.'/'.$image->id) }}" class="btn btn-primary btn-sm mx-1">View</a> --}}
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center">No uploads found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</x-app-web-layout>