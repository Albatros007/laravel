<tr style="border-bottom: #343a40 3px solid;">

    @foreach($columns as $column => $attrs)

        @if(is_array($attrs) && !strstr($column, '!!'))
            <td class="align-middle">

                @if(isset($attrs['search']) && isset($attrs['dateFormat']))
                    {{--@include('B::components.table-creator._date-range')--}}
                    <x-date-ranger :field="$column" :from="$attrs['search']['values']['from']" :to="$attrs['search']['values']['to']"/>
                    @continue
                @endif

                @if(isset($attrs['search']['type']))

                    @if($attrs['search']['type'] === 'select')
                        <div class="form-group mb-0">
                            <select class="form-control form-control-sm select-2g" name="{{ $column }}" id="{{ $column }}">
                                <option value=""> - - - - - </option>
                                @foreach($attrs['search']['values'] as $k => $v)
                                    <option @if(request($column) !== null && request($column) == $k) selected @endif value="{{ $k }}"> {{ $v }} </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if($attrs['search']['type'] === 'radio')
                        <div class="form-group mb-0">
                            <input @if(request($column) === null) checked @endif name="{{ $column }}" type="radio" value=""> ------
                            @foreach($attrs['search']['values'] as $k => $v)
                                <input @if(request($column) !== null && request($column) == $k) checked @endif name="{{ $column }}" type="radio" value="{{ $k }}"> - {{ $v }}
                            @endforeach
                        </div>
                    @endif

                    @continue
                @endif

                @if(isset($attrs['search']) && !isset($attrs['search']['type']))
                    <div class="form-group mb-0 position-relative" style="">
                        <div class="eraser"></div>
                        <input style="" value="{{ request($column) }}" class="form-control form-control-sm" id="{{ $column }}" name="{{ $column }}" type="text" placeholder="">
                    </div>
                @endif
            </td>
        @endif

    @endforeach

    {{--@if(isset($columns['!!status']))
        <td class="align-middle">
            @if(isset($columns['!!status']['search']))
                <div class="form-group mb-0">
                    @php $ris = request($columns['!!status']['field']); @endphp
                    <select class="form-control form-control-sm select-2g" name="is_hidden" id="is_hidden">
                        <option value=""> - - - - - </option>
                        <option @if(isset($ris) && $ris == 0) selected @endif value="0">Открыто</option>
                        <option @if(request($columns['!!status']['field']) == 1) selected @endif value="1">Скрыто</option>
                    </select>
                </div>
            @endif
        </td>
    @endif--}}

    <td class="align-middle text-center">
        <button type="submit" class="btn btn-dark btn-sm knopf" style="">
            <span class="fa fa-search"  aria-hidden="true"></span>
        </button>
    </td>

</tr>
