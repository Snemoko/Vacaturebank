@extends('layouts.app')

@section('content')

<div class="container"><h1 class="text-center">Vacature verwijderen</h1></div>

<table class="text-center admin-table-users table">
        <thead>
            <tr>
                <th>Text</th>
                <th>Uren</th>
                <th>Ethiek</th>
                <th>Verwijderen</th>
            </tr>
        </thead>
    <tbody>
        @foreach ($job_offers as $vacature)
            <tr>
                <td>{{Str::limit($vacature->text,15)}}</td>
                <td>{{$vacature->hours}}</td>
                <td>{{Str::limit($vacature->ethic,15)}}</td>
                <td>
                    <form action="/admin/vacatures/delete" method="POST">
                        <input type="hidden" value="{{$vacature->id}}" name="id">
                        @csrf
                        <button>X</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
