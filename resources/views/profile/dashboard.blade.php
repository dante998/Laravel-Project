<x-app-web-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">

                                        @if (session('status'))
                                        <div class="alert alert-success">{{ session('status') }}</div>
                                        @endif

                                        <a href="{{ url('images/create') }}" class="btn btn-primary float-end">Add Image</a>
                                        @if(Auth::check())
                                        <h1>{{ Auth::user()->name }}</h1>
                                        @endif
                                        <h5>Your Posts:</h5>
                                       
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($images as $image)
                                                <div class="col-md-4 mb-4">
                                                    <div class="card">
                                                        <div style="text-align: center;">
                                                        <h5 class="card-title">{{ $image->name }}</h5>
                                                        <img src="{{ asset($image->image_url) }}" class="card-img-top" alt="{{ $image->name }}" style="width: 75%; height: auto;">
                                                        <div class="card-body">
                                                            
                                                            <a href="{{ route('images.show', ['user' => strtolower($image->user->name), 'id' => $image->id]) }}" class="btn btn-primary mx-1">View Post</a>
                                                            {{-- <a href="{{ url('images/'.$image->id) }}" class="btn btn-primary mx-1">View</a>  --}}
                                                            <a href="{{ url('images/'.$image->id.'/delete') }}" 
                                                                class="btn btn-danger mx-1" 
                                                                onclick="return confirm('Are you sure?')">Delete</a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-web-layout>
