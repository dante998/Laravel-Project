<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserProfileController extends Controller
{
    public function index()
    {
            // Fetch users with the count of their uploaded photos, excluding users with the role 'admin'
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->where('name', 'Admin');
            })
            ->withCount('images')
            ->orderByDesc('images_count')
            ->paginate(10);
    
        return view('profile.user-profiles', compact('users'));
    }

    public function show($name)
    {
        $user = User::where('name', $name)->firstOrFail();
        // Fetch user information and uploads
        $images = $user->images()->orderBy('created_at', 'desc')->paginate(10);

        // Return the view with user information and uploads
        return view('profile.user-profile', compact('user', 'images'));
    }
}
