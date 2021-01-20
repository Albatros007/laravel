@extends('F::layouts.main')

@section('content')

<form action="{{ route('forgotten-password') }}" method="post">

    @csrf

    <div class="auth">
        <div class="row">
            <div class="col">

                <div class="form-group">
                    <label for="email" class="align-bottom">E-mail</label>
                    <input type="email" value="{{ old('email') }}" id="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                @include('common._re_captcha')

                <hr />

                <button type="submit" class="btn btn-outline-primary">Отправить</button>

            </div>
        </div>
    </div>

</form>

@endsection
