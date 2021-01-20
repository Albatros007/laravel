@extends('B::layouts.blank')

@section('content')

    <div class="col-lg-4"  style="margin: 0 auto; margin-top: -40%">

        @if (session()->has('authError'))
            <h5 class="text-danger text-center">{{ session('authError') }}</h5>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">

            @csrf

            <div class="form-group">
                <label for="name">Логин</label>
                <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >

                @error('name')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input id="password" value="" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" >

                @error('password')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group form-check">
                <input class="form-check-input" style="margin-top: 4px" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                   - Запомнить
                </label>
            </div>

            <hr />

            <button type="submit" class="btn btn-outline-primary"> Войти </button>

        </form>
    </div>

@endsection
