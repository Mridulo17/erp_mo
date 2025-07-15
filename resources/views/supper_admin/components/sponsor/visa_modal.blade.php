<div class="modal fade" id="modal-center" tabindex="-1" aria-labelledby="modalTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Manage Visa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- The Form -->
            <form id="visaForm">
                @csrf
                <input type="hidden" id="visa_id" name="visa_id" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Choose Sponsor</label>
                        <select name="sponsor_id" id="sponsorSelect" class="form-control">
                            <option value="" disabled selected>Choose Sponsor</option>
                        </select>
                        </div>
                    <div class="form-group">
                        <label>Choose Job</label>
                        <select name="job_list_id" id="jobSelect" class="form-control">
                            <option value="" disabled selected>Choose Job</option>
                        </select>
                    </div>
                    <div class="form-group">

                    </div>
                    <div class="row">
                        <div class="col-sm-6 all_country_checkbox_container">
                            <div class="form-group">
                                <label>Country</label>
                                <select name="country_id" id="countrySelect" class="form-control">
                                    <option value="" disabled selected>Country</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Issue Date</label>
                                <input type="date" name="issue_date" id="issue_date" autocomplete="off" placeholder="Choose Issue Date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Age from</label>
                                <input type="number" step="1" name="age_from" value="18" id="age_from" placeholder="Age from" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <label>Age to</label>
                                <input type="number" step="1" name="age_to" id="age_to" value="70" placeholder="Age to" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Visa Number</label>
                                <input type="text" name="visa_number" id="visa_number" placeholder="Visa Number/Code" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Visa Quantity</label>
                                <input type="number" step="any" name="visa_qty" id="visa_qty" placeholder="Visa Quantity" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Choose Type</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="" disabled selected>Choose Type</option>
                                    <option value="Air Ticket">Air Ticket</option>
                                    <option value="Business Visa">Business Visa</option>
                                    <option value="Hazz & Umrah">Hazz & Umrah</option>
                                    <option value="Manpower">Manpower</option>
                                    <option value="Patient">Patient</option>
                                    <option value="Tourist">Tourist</option>
                                    <option value="Visa Processing">Visa Processing</option>
                                    <option value="Worker">Worker</option>
                                </select>
                                 </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Choose Gender</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="" disabled selected>Choose Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Haji">Haji</option>
                                </select> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="border: solid 2px #d9d9d9;padding-top: 10px;border-radius: 15px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="salary_currency_id" class="font-weight-bold text-dark" style="font-size: 14px;">Currency <small id="salary_currency_details" style="color: #ff0000"></small></label>
                                            <select name="salary_currency_id" id="salaryCurrencySelect" class="form-control" required>
                                                <option value="" disabled selected>Choose Currency</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="salary_bdt_amount" id="salary_bdt_amount" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Monthly Salary</label>
                                        <input type="number" step="any" name="monthly_salary" id="monthly_salary" placeholder="Monthly Salary" class="form-control" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row payment_type_container">
                        <div class="col-sm-12" style="border: solid 2px #d9d9d9;padding-top: 10px;border-radius: 15px;margin-bottom: 10px;margin-top: 10px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="purchase_currency_id" class="font-weight-bold text-dark" style="font-size: 14px;">Currency <small id="purchase_currency_details" style="color: #ff0000"></small></label>
                                            <select name="purchase_currency_id" id="purchaseCurrencySelect" class="form-control">
                                                <option value="" disabled selected>Choose Currency</option>
                                            </select>
                                            <input type="hidden" name="purchase_bdt_amount" id="purchase_bdt_amount" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Purchase Amount</label>
                                        <input type="number" step="any" name="purchase_amount" id="purchase_amount" placeholder="Amount/Cost" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Payment Type</label>
                                        <select name="payment_type" id="payment_type" class="form-control">
                                            <option value="" disabled selected>Payment Type</option>
                                            <option value="Free">Free</option>
                                            <option value="Due">Due</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row agent_candidate_price_container">
                        <div class="col-sm-12" style="border: solid 2px #d9d9d9;padding-top: 10px;border-radius: 15px;margin-bottom: 10px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="currency_id" class="font-weight-bold text-dark" style="font-size: 14px;">Currency <small id="currency_details" style="color: #ff0000"></small></label>
                                        <select name="currency_id" id="currencySelect" class="form-control" required>
                                            <option value="" disabled selected>Choose Currency</option>
                                        </select>
                                        <input type="hidden" name="bdt_price" id="bdt_price" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Agent Price </label>
                                        <input type="number" step="any" name="agent_price" id="agent_price" placeholder="Agent Sell Amount" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Candidate Price </label>
                                        <input type="number" step="any" name="candidate_price" id="candidate_price" placeholder="Candidate Sell Amount" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Demand Latter <span class="demand_latter"></span></label>
                                <input type="file" id="demand_latter" style="padding: 3px;" name="demand_latter" class="form-control">
                                <!-- Existing file preview -->
                                <div id="existing-file-preview1" style="margin-top: 10px;"></div>

                                <!-- Remove file toggle -->
                                <div id="remove-file-section1" class="form-check mt-2 d-none">
                                    <input type="checkbox" class="form-check-input" id="remove_file11" name="remove_file" value="1">
                                    <label class="form-check-label" for="remove_file1">Remove existing file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Attachment <span class="attachment"></span></label>
                                <input type="file" style="padding: 3px;" name="attachment" class="form-control">
                                <!-- Existing file preview -->
                                <div id="existing-file-preview" style="margin-top: 10px;"></div>

                                <!-- Remove file toggle -->
                                <div id="remove-file-section" class="form-check mt-2 d-none">
                                    <input type="checkbox" class="form-check-input" id="remove_file" name="remove_file" value="1">
                                    <label class="form-check-label" for="remove_file">Remove existing file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        <textarea name="note" class="form-control" placeholder="Note"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="checkbox checkbox-success">
                            <input name="provide_food" id="provide_food" type="checkbox">
                            <label for="provide_food"> Food will be provided </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox checkbox-success">
                            <input name="provide_accommodation" id="provide_accommodation" type="checkbox">
                            <label for="provide_accommodation"> Accommodation will be provided </label>
                        </div>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" id="status" name="status" class="form-check-input" value="Enabled" checked>
                        <label class="form-check-label" for="status">Status</label>
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



