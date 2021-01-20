<div class="row align-items-center">

    <div class="col text-right">
        <button data-toggle="modal" data-target="#dt-modal-{{ $field }}" type="button" class="btn btn-dark btn-sm knopf" style="">
            <span class="fa fa-calendar"  aria-hidden="true"></span>
        </button>
    </div>

    <div class="col text-left" id="view-dt-{{ $field }}">

        <small id="view-{{ $from }}"></small>
        <br />
        <small id="view-{{ $to }}"></small>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="dt-modal-{{ $field }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="dt-modal-{{ $field }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Выбрать диапазон дат</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="mt-1 row" >

                    <div class="col">
                        <div class="input-group input-group-sm" >
                            <input readonly id="dt-{{ $from }}" value="{{ request($from) }}" class="form-control form-control-sm"  name="{{ $from }}" type="text" placeholder="С">
                            <div class="input-group-append">
                                <span class="input-group-text fa fa-calendar" id="show-calendar-{{ $from }}"></span>
                            </div>
                            <div class="invalid-feedback">
                                Оба поля должны быть заполнены и иметь формат: дд.мм.гггг, либо быть пустыми
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="input-group input-group-sm">
                            <input readonly value="{{ request($to) }}" class="form-control form-control-sm" id="dt-{{ $to }}" name="{{ $to }}" type="text" placeholder="По">
                            <div class="input-group-append">
                                <span class="input-group-text fa fa-calendar" id="show-calendar-{{ $to }}"></span>
                            </div>
                            <div class="invalid-feedback">
                                Оба поля должны быть заполнены и иметь формат: дд.мм.гггг, либо быть пустыми
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="dt-clean-{{ $field }}" class="btn btn-outline-dark">Очистить</button>
                <button type="button" id="dt-confirm-{{ $field }}" class="btn btn-dark">Ok</button>
            </div>
        </div>
    </div>
</div>

@section('script')

    @parent

    <script type="text/javascript">
        $(document).ready(function() {

            let viewDtFrom = $('#view-{{ $from }}');
            let viewDtTo = $('#view-{{ $to }}');
            let inputFrom = $('#dt-{{ $from }}');
            let inputTo = $('#dt-{{ $to }}');
            let dtError = {
                from:false,
                to:false
            };

            $('#show-calendar-{{ $from }}').click(function () {
                inputFrom.focus();
            })

            $('#show-calendar-{{ $to }}').click(function () {
                inputTo.focus();
            })

            $('#dt-{{ $from }}, #dt-{{ $to }}').datetimepicker(
                {
                    pickTime: false,
                    language: 'ru',
                    dateFormat: "yyyy.mm.yy",
                }
            );

            $('#dt-confirm-{{ $field }}').on('click', function () {

                let dtPattern = {{ config('params.RegExpDate') }};

                if (dtPattern.test(inputFrom.val()) || ($.trim(inputFrom.val()) == '' && $.trim(inputTo.val()) == '') ) {
                    inputFrom.removeClass('is-invalid');
                    dtError.from = false;
                } else {
                    inputFrom.addClass('is-invalid');
                    dtError.from = true;
                }

                if (dtPattern.test(inputTo.val()) || ($.trim(inputFrom.val()) == '' && $.trim(inputTo.val()) == '')) {
                    inputTo.removeClass('is-invalid');
                    dtError.to = false;
                } else {
                    inputTo.addClass('is-invalid');
                    dtError.to = true;
                }

                //console.log(dtError.from + ' - ' +dtError.to)

                if (!dtError.from && !dtError.to) {
                    dtMapping()
                    $('#dt-modal-{{ $field }}').modal('hide');
                }
            })

            function dtMapping() {
                viewDtFrom.html(inputFrom.val());
                viewDtTo.html(inputTo.val());
            }

            dtMapping()

            $('#dt-clean-{{ $field }}').click(function () {
                inputFrom.val('').removeClass('is-invalid');
                inputTo.val('').removeClass('is-invalid');
            })
        });
    </script>

@endsection
