@php
    $temp = explode('\\', get_class(request()->route()->getController()));
    $controller =  str_replace('Controller', '', array_pop($temp));
    $action = request()->route()->getActionMethod();

    $active = '';
    $activeChild = '';
    $child = '';
@endphp

@section('breadcrumbs')
ertet
@foreach($items as $item)
    @if(
    ($controller == $item->controller && $item->parent == 0)
    ||
    ($controller == $item->controller && $action == $item->action)
    )
        {{ $item->title }} /
    @endif
@endforeach

@endsection
