@php
    use \App\Backend\Helpers\Views;
    $isSearch = false;
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
    $route = explode('.', $currentRoute)[0];
@endphp

<p class="text-right" style="margin-right: 10px">Всего: {{ $items->total() }}</p>

<form action="{{route($route.'.search')}}" method="get" class="mb-0">

    <table class="table table-sm table-hover mb-0">
    {{--<table class="table table-hover">--}}

        <thead class="thead-dark">
        <tr>
            @foreach($columns as $column => $attrs)
                @if(is_array($attrs) && !strstr($column, '!!'))

                    @php
                        if (!isset($attrs['thCSS'])) {
                            $attrs['thCSS'] = '';
                        }
                        if (isset($attrs['search'])) {
                            $isSearch = true;
                        }
                    @endphp

                    <th scope="col" nowrap="nowrap" class="{{ $attrs['thCSS'] }}">
                        {{ $attrs['name'] }}
                        @if( isset($attrs['sort']) )
                            {{ Views::sort($model, $column) }}
                        @endif
                    </th>

                @endif

            @endforeach

            @if(isset($columns['!!status']))
                {{--@dd($columns['@@status']['name'])--}}
                <th scope="col" class="text-center">{{ $columns['!!status']['name'] }} {{ Views::sort($model, $columns['!!status']['field']) }}</th>
            @endif

            @if(isset($columns['!!remove']))
                <th scope="col" class="text-center">{{ $columns['!!remove']['name'] }}</th>
            @else
                <th class="text-center">&nbsp;</th>
            @endif

        </tr>
        </thead>

        <tbody>

            @if ($isSearch)
                @include('B::components.table-creator._search')
            @endif

            @foreach($items as $item)

                <tr @if($item->is_hidden == 1)  class="table-secondary" @endif>

                    @foreach($columns as $column => $attrs)
                        @if(is_array($attrs) && !strstr($column, '!!'))

                            @php
                                if (!isset($attrs['tdCSS'])) {
                                    $attrs['tdCSS'] = '';
                                }

                                if (isset($attrs['itemContent'])) {
                                    //dd($attrs['item']);
                                    //$item->$column = eval($attrs['item']);
                                    $item->$column = $attrs['itemContent']($item);
                                }

                                if (isset($attrs['dateFormat'])) {
                                    $format = 'd.m.Y';
                                    if (is_string($attrs['dateFormat'])) {
                                        $format = $attrs['dateFormat'];
                                    }
                                    $item->dtf = $item->$column->format($format);
                                    unset($item->$column);
                                }
                            @endphp

                            <td class="align-middle {{ $attrs['tdCSS'] }}">
                                @if( isset($attrs['link']) )
                                    <a href="{{route($attrs['link'], $item->id)}}">
                                    {!! $item->$column !!} {{ $item->dtf }}
                                </a>
                            @else
                                {!! $item->$column !!} {{ $item->dtf }}
                                @endif
                                @unset($item->dtf)
                            </td>

                        @endif

                    @endforeach

                    @if(isset($columns['!!status']))
                        <td class="align-middle text-center">
                            <a href="{{ route('categories.visibility', ['id' => $item->id]) }}">
                                <span class="fa @if($item->is_hidden == 1) fa-eye-slash @else fa-eye @endif fa-2x" aria-hidden="true"></span>
                            </a>
                        </td>
                    @endif

                    @if(isset($columns['!!remove']))
                        <td class="align-middle text-center">
                            <span class="fa fa-times icon-delete fa-2x" data-delete="<?= route($route.'.destroy', $item->id) ?>" aria-hidden="true"></span>
                        </td>
                    @else
                        <td class="text-center">&nbsp;</td>
                    @endif

                </tr>

            @endforeach

        </tbody>

    </table>

</form>

<hr class="mt-0" />

{{ $items->links() }}

@include('B::components.modals._delete-item')
