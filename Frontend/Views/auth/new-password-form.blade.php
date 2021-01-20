@extends('F::layouts.main')

@section('content')

    @php
        $rulesMessages = new \App\Frontend\Requests\Auth\NewPasswordRequest;
    @endphp

    <form action="{{ route('new-password') }}" method="post">

        @csrf

        <div class="auth">
            <div class="row">
                <div class="col">

                    <div class="form-group">
                        <label for="password">Новый пароль</label>
                        <input type="password" placeholder="{{ $rulesMessages->messages()['password.min'] }}" value="" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Повтор пароля</label>
                        <input type="password" value="" id="password_confirmation" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password_confirmation">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <input type="hidden" value="{{ request()->query('id') }}" name="id">
                    <input type="hidden" value="{{ request()->query('token') }}" name="token">

                    <hr />

                    <button type="submit" class="btn btn-outline-primary">Сменить пароль</button>

                </div>
            </div>
        </div>

    </form>

@endsection
