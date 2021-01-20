@extends('F::email.layouts.main')

@section('content')

<div class="container">

    <div class="card text-white bg-secondary mb-3" style="">
        <div class="card-header">Подтверждение регистрации</div>
        <div class="card-body">
            <h5 class="card-title">Hi {{ $name }}</h5>
            <p class="card-text">
                Для подтверждения регистрации пройдите по этой ссылке:
                <a href="{{ $appUrl }}/verified?token={{ $token }}">{{ $appUrl }}/verified?token={{ $token }}</a>
            </p>
        </div>
    </div>

</div>

@endsection

