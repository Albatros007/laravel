<tr style="border-bottom: #343a40 3px solid;">
    <td class="align-middle">
        <div class="form-group mb-0 position-relative">
            <div class="eraser"></div>
            <input value="{{ request('title') }}" class="form-control form-control-sm" id="title" name="title" type="text" placeholder="">
        </div>
    </td>
    <td class="align-middle">
        <div class="form-group mb-0 position-relative" style="">
            <div class="eraser"></div>
            <input style="" value="{{ request('slug') }}" class="form-control form-control-sm" id="slug" name="slug" type="text" placeholder="">
        </div>
    </td>
    <td class="align-middle text-center">

        @include('B::modals._date-range')

    </td>
    <td class="align-middle">

        <div class="form-group mb-0">
            @php $ris = request('is_hidden'); @endphp
            <select class="form-control form-control-sm select-2g" name="is_hidden" id="is_hidden">
                <option value=""> - - - - - </option>
                <option @if(isset($ris) && $ris == 0) selected @endif value="0">Открыто</option>
                <option @if(request('is_hidden') == 1) selected @endif value="1">Скрыто</option>
            </select>
        </div>

    </td>
    <td class="align-middle text-center">
        <button type="submit" class="btn btn-dark btn-sm knopf" style="">
            <span class="fa fa-search"  aria-hidden="true"></span>
        </button>
    </td>
</tr>
