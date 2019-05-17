<div class="modal fade" id="{{ sprintf('%s-modal', $name) }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    @lang (ucfirst($name))
                </h4>
                <button class="close" type="button" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body overflow-auto" id="{{ sprintf('%s-modal-body', $name) }}">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang ('Close')</button>
            </div>
        </div>
    </div>
</div>
