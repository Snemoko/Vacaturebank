@extends('layouts.app')

@section('content')
<div class="container text-center">
    <form action="/job/seeker/search" method="post" class="search">
        <input type="text" name="search" placeholder="zoeken">
        @csrf
    </form>
</div>
<div class="container">
    <div class="row justify-content-md-center werkzoekende">
        @foreach($users as $user)
            <div class="col-md-3 job-offer">
                <div class="job-beschrijving">{{$user->first_name}} {{$user->last_name}}</div><br>
                <div class="job-beschrijving">{{$user->category}}</div>
                <div class="job-beschrijving">{{$user->city}}</div>
                <div class="job-beschrijving">{{$user->email}}</div>
                <div class="job-beschrijving"><a href="/profile/{{ $user->id }}">profiel</a></div>
                @if ($user->seeker_id)
                    <div class="download-buttons-profile text-center mt-3">
                        <a class="download" href='/download/{{$user->motivation}}'>motivation</a>
                        <a class="download" href='/download/{{$user->portfolio}}'>portfolio</a>
                    </div>
                @endif
                @if (Auth::user()->roll == 2 || Auth::user()->roll == 0)
                    <form action="/bedrijfmail" method="POST">
                        <input type="hidden" name="company_id" value="{{$user->id}}">
                        <input type="hidden" name="email" value="{{$user->email}}">
                        @csrf
                        <button>Solliciteer!</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
