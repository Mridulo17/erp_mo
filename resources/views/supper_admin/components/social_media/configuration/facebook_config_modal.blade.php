<div class="modal fade" id="modal-center" tabindex="-1" aria-labelledby="modalTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Facebook Configuration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="facebookConfigurationForm">
                @csrf
                <input type="hidden" id="facebook_configuration_id" name="id" value="">
                <input type="hidden" name="platform" value="Facebook">

                <div class="modal-body">

                    <div class="form-group">
                        <label for="page_name" class="font-weight-bold text-dark">Page Name</label>
                        <input type="text" id="page_name" name="page_name" class="form-control" placeholder="Enter Page Name" required>
                    </div>

                     <div class="form-group">
                        <label for="page_id" class="font-weight-bold text-dark">Page ID</label>
                        <input type="text" id="page_id" name="page_id" class="form-control" placeholder="Enter Page ID" required>
                    </div>

                     <div class="form-group">
                        <label for="app_id" class="font-weight-bold text-dark">App ID</label>
                        <input type="text" id="app_id" name="app_id" class="form-control" placeholder="Enter App ID" required>
                    </div>

                    <div class="form-group">
                        <label for="app_secret" class="font-weight-bold text-dark">App Secret</label>
                        <input type="text" id="app_secret" name="app_secret" class="form-control" placeholder="Enter App Secret" required>
                    </div>

                     <div class="form-group">
                        <label for="access_token" class="font-weight-bold text-dark">Access Token</label>
                        <input type="text" id="access_token" name="access_token" class="form-control" placeholder="Enter Access Token" required>
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
