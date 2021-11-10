
@extends('layouts.app')

@section('content')

<div class="container">
<h1 class="text-center">Welkom {{Auth::user()->first_name}}</h1>
</div>
<div class="container ">
    <div class="row ">
            <a href="/admin/user" class="col-md admin-panel" >User overzicht <div class="text-right arrow">&rarr;</div></a>
            <a class="col-md admin-panel" href="/admin/company" >Company overzicht <div class="text-right arrow">&rarr;</div></a>
    </div>
    <div class="row ">
        <a class="col-md admin-panel" href="/admin/vacatures" >Vacatures overzicht <div class="text-right arrow">&rarr;</div></a>
        <a class="col-md admin-panel" href="/admin/advert">Advertentie overzicht<div class="text-right arrow">&rarr;</div></a>
    </div>

</div>

@endsection('content')
