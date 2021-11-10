@extends('layouts.app')


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Profiel</div>
                <div class="card-body">
                        @if (Auth::user()->roll == 2)
                            <div class="container">
                                U kunt deze pagina niet bezoeken
                            </div>
                        @endif

                        <form action="/werkzoekende/create" method="POST" enctype="multipart/form-data">
                                    <label for="motivation" class="button-file-upload">Motivatie</label>
                                        <input type="file" Name="motivation" id="motivation" class="@error('motivation') is-invalid @enderror">
                                        @error('motivation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <label for="portfolio" class="button-file-upload">Portfolio</label>
                                        <input type="file" Name="portfolio" id="portfolio" class="mt-2 @error('portfolio') is-invalid @enderror">
                                        @error('portfolio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                <div class="form-group row mb-0">
                                        <button type="submit" class="btn btn-primary btn-werkzoekende">
                                            opslaan
                                        </button>
                                </div>
                                @csrf
                            </form>
                    </div>
            </div>
            <div class="card mt-5">
                    <div class="card-header">categorie</div>
                        <div class="card-body">

                                        <form action="/werkzoekende/create/category" method="post" name="category" class="text-center">
                                            <select id="category" name="category">

                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->category }}">{{ $category->category }}</option>
                                                @endforeach
                                            </select>
                                            @csrf   <Br  />
                                            <div class="form-group row mb-0">
                                                <button type="submit" class="btn btn-primary btn-werkzoekende">
                                                    opslaan
                                                </button>
                                            </div>
                                        </form>
                            </div>
                    </div>
        </div>
    </div>

@endsection
