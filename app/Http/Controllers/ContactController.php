<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $messages = Contact::all();
        return view('customer-contacts', compact('messages'));
    }
    
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
    
        return redirect()->route('contact.create')->with('success', 'Message Sent');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
    
        return redirect()->route('contact.index')->with('success', 'Deleted Message');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $messages = Contact::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%");
        })->get();

        return view("customer-contacts", compact("messages"));
    }
}
