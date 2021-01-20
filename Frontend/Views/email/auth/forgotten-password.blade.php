@extends('F::email.layouts.main')

@section('content')

<div class="container">

    <div class="card text-white bg-secondary mb-3" style="">
        <div class="card-header">Восстановление пароля</div>
        <div class="card-body">
            <h5 class="card-title">Hi {{ $name }}</h5>
            <p class="card-text">
                Для смены пароля пройдите по этой ссылке:
                <a href="{{ $appUrl }}/new-password?id={{ $id }}&token={{ $token }}">
                    {{ $appUrl }}/new-password?id={{ $id }}&token={{ $token }}
                </a>
            </p>
        </div>
    </div>

</div>

@endsection

