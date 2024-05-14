<x-app-web-layout>
    
    <x-slot:title>
        Image Create
    </x-slot>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif


        <div class="card">
            <div class="card-header">
                <a href="{{ url('dashboard') }}" class="btn btn-primary float-end">Back</a>
                <h4>Add Images
                    {{-- <a href="{{ url('images') }}" class="btn btn-primary float-end">Back</a>  --}}
                </h4>
            </div>
                
            <div class="card-body"></div>
            
            <form action="{{ url('images/create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    

                <div class="mb-3">
                    <label>Image Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" />
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label>Image Description</label>
                    <textarea name ="description" class="form-control" rows="3"> </textarea> 
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label>Upload File</label>
                    <input type="file" name="image" class="form-control" />
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
    
 



</x-app-web-layout>
   