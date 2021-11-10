@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-md-center">
        <div class="container">
                @include('layouts.ad')
        </div>


        @foreach($users as $user)
            <div class="col-md-3 user">
                <div class="user-info">

                    <div>Naam:: {{ $user->first_name .  " " .  $user->last_name }}</div>
                    <div>Telefoon:: {{ $user->phone_number }}</div>
                    <div>Stad:: {{ $user->city }}</div>
                    <div>Email:: {{$user->email }}</div>

                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection('content')
