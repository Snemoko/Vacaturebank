@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="container">
                @include('layouts.ad')
        </div>
        <div class="container text-center">
            <form action="/board/search" method="get" class="search">
                <input type="text" name="search" placeholder="zoeken">
                @csrf
            </form>
        </div>

        @forelse($job_offers as $job_offer)
            <div class="col-md-3 job-offer">
                <div class="job-beschrijving">{{$job_offer->job_title}}</div><br>
                <div>Categorie: {{$job_offer->category}}</div>
                <div >Beschrijving: {{$job_offer->text}}</div>
                @if ($job_offer->ethic)
                    <div>Ethic:{{$job_offer->ethic}}</div>
                @endif
                <div>Uren: {{$job_offer->hours}}</div>
                <div>{{$job_offer->labor_contract}}</div>
                <div>{{$job_offer->working_conditions}}</div>
                <div>{{$job_offer->contract}}</div>
                <div>{{$job_offer->dismissal}}</div>
                <div>{{$job_offer->health_safety}}</div>
                @if (Auth::user()->roll == 1)
                    <form action="/solliciteer" method="POST">
                        <input type="hidden" name="job_title" value="{{$job->job_title}}">
                        <input type="hidden" name="job_title" value="{{$job->id}}">
                        @csrf
                        <button>Solliciteer!</button>
                    </form>
                @endif
            </div>
            @empty
            <h1>Er zijn geen banen gevonden</h1>
            @endforelse
    </div>
</div>
@endsection
