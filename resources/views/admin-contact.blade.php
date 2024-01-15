@extends('layouts/master') 

@section('content')
    <div class="container">
        <h1 class="title">Messages</h1>

        <div class="row">
            @forelse ($messages as $message)
                <div class="col-12 mb-4"> 
                    <div class="border p-3">
                        <p><strong>Name:</strong> {{ $message->name }}</p>
                        <p><strong>Email:</strong> {{ $message->email }}</p>
                        <p><strong>Description:</strong> {{ $message->description }}</p>
                        @if (Auth::user() && Auth::user()->role === 'admin')
                        <div class="card-body">
                            <div class="d-flex">
                                        <form method="POST" action="{{ route('contact.destroy', ['contact' => $message->id]) }}" onsubmit="return confirm('Delete this message?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary ms-2">Delete</button>
                                    </form>
                                </div>
                           </div>
                         @endif  
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>You have no messages!</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
