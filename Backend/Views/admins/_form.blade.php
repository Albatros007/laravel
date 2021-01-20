@if (isset($admins))
    <form action="{{route('admins.update', $userBack->id)}}" method="post">
        @method('PUT')
@else
    <form action="{{route('admins.store')}}" method="post">
@endif

    @csrf

    <div class="row">
        <div class="col">


            <div class="form-group">
                <label for="name">Имя</label>
                <input value="{{ old('name') ?? $category->name ?? '' }}" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


        </div>
        <div class="col">


            <div class="form-group">
                <label for="password">Пароль</label>
                <input value="{{ old('password') ?? $category->password ?? '' }}" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password" type="text" placeholder="">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


        </div>
    </div>

    <div class="row">
        <div class="col-md-6">


            <div class="form-group">
                <label for="role">Статус</label>
                <select class="form-control form-control-sm" name="role" id="role">
                    @foreach($roles as $role => $title)
                        <option value="{{ $role }}">{{ $title }}</option>
                    @endforeach
                </select>
            </div>


        </div>
    </div>

    <input type="hidden" value="0" name="is_active">

    @php $ch = old('is_active') ?? $category->is_active ?? 0 @endphp

    <div class="form-group form-check mt-3">
        <input type="checkbox" value="1"
               @if ($ch == 1)
               checked
               @else
               unchecked
               @endif   name="is_active" class="form-check-input" id="is_active">
        <label class="form-check-label" for="is_active"> - Активен</label>
    </div>

    <div class="border-bottom mb-3 mt-1"></div>

    <button type="submit" class="btn btn-outline-primary btn-sm">Сохранить</button>

</form>

@section('script')

    <script type="text/javascript">

    </script>

@endsection

