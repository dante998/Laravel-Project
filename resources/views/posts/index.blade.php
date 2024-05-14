<x-app-web-layout>

    <x-slot name="title">
        Images
    </x-slot>    

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Images
                    <a href="{{ url('images/create') }}" class="btn btn-primary float-end">Add Image</a>
                    </h4>
                </div>
                <div class="card-body">
                    
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image_url</th>
                                <th>Image</th>
                                <th>Owner</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($images as $image)
                                <tr>
                                    <td>{{ $image->id }}</td>
                                    <td>{{ $image->name }}</td>
                                    <td>{{ $image->description }}</td>
                                    <td>{{ $image->image_url }}</td>
                                    <td style="text-align: center;"><img src="{{ asset($image->image_url) }}" style="width: 90px; height:70px" alt="Img" /> </td>
                                    <td>{{ $image->user->name }}</td>
                                    <td>
                                        <a href="{{ url('images/'.$image->id.'/edit') }}" class="btn btn-success mx-1">Edit</a>
                                        <a href="{{ url('images/'.$image->id.'/delete') }}" 
                                            class="btn btn-danger mx-1" 
                                            onclick="return confirm('Are you sure?')">Delete</a>
                                        <!-- View button -->
                                        <a href="{{ route('images.show', ['user' => $image->user->name, 'id' => $image->id]) }}" class="btn btn-primary mx-1">View Post</a>
                                        {{-- <a href="{{ url('images/'.$item->id) }}" class="btn btn-primary mx-1">View</a> --}}
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





   {{--   <x-slot:title>
        Custom Title
    </x-slot>
    
    <div class="py-5">
         <div class="container">
            @php
                $successMessage = "Saved Successfully!";
                $type = "success";
            @endphp
            <x-alert-message :type="$type" :message="$successMessage"/>
        <hr>   

        <h4>Welcome to Index Page</h4>

        <hr>
        <x-form.label value="My first name"/>
        <x-form.label>
            My slot first name
        </x-form.label>    
    </div>
</div>

    <x-slot:scripts>
        <script>
            //alert('this is my script');
        </script>
    </x-slot> --}}