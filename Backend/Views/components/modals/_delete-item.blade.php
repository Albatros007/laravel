<!-- Modal -->
<div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Подтверждение удаления</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" id="delete-confirm" class="btn btn-danger">Удалить</button>
            </div>
        </div>
    </div>
</div>

<form id="form_delete" action="" method="post">

    @csrf
    @method('delete')

</form>

@section('script')

    @parent

    <script type="text/javascript">

        let deleteItem = null;
        let deleteModal = $('#deleteModal');

        $('.icon-delete').on('click', function(){
            deleteItem = $(this).data("delete");
            deleteModal.modal('show');
        });

        $('#delete-confirm').click( function(){
            deleteModal.modal('hide');
            $('#form_delete').attr('action', deleteItem ).submit();
        });

    </script>

@endsection
