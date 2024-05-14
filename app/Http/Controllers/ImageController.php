<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageFormRequest;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create image', ['only' => ['create','store']]);
        $this->middleware('permission:view image', ['only' => ['index']]);
        $this->middleware('permission:update image', ['only' => ['edit','update']]);
        $this->middleware('permission:delete image', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $images = Image::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index', compact('images'));
    }

    public function create() 
    {
        return view('posts.image-create');
    }

    public function store(ImageFormRequest $request)
    {
        $request->validated();

        // Get the authenticated user
        $user = auth()->user();

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $path = 'uploads/image/';
            $file->move($path, $fileName);
        }

        $image = new Image([
            'name' => $request->name,
            'description' => $request->description,
            'image_url' => $path.$fileName,
            'user_id' => $user->id, // Associate the authenticated user
        ]);
        $image->save();
        
        if(Auth::check())
        {
            /** @var App\Models\User */
            $user = Auth::user();

            // Check if the user role is 'user', then redirect to their dashboard
            if ($user->hasRole('User')) {
            return redirect('/dashboard')->with('status', 'Image added successfully!');
        }
            return redirect('/images/create')->with('status', 'Image added.');
    }
}
    
    public function edit(int $id)
    {
        $image = Image::findOrFail($id);
        return view('posts.image-edit', compact('image'));
    }

    public function update(ImageFormRequest $request, int $id)
    {
        $request->validated();

        $image = Image::findOrFail($id);
        
        $image->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $path = 'uploads/image/';
            $file->move($path, $fileName);
        
            if (File::exists($image->image_url)) {
            File::delete($image->image_url);
        }

        $image->update([
            'image_url' => $path.$fileName,
        ]);
    }
    return redirect()->back()->with('status', 'Image updated successfully!');
}

    public function destroy(int $id)
    {
        $image = Image::findOrFail($id);
        $image->delete();
        return redirect()->back()->with('status', 'Image deleted successfully!');
    }

    public function show($user, int $id)
    { 
        $image = Image::findOrFail($id);
        return view('posts.image-show', compact('user', 'image'));
    }

    public function storeComment(Request $request, $id)
    {
    // Validate the request
    $request->validate([
        'content' => 'required|string',
    ]);

    // Find the image
    $image = Image::findOrFail($id);

    // Create a new comment
    $comment = new Comment();
    $comment->user_id = auth()->user()->id; // Assuming user is authenticated
    $comment->image_id = $image->id;
    $comment->content = $request->input('content');
    $comment->save();

    return back()->with('status', 'Comment added successfully!');
    }

    public function destroyComment($id)
    { 
    // Find the comment by its ID
    $comment = Comment::findOrFail($id);

    // Check if the authenticated user is the owner of the comment
    if ($comment->user_id !== auth()->id()) {
        // If not, abort with a 403 Forbidden status
        abort(403, 'Unauthorized action.');
    }

    // Delete the comment
    $comment->delete();

    // Redirect back with a success message
    return back()->with('status', 'Comment deleted successfully!');
    }
}
