<!-- Modal HTML -->
<div id="modalConfirm" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fa fa-info-circle"></i>
                </div>
                <h4 class="modal-title w-100">{{$mainTitle}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p class="text-danger">{{$mainContent}}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="event.preventDefault(); document.getElementById('remove-category-{{$id}}').submit();" class="btn btn-danger">Excluir</button>
            </div>
        </div>
    </div>
</div>