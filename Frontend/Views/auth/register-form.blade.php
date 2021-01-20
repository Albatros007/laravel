@extends('F::layouts.main')

@section('content')

    @php
        $rulesMessages = new \App\Frontend\Requests\Auth\RegisterRequest;
    @endphp

    <form action="{{ route('register') }}" method="post">

        @csrf

        <div class="auth">
            <div class="row">
                <div class="col">

                    <div class="form-group">
                        <label for="name" class="align-bottom">Логин</label>
                        <input type="text" placeholder="{{ $rulesMessages->messages()['name.min'] }}" value="{{ old('name') }}" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name">
                        <div class="invalid-feedback" id="name-invalid-feedback">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

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
                        <input placeholder="{{ $rulesMessages->messages()['password.min'] }}" type="password" value="" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password">
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

                    @include('common._re_captcha')

                    <hr />

                    <button type="submit" class="btn btn-outline-primary">Зарегестрироваться</button>

                </div>
            </div>
        </div>

    </form>

@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready( function() {

            $('#name').bind("change input paste", function() {

                let loginInput = $(this);
                let login = $.trim(loginInput.val());
                let errorMessage = '{{ $rulesMessages->messages()['name.unique'] }}';
                let errorFeedback = $('#name-invalid-feedback');

                if (login.length >= 3) {
                    $.ajax({

                        url: '{{ route('check-login-ajax') }}',
                        cache: false,
                        type: "POST",
                        data: '_token={{ csrf_token() }}&login=' + login,
                        dataType: 'json',
                        beforeSend: function () {
                        },
                        success: function (responce) {
                            console.log(responce.status);
                            if ( responce.status == 1) {
                                loginInput.addClass('is-invalid');
                                errorFeedback.html(errorMessage)
                            } else {
                                loginInput.removeClass('is-invalid');
                                errorFeedback.html('');
                            }
                        },
                        error: function (responce) {
                            console.log(responce);
                        }

                    });
                }
            })

        });

    </script>
@endsection
