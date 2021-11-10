@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
            <table class="text-center admin-table-users table">
                    <thead>
                        <tr>
                            <th>Bedrijfsnaam</th>
                            <th>KvK</th>
                            <th>Verwijderen</th>

                        </tr>
                    </thead>
                <tbody>
                    @foreach ($companys as $company)
                        <tr>
                            <td>{{$company->company_name}}</td>
                            <td>{{$company->kvk}}</td>
                            <td>
                                <form action="/admin/company/delete" method="POST">
                                    <input type="hidden" value="{{$company->id}}" name="id">
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

@endsection
