@extends('B::layouts.main')

@section('breadcrumbs')
    @parent
    "{{ $category->title }}"
@endsection

@section('content')

    @include('B::categories._form')

@endsection
