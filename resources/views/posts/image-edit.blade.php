<x-app-web-layout>
    
    <x-slot:title>
        Image Edit
    </x-slot>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                    <h4> Edit Images
                        <a href="{{ url('images') }}" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('images/'.$image->id.'/edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                <div class="mb-3">
                    <label>Image Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $image->name }}"  />
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label>Image Description</label>
                    <textarea name ="description" class="form-control" rows="3">{{ $image->description }} </textarea> 
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <img src="{{ asset($image->image_url) }}" alt="{{ $image->name }}" class="form-control" style="width: 150px; height: auto;">
                    <input type="hidden" name="current_image" value="{{ $image->image_url }}">
                </div>
                <div class="mb-3">
                    <label>Upload File</label>
                    <input type="file" name="image" class="form-control" />
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>  
</div>
</x-app-web-layout>