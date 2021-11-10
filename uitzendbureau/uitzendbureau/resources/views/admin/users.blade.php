@extends('layouts.app')

@section('content')
<div class="container">
    @if ($melding ?? '')
        <div class="error text-center">U kunt niet uw zelf verwijderen</div>
    @endif
</div>
<div class="container ">
    <div class="row  ">
        <table class="text-center admin-table-users table">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Achternaam</th>
                        <th>Woonplaats</th>
                        <th>Telefoon-nummer</th>
                        <th>E-mail</th>
                        <th>Verwijderen</th>
                    </tr>
                </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->city}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <form action="/admin/user/delete" method="POST">
                                <input type="hidden" value="{{$user->id}}" name="id">
                                @csrf
                                <button>X</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection('content')
