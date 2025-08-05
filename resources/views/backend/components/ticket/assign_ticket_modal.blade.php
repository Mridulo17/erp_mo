<div class="modal fade" id="modal-center" tabindex="-1" aria-labelledby="modalTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Assign Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- The Form -->
            <form id="ticketForm">
                @csrf
                <input type="hidden" id="ticket_id" name="ticket_id" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Choose Pre-Purchase ticket</label>
                        <select name="ticket_id" class="form-control select2-hidden-accessible" required="" tabindex="-1" aria-hidden="true"></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 429.667px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-ticket_id-6h-container"><span class="select2-selection__rendered" id="select2-ticket_id-6h-container"><span class="select2-selection__placeholder">Choose Ticket</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                    </div>
                    <div class="form-group ticket_info">

                    </div>
                    <div class="form-group single_candidate_container">
                        <label>Choose Candidate</label>
                        <select name="single_candidate" class="form-control" required="">
                        </select>
                    </div>
                    <div class="row multiple_candidate_container">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label>Choose Candidates</label>
                                <select name="multi_candidate[]" multiple="" class="form-control select2" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="checkbox checkbox-success">
                                    <input name="is_compleate_assigned" id="is_compleate_assigned" type="checkbox">
                                    <label for="is_compleate_assigned"> Make Assigned Compleate <br> <small class="text-danger" style="position: absolute; top: 60%;">For lowest candidate quantity</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        <textarea name="note" class="form-control" placeholder="Note"></textarea>
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



