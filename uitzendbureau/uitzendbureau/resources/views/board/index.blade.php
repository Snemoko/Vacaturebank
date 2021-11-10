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

        @foreach($jobs as $job)
            <div class="col-md-3 job-offer">
                <div class="job-beschrijving">{{$job->job_title}}</div><br>
                <div>Categorie: {{$job->category}}</div>
                <div >Beschrijving: {{$job->text}}</div>
                @if ($job->ethic)
                    <div>Ethic:{{$job->ethic}}</div>
                @endif

                <div>Uren: {{$job->hours}}</div>
                <div>{{$job->labor_contract}}</div>
                <div>{{$job->working_conditions}}</div>
                <div>{{$job->contract}}</div>
                <div>{{$job->dismissal}}</div>
                <div>{{$job->health_safety}}</div>
                @if (Auth::user()->roll == 1 || Auth::user()->roll == 0)
                    <form action="/solliciteer" method="POST">
                        <input type="hidden" name="job_title" value="{{$job->job_title}}">
                        <input type="hidden" name="company_id" value="{{$job->company_id}}">
                        @csrf
                        <button>Solliciteer!</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</div>



@endsection('content')
