<div class="modal fade" id="phoneCallModal" tabindex="-1" aria-labelledby="phoneCallModalTitle" aria-modal="true"
    role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="phoneCallModalTitle">Add Phone Call</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="phoneCallForm" method="POST">
                @csrf
                <input type="hidden" id="phone_call_id" name="phone_call_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="phone">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name">
                    </div>
                    <div class="form-group">
                        <label for="country_id">Country</label>
                        <select class="form-control select2" id="country_id" name="country_id">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="candidate_type_id">Category</label>
                        <select class="form-control select2" id="candidate_type_id" name="candidate_type_id">
                            <option value="">Select Category</option>
                            @foreach ($candidateTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea class="form-control" id="note" name="note"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="followup_date">Followup Date</label>
                        <input type="date" class="form-control" id="followup_date" name="followup_date">
                    </div>
                    <div class="form-group">
                        <label for="how_find_us">How to find us</label>
                        <select class="form-control select2" id="how_find_us" name="how_find_us">
                            <option value="">Choose find us</option>
                            <option value="Old Candidate">Old Candidate</option>
                            <option value="Listen from neighbor">Listen from neighbor</option>
                            <option value="Walking Candidate">Walking Candidate</option>
                            <option value="Online Marketing link">Online Marketing link</option>
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
                            <option value="I dont Know">I don't Know</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="savePhoneCallBtn">
                        <i class="fa fa-save"></i> <span id="phoneCallModalSubmitText">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
