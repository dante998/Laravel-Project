<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contacts.show');
    }

    public function submit(ContactRequest $request)
    {
         Mail::to('recipient')->send(new ContactMail($request->name, $request->email, $request->content));

        return to_route('dashboard')->with('status', 'Message has been sent successfully!');
    }
}