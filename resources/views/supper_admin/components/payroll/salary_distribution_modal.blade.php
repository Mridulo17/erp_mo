<div class="modal fade" id="modal-distribution" tabindex="-1" aria-labelledby="modalTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Generate Salary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- The Form -->
            <form id="distributionForm">
                @csrf
                <input type="hidden" id="festival_bonus_id" name="festival_bonus_id" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="employee_id" class="font-weight-bold text-dark" style="font-size: 14px;">Choose Employee </label>
                        <select name="employee_id" id="employeeSelect" class="form-control" required>
                            <option value="" disabled selected>Choose Employee</option>
                        </select>
                    </div>
                    <div class="employee_history_info" id="infoDiv" style="display: none">
                        <table class="table table-sm table-hover table-strip table-bordered">
                            <thead>
                            <tr> <th>#</th> <th>Info</th> </tr>
                            </thead>
                            <tbody>
                            <tr> <td>Absent </td><td>8 Days </td></tr>
                            <tr> <td>Present </td><td>22 Days </td></tr>
                            <tr> <td>Advance </td><td>0.00 </td></tr>
                            <tr> <td>Net Salary </td><td id="net_salary"></td></tr>

                            </tbody></table>
                    </div>
                    <div class="form-group">
                        <label for="new_salary" class="font-weight-bold text-dark" style="font-size: 14px;">Salary Amount</label>
                        <input type="number" id="new_salary" name="employee_salary" class="form-control" required readonly>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" id="amount_translate">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-700 font-size-16" for="payment_method">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="" disabled selected>Payment Method</option>
                            <option value="Bank Account">Bank Account</option>
                            <option value="Cash in Hand">Cash in Hand</option>
                            <option value="Mobile Banking">Mobile Banking</option>
                            <option value="Office Assets">Office Assets</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="opening_balance_sheet" class="font-weight-bold text-dark" style="font-size: 14px;">Attachment(If needed)</label>
                        <input type="file" id="attachment" name="attachment" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="transaction_note" class="font-weight-bold text-dark" style="font-size: 14px;">Transaction Note</label>
                        <textarea id="transaction_note" name="transaction_note" rows="2" cols="5" class="form-control form-control-lg"></textarea>
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



