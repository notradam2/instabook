<div class="modal fade" id="delete-confirm" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title">{{ $title }}</p>
            </div>
            <div class="modal-body">
                <p>{{ __('Are you sure you want to delete? Cannot revert this action.') }}</p>
            </div>
            <div class="modal-footer justify-content-end border-top-0">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">{{ __("Back") }}</button>
                <button type="button" class="btn btn-danger" id="proceed-delete">{{ __("Confirm Delete") }}</button>
            </div>
        </div>
    </div>
</div>
