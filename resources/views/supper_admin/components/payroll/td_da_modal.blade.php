<div class="modal fade" id="modal-center" tabindex="-1" aria-labelledby="modalTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Travelling & Dearness</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- The Form -->
            <form id="advanceSalaryForm">
                @csrf
                <input type="hidden" id="performance_bonus_id" name="performance_bonus_id" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="department_id" class="font-weight-bold text-dark" style="font-size: 14px;">Choose Department </label>
                        <select name="department_id" id="departmentSelect" class="form-control" required>
                            <option value="" disabled selected>Choose Department</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employee_id" class="font-weight-bold text-dark" style="font-size: 14px;">Choose Employee </label>
                        <select name="employee_id" id="employeeSelect" class="form-control" required>
                            <option value="" disabled selected>Choose Employee</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="from" class="font-weight-bold text-dark" style="font-size: 14px;">From</label>
                        <input type="text" id="from" name="from" class="form-control" placeholder="From place">
                    </div>

                    <div class="form-group">
                        <label for="to" class="font-weight-bold text-dark" style="font-size: 14px;">To</label>
                        <input type="text" id="to" name="to" class="form-control" placeholder="To place">
                    </div>

                    <div class="form-group">
                        <label for="date" class="font-weight-bold text-dark" style="font-size: 14px;">Date</label>
                        <input type="date" id="date" name="date" class="form-control" placeholder="Date">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-700 font-size-16" for="transport_type">Transport Type</label>
                        <select name="transport_type" id="transport_type" class="form-control" required>
                            <option value="" disabled selected>Transport Type</option>
                            <option value="One Way">One Way</option>
                            <option value="Up Down">Up Down</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-700 font-size-16" for="vehicle_type">Vehicle Type</label>
                        <select name="vehicle_type[]" id="vehicle_type" class="form-control select2" multiple required>
                            <option value="Bus">Bus</option>
                            <option value="Rickshaw">Rickshaw</option>
                            <option value="CNG">CNG</option>
                            <option value="Pathao">Pathao</option>
                            <option value="Uber">Uber</option>
                            <option value="Van">Van</option>
                            <option value="Truck">Truck</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-700 font-size-16" for="payment_account">Choose Payment Account</label>
                        <select name="payment_account" id="payment_account" class="form-control" required>
                            <option value="" disabled selected>Choose Account</option>
                            <option value="Bank Account">Bank Account</option>
                            <option value="Cash in Hand">Cash in Hand</option>
                            <option value="Mobile Banking">Mobile Banking</option>
                            <option value="Office Assets">Office Assets</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="currency_id" class="font-weight-bold text-dark" style="font-size: 14px;">Currency <small id="currency_details" style="color: #ff0000"></small></label>
                        <select name="currency_id" id="currencySelect" class="form-control" required>
                            <option value="" disabled selected>Choose Currency</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name" class="font-weight-bold text-dark" style="font-size: 14px;">TA & DA Amount<small id="amount_currency"></small></label>
                        <input type="number" step="any" min="0" id="amount" name="amount" class="form-control" placeholder="Transport Amount" required>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" id="amount_translate">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="salary" class="font-weight-bold text-dark" style="font-size: 14px;">BDT Amount</label>
                        <input type="number" id="bdt_amount" name="bdt_amount" class="form-control" placeholder="BDT Amount" required readonly style="color: #ff0000">
                    </div>
                    <div class="form-group">
                        <label for="opening_balance_sheet" class="font-weight-bold text-dark" style="font-size: 14px;">Attachment(If needed)</label>
                        <input type="file" id="attachment" name="attachment" class="form-control form-control-lg">
                    </div>

                    <div class="form-group">
                        <label for="note" class="font-weight-bold text-dark" style="font-size: 14px;">Note</label>
                        <textarea id="note" name="note" rows="2" cols="5" class="form-control form-control-lg"></textarea>
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



