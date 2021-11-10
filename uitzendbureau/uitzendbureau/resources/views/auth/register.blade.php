@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row justify-content-center ">
                            <div class="col-md-6 ">
                                <input id="first_name" placeholder="Firstname" type="text" class="mx-auto form-control mx-auto @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="First name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-6">
                                <input id="last_name" placeholder="Last name" type="text" class="form-control mx-auto @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="First name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">

                            <div class="col-md-6">
                                <input id="phone_number" placeholder="Telefoon-Nummer" type="text" class="form-control mx-auto @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="First name" autofocus>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">

                            <div class="col-md-6">
                                <input id="city" placeholder="Stad" type="text" class="form-control mx-auto @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="First name" autofocus>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row justify-content-center">

                            <div class="col-md-6">
                                <input id="email" placeholder="E-mail" type="email" class="text-center form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">

                            <div class="col-md-6">
                                <!-- <input id="roll" type="text" class="form-control @error('roll') is-invalid @enderror" name="roll" value="{{ old('roll') }}" required autocomplete="First name" autofocus> -->
                                <select name="roll" id="roll" class="form-control @error('roll') is-invalid @enderror" value="{{ old('roll') }}" autofocus>
                                    <option value="1">Werkzoekende</option>
                                    <option value="2">Bedrijf</option>
                                </select>
                                @error('roll')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">

                            <div class="col-md-6  ">
                                <input id="password" type="password" placeholder="Wachtwoord" class="text-center form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center text-center">
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" placeholder="Wachtwoord" class="form-control text-center" name="password_confirmation" required autocomplete="new-password" >
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
