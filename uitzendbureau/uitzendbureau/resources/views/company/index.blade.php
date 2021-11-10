@extends('layouts.app')
@section('content')

<div id="melding">
    Uw advertentie is geupload
</div>


    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Profiel</div>
                <div class="card-body">
                    @if (Auth::user()->roll == 2)
                    <form action="/company/create">
                            <div class="text-center">
                                <div class="error text-center mt-1 mb-3">{{$text ?? ""}}</div>
                            </div>
                            <div class="justify-content-center">
                                <div class="col-md-6 ml-auto mr-auto">
                                    <input type="text" Name="company_name"  autocomplete="off" id="company_name" placeholder="Bedrijfsnaam" class=" mr-auto ml-auto form-control @error('company_name') is-invalid @enderror" value='{{ old('company_name') ?? $company->company_name ?? "" }}' au>
                                        @error('company_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-md-6 ml-auto mr-auto">
                                <input type="text" autocomplete="off" Name="kvk" placeholder="KvK" id="kvk" class="form-control mr-auto ml-auto @error('kvk') is-invalid @enderror" value='{{ old('kvk') ?? $company->kvk ?? "" }}'>
                                    @error('kvk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">
                                    opslaan
                                </button>
                            </div>
                        @csrf
                    </form>
                    @endif
                </div>
            </div>
            <div class="card mt-5">
                    <div class="card-header">Advertenties aanmaken</div>
                    <div class="card-body">
                        <form action="/company" method="post" enctype="multipart/form-data" onsubmit="confirmMessage()">
                            <label for="file" class="button-file-upload">Advertentie uploaden</label><br>
                            <input type="file" name="file" id='file'>
                            @csrf
                            <div class="text-center">
                                    <button class="btn btn-primary" >versturen</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-header">Advertenties verwijderen</div>
                    <div class="card-body">
                        <form action="/company/delete" method="post" class="text-center" enctype="multipart/form-data">
                            <button class="btn btn-primary">verwijder advertentie</button>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>

@endsection
