<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        // Send email
        Mail::to('baaishajar20@gmail.com')->send(new ContactFormMail($validated));

        return response()->json(['success' => true]);
    }
}