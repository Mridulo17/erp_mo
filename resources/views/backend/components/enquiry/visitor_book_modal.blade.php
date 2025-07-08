<div class="modal fade" id="visitorBookModal" tabindex="-1" aria-labelledby="visitorBookModalTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visitorBookModalTitle">Add Visitor Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="visitorBookForm" method="POST">
                @csrf
                <input type="hidden" id="visitor_book_id" name="visitor_book_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="phone">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="candidate_type_id">Category</label>
                        <select class="form-control select2" id="candidate_type_id" name="candidate_type_id">
                            <option value="">Choose Category</option>
                            @foreach ($candidateTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reference_type">Reference Type</label>
                        <select class="form-control select2" id="reference_type" name="reference_type">
                            <option value="">Choose</option>
                            <option value="Employeee">Employeee</option>
                            <option value="Agent">Agent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea class="form-control" id="note" name="note"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="entry_time">Entry Time</label>
                        <input type="time" class="form-control" id="entry_time" name="entry_time">
                    </div>
                    <div class="form-group">
                        <label for="how_find_us">How to find us</label>
                        <select class="form-control select2" id="how_find_us" name="how_find_us">
                            <option value="">Choose</option>
                            <option value="Old Candidate">Old Candidate</option>
                            <option value="Neighbor">Neighbor</option>
                            <option value="Walking Candidate">Walking Candidate</option>
                            <option value="Online Marketing">Online Marketing</option>
                            <option value="News Paper">News Paper</option>
                            <option value="Google">Google</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Instagram">Instagram</option>
                            <option value="Linkedin">Linkedin</option>
                            <option value="TikTok">TikTok</option>
                            <option value="SMS">SMS</option>
                            <option value="WhatsApp">WhatsApp</option>
                            <option value="Telegram">Telegram</option>
                            <option value="Youtube">Youtube</option>
                            <option value="Parents">Parents</option>
                            <option value="TVC">TVC</option>
                            <option value="Friends">Friends</option>
                            <option value="Colleague">Colleague</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="saveVisitorBookBtn">
                        <i class="fa fa-save"></i> <span id="visitorBookModalSubmitText">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 