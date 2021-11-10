@extends('layouts.app')


@section('content')

<div class="container text-center form-vacature-toevoegen">
        <form name="vacature-toevoegen" action="/board/create" method="POST" enctype="multipart/form-data">
            <div class="col">
                <h1 class="mt-2 text-center vacature-header">Vacature toevoegen</h1>
            </div>
            <input type="text" name='job_title' id='job_title' placeholder="Vacature titel" autocomplete="off"><br>
            @error('job_title')<p style="color:red;">{{ $message }}</p>@enderror

            <select id="category" name="category">
                <option value="">Sector</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category }}">{{ $category->category }}</option>
                @endforeach
            </select><br>
            @error('category')<p style="color:red;">{{ $message }}</p>@enderror
            <textarea name="text" placeholder="Plaats hier uw informatie over de vacature...."></textarea><br>
            @error('text')<p style="color:red;">{{ $message }}</p>@enderror
            <input type="number" class="text-center" name="hours" placeholder="Uren" value="{{old('hours') ?? "Uren"}}"><br>
            @error('hours')<p style="color:red;">{{ $message }}</p>@enderror
            <textarea name="ethic" placeholder="Ethic hier plaatsen..."></textarea><br>
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

            <button class="button-vacature-toevoegen">Vacature toevoegen</button>
        </form>
</div>

@endsection('content')


