@extends('layouts.app')

@section('content')
<div class="container">

<div class="card">
        <div class="card-header">Profiel</div>
            <div class="card-body profiel-card">
                <div><strong>Voornaam:</strong> {{$user->first_name ?? ""}}</div>
                <div><strong>Achternaam:</strong>  {{$user->last_name ?? ""}}</div>
                <div><strong>Telefoon-nummer: </strong> {{$user->phone_number ?? ""}}</div>
                <div><strong>E-mail: </strong>{{$user->email ?? ""}}<br></div>
                <div><strong>Stad:</strong> {{$user->city ?? ""}}</div>
                @if ($user->job_seeker)
                    <div class="download-buttons-profile text-center">
                        <a class="download" href='/download/{{$user->job_seeker->motivation}}'>motivation</a>
                        <a class="download" href='/download/{{$user->job_seeker->portfolio}}'>portfolio</a>
                    </div>
                @endif
            </div>
        </div>
</div>
@endsection
