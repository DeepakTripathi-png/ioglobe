<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        Contact::create($request->all());
        return redirect()->back()->with('success', 'Message sent successfully.');
    }
}
