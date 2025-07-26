<div class="modal fade" id="modal-center" tabindex="-1" aria-labelledby="modalTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Important Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="importantTemplateForm">
                @csrf
                <input type="hidden" id="important_templates_id" name="important_templates_id" value="">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="font-weight-bold text-dark" style="font-size: 14px;">Select Day </label>
                        <select name="important_days_id" id="daySelect" class="form-control" required>
                            <option value="" disabled selected>Select a day</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message_template" class="font-weight-bold text-dark" style="font-size: 14px;">Templates</label>
                        <textarea id="message_template" name="message_template" class="form-control" placeholder="Message Body" rows="3" required></textarea>
                    </div>

                     <div class="form-group">
                        <label for="attachment" class="font-weight-bold text-dark" style="font-size: 14px;">Attachment</label>
                        <input type="file" id="attachment" name="attachment" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf,.docx">
                        <small class="text-muted">Allowed: JPG, PNG, PDF, DOCX</small>
                        
                        <div id="attachmentPreview" class="mt-2"></div>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" id="status" name="status" class="form-check-input" value="Active" checked>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
