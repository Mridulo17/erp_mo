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
                        <select id="selectTicket" name="ticket_id" class="form-control" required>
                            <option value="" disabled selected>Choose Ticket</option>
                        </select>
                    </div>
                    <div class="form-group ticket_info">

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label>Choose Candidates</label>
                                <select id="SelectCandidate" name="multi_candidate[]" multiple="" class="form-control select2" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12" id="complete_assign_div" style="display:none;">
                            <div class="form-group">
                                <div class="checkbox checkbox-success">
                                    <input name="is_complete_assigned" id="is_complete_assigned" type="checkbox">
                                    <label for="is_complete_assigned"> Make Assigned Complete <br>
                                        <small class="text-danger" id="show_total_candidate_text"></small></label>
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



