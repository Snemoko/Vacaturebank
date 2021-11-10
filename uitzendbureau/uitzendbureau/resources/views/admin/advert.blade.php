@extends('layouts.app')

@section('content')

<div class="container">
        <table class="text-center admin-table-users table">
                <thead>
                    <tr>
                        <th>image</th>
                        <th>verwijderen</th>
                    </tr>
                </thead>
            <tbody>
                @foreach ($ads as $ad)
                    <tr>
                        <td><img src="/image/ad/{{$ad->text}}" alt="hello" width="100px"></td>
                        <td>
                            <form action="/admin/advert/delete" method="POST">
                                <input type="hidden" name="id" value="{{$ad->id}}">
                                <input type="hidden" name="text" value="{{$ad->id}}">
                                @csrf
                                <button>X</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>

@endsection
