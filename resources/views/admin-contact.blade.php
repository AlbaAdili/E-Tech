@extends('layouts/master') 

@section('content')
    <div class="container">
        <h1 class="title">Messages</h1>
        
        <div class="mt-5 d-flex justify-content-between" style="margin: 0 70px;">
            <form action="{{ route('contact.search') }}" method="POST" class="d-flex">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search by name or email">
                            <button type="submit" class="btn btn-primary" style="background-color: white; color: blue;">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>  
        
    <div class="mt-3">
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
</div>
@endsection
