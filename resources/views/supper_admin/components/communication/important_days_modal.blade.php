<div class="modal fade" id="modal-center" tabindex="-1" aria-labelledby="modalTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Important Days</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="importantDaysForm">
                @csrf
                <input type="hidden" id="important_days_id" name="important_days_id" value="">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="font-weight-bold text-dark" style="font-size: 14px;">Important Day Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Important Day Name" required>
                    </div>

                    <div class="form-group">
                        <label for="date" class="font-weight-bold text-dark" style="font-size: 14px;">Date</label>
                        <input type="date" id="date" name="date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description" class="font-weight-bold text-dark" style="font-size: 14px;">Note</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Note" rows="3" required></textarea>
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
