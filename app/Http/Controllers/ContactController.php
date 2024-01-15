<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function create()
    {
        return view("contact");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required',
        ]);
    
        if ($validator->fails())
        {
            return redirect()->route('contact.create')->withErrors($validator);
        }

        Contact::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'description' => $request->get('description'),
        ]);
    
        return redirect()->route('contact.create')->with('success', 'MessageSent');
    }
    public function index()
    {
        $messages = Contact::all();
        return view('admin-contact', compact('messages'));
    }
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
    
        return redirect()->route('contact.index')->with('success', 'Deleted Message');
    }
}
