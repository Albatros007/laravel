

@php

$temp = explode('\\', get_class(request()->route()->getController()));
$controller =  str_replace('Controller', '', array_pop($temp));
$action = request()->route()->getActionMethod();

$active = '';
$activeChild = '';
$child = '';
$css = '';
$breadcrumbs = '';
@endphp

<ul class="list-group list-group-flush">
    @foreach($items as $item)

        @php
            $active = '';
            $activeChild = '';
            $child = '';
            $css = '';

            if(
                ($controller == $item->controller && $item->parent == 0)
                ||
                ($controller == $item->controller && $action == $item->action)
            ) {
                $css = 'active';
                $breadcrumbs .= $item->title.' / ';
            }
            if($item->parent != 0) {
                $css .= ' ml-3';
            }
        @endphp

        @if($item->route)

            <li class="list-group-item">
                <a class="nav-link  {{ $css }}" href="{{ route($item->route) }}">
                    {{ $item->title }}
                </a>
            </li>

        @endif

    @endforeach
</ul>

@section('breadcrumbs')
    {{ rtrim($breadcrumbs, ' / ') }}
@endsection

@section('title')
    ghgfh
@endsection
