<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;


class UserImageController extends Controller
{
    /**
     * Display a listing of the user's images.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            /** @var App\Models\User */
            $user = Auth::user();
    
            // Check if the user has the role 'User'
            if ($user->hasRole('User')) {
                // Fetch images associated with the authenticated user, ordered by creation date
                $images = $user->images()->orderBy('created_at', 'desc')->paginate(10);
    
                // Return the view with the images variable
                return view('profile.dashboard', compact('images'));
            } else {
                // If the user does not have the 'User' role, redirect to some other page or return an error message
                return redirect()->route('images.index');
            }
        } else {
            // If the user is not authenticated, redirect to the login page or return an error message
            return redirect()->route('login');
        }
    }
}
