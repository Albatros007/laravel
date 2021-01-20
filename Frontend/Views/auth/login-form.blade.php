@extends('F::layouts.main')

@section('content')

    <form action="{{ route('login') }}" method="post">

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

                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" value="" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <input type="checkbox" id="remember" name="remember">
                <label for="remember"> - Запомнить меня</label>

                @include('common._re_captcha')

                <hr />

                <button type="submit" class="btn btn-outline-primary">Войти</button>

                <p class="pull-right">
                    Если Вы забыли пароль, то Вам  <a class="" href="{{ route('forgotten-password.form') }}">сюда</a>
                </p>

            </div>
        </div>
    </div>

</form>

@endsection

