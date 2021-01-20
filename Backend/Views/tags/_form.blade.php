@if (isset($tag))
    <form action="{{route('tags.update', $tag->id)}}" method="post">
        @method('PUT')
@else
    <form action="{{route('tags.store')}}" method="post">
@endif

    @csrf

@php
    $rulesParams = \App\Backend\Requests\tag\TagRequest::$rulesParams;
@endphp


    <div class="form-group is-invalid">
        <label for="title">Название</label>
        <input value="{{ old('title') ?? $tag->title ?? '' }}" class="form-control form-control-sm @error('title') is-invalid @enderror" id="title" name="title" type="text" placeholder="от {{ $rulesParams['strMin'] }} до {{ $rulesParams['strMax'] }} символов">
        @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    @php $ch = old('auto_slug') ?? 1 @endphp

    <input type="hidden" value="0" name="auto_slug">

    <label for="slug">ЧПУ</label>
    <div class="input-group input-group-sm mb-3">

        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="checkbox" @if ($ch == 1)
                checked
                       @else
                       unchecked
                       @endif value="1" name="auto_slug" id="auto_slug" aria-label="Checkbox for following text input">
                &nbsp;-&nbsp;<small>ставить от названия</small>
            </div>
        </div>
        <input type="text" value="{{ Session::get('__slug') ?? old('slug') ?? $tag->slug ?? '' }}" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" placeholder="от {{ $rulesParams['strMin'] }} до {{ $rulesParams['strMax'] }} символов">
        @error('slug')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <input type="hidden" value="0" name="is_hidden">

    @php $ch = old('is_hidden') ?? $tag->is_hidden ?? 0 @endphp

    <div class="form-group form-check">
        <input type="checkbox" value="1"
               @if ($ch == 1)
               checked
               @else
               unchecked
               @endif   name="is_hidden" class="form-check-input" id="is_hidden">
        <label class="form-check-label" for="is_hidden"> - Скрыть</label>
    </div>

    <div class="border-bottom mb-3 mt-1"></div>

    <button type="submit" class="btn btn-outline-primary btn-sm">Сохранить</button>

</form>

@section('script')

    @parent

    <script type="text/javascript">
        $( document ).ready(function() {

            dis();
            $('#auto_slug').on('change', function () {
                dis();
            });

            function dis(){

                let field = $('#slug');

                if ($('#auto_slug').is(':checked')) {
                    field.prop('disabled', true);
                } else {
                    field.prop('disabled', false);
                }
            }

        })
    </script>

@endsection

