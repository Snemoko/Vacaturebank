@extends('layouts.app')

@section('content')
@php
$my_jobs = $variables["my_jobs"];
$categories = $variables["categories"];
@endphp
@if ($my_jobs)
    @foreach($my_jobs as $my_job)
    @php
    @endphp
    <div class="container">
        <h1 class="mt-2 text-center vacature-header">Vacature bewerken</h1>
    </div>
    <div class="container text-center form-vacature-bewerken">
        <form action="/board/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$my_job->id}}">
            <label for="text">Vacature titel:</label><br>
            <input type="text" class="text-center" name="job_title" value="{{$my_job->job_title}}"><br>
            @error('job_title')<p style="color:red;">{{ $message }}</p>@enderror
            <select id="category" name="category">
                <option value="{{$my_job->category}}">{{$my_job->category}}</option>
                @foreach ($categories as $category)
                @if($my_job->category != $category->category)
                    <option value="{{ $category->category }}">{{ $category->category }}</option>
                @endif
                @endforeach
            </select>
            @error('category')<p style="color:red;">{{ $message }}</p>@enderror
            <label for="text">Vacature text:</label><br>
            <input type="text" class="text-center" name="text" value="{{$my_job->text}}"><br>
            @error('text')<p style="color:red;">{{ $message }}</p>@enderror
            <label class="mt-1 text-center"for="hours">Uren</label><br>
            <input type="number" class="text-center" name="hours" value="{{$my_job->hours}}"><br>
            @error('hours')<p style="color:red;">{{ $message }}</p>@enderror
            <label class="mt-1 "for="ethic">Ethic:</label><br>
            <input type="text" class="text-center" name="ethic" value="{{$my_job->ethic}}"><br>
            @error('ethic')<p style="color:red;">{{ $message }}</p>@enderror
            <label class="mt-3 button-file-upload" for="labor_contract">Labor contract</label>
            <input type="file" name="labor_contract" id="labor_contract"><br>
            @error('labor_contract')<p style="color:red;">{{ $message }}</p>@enderror
            <label class="mt-2 button-file-upload" for="working_conditions">Working conditions</label>
            <input type="file" name="working_conditions" id="working_conditions"><br>
            @error('working_conditions')<p style="color:red;">{{ $message }}</p>@enderror
            <label class="mt-2 button-file-upload" for="contract">Contract uploaden</label>
            <input type="file" name="contract" id="contract" title="123"><br>
            @error('contract')<p style="color:red;">{{ $message }}</p>@enderror
            <label class="mt-2 button-file-upload" for="dismissal">Dismissal</label>
            <input type="file" name="dismissal" id="dismissal"><br>
            @error('dismissal')<p style="color:red;">{{ $message }}</p>@enderror
            <label class="mt-2 button-file-upload" for="health_safety">Health safety</label>
            <input type="file" name="health_safety" id="health_safety"><br>
            @error('health_safety')<p style="color:red;">{{ $message }}</p>@enderror
            @csrf

            <button class="button-vacature-bewerken">Vacature bewerken</button>
        </form>
        <form  action="/board/delete" method="POST" enctype="multipart/form-data">
            <input style="width:0px;" type="hidden" value="{{$my_job->id}}" name="id">
            @csrf
            <button style="margin-top:-250px;">Verwijder vacature</button>
        </form>
    </div>

    @endforeach
@else
    <div class="geen-vacatures">
        <h1 class='text-center mt-5 vacatures-geen-text'>U heeft nog geen vacatures geupload</h1>
    </div>
@endif

@endsection('content')
