<div class="modal fade" id="investorModal" tabindex="-1" aria-labelledby="investorModalTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="investorModalTitle">Investor Management Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="investorForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="investor_id" name="investor_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Investor Name" required>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label>Investor Photo</label>
                                <input type="file" class="form-control" id="investor_photo" name="investor_photo" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label>Agreement scan Copy</label>
                                <input type="file" class="form-control" id="agreement_scan_copy" name="agreement_scan_copy">
                            </div>
                            <div class="form-group">
                                <label>Choose Country</label>
                                <select class="form-control select2" id="country_id" name="country_id">
                                    <option value="">Choose Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Choose District</label>
                                <select class="form-control select2" id="district_id" name="district_id">
                                    <option value="">Choose District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Current address</label>
                                <textarea class="form-control" id="current_address" name="current_address" placeholder="Current Address"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <textarea class="form-control" id="note" name="note" placeholder="Note"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cell No:</label>
                                <input type="text" class="form-control" id="cell_no" name="cell_no" placeholder="Phone Number" required>
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label>NID Scan Copy</label>
                                <input type="file" class="form-control" id="nid_scan_copy" name="nid_scan_copy">
                            </div>
                            <div class="form-group">
                                <label>Attachment <small>(Multiple)</small></label>
                                <input type="file" class="form-control" id="attachment" name="attachment[]" multiple>
                            </div>
                            <div class="form-group">
                                <label>Choose Division</label>
                                <select class="form-control select2" id="division_id" name="division_id">
                                    <option value="">Choose Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Referred by Employee</label>
                                <select class="form-control select2" id="employee_id" name="employee_id">
                                    <option value="">Choose Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->first_name.' '. $employee->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Permanent address</label>
                                <textarea class="form-control" id="permanent_address" name="permanent_address" placeholder="Permanent Address"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Status</label><br>
                                <input type="checkbox" id="status" name="status" value="1" checked> Active
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="saveInvestorBtn">
                        <i class="fa fa-save"></i> <span id="investorModalSubmitText">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 