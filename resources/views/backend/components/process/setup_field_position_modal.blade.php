<div class="modal fade" id="setup-field-position" tabindex="-1" aria-labelledby="modalTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog" style="min-width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title setup_field_position_title"><b>Fields position setup</b></h5>
                <button type="button" class="close text-danger" data-dismiss="modal"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body setup_field_position_body" style="overflow-x: hidden;">

                <div class="row">
                    <div class="col-sm-12 print_button_container">
                        <button type="button" class="btn btn-xs btn-warning" style="float: right;" id="print_button_new"><i class="fa fa-print"></i> &nbsp; Print</button>
                    </div>
                    <div class="col-sm-12">
                        <b class="message_data"></b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <page size="A4" id="print-area-2">
                            @foreach($candidateDynamicForm->updatedCandidateDynamicFormFields as $field)
                                <div class="draggable ui-draggable ui-draggable-handle"
                                     field-id="{{ $field->id }}"
                                     field-name="{{ $field->field_name }}"
                                     form-id="{{ $candidateDynamicForm->id }}"
                                     style="top: {{ $field->top ?? 0 }}px; left: {{ $field->left ?? 0 }}px;">
                                    {{ $field->field_name }}
                                </div>
                            @endforeach
                        </page>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



