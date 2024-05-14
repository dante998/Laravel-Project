<x-app-web-layout>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Contact Form</h4>
                        <a href="{{ url('dashboard') }}" class="btn btn-primary float-end">Back</a>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Message:</label>
                                <textarea id="content" name="content" class="form-control" rows="4" required></textarea>
                                @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-web-layout>