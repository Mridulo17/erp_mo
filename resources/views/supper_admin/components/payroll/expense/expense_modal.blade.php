<div class="modal fade" id="modal-center" tabindex="-1" aria-labelledby="modalTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- The Form -->
            <form id="expenseForm">
                @csrf
                <input type="hidden" id="expense_id" name="expense_id" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="font-weight-bold text-dark" style="font-size: 14px;">Expense Category </label>
                        <select name="expense_category_id" id="categorySelect" class="form-control" required>
                            <option value="" disabled selected>Expense Category</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name" class="font-weight-bold text-dark" style="font-size: 14px;">Expense Item </label>
                        <select name="expense_item_id" id="itemSelect" class="form-control" required>
                            <option value="" disabled selected>Expense Item</option>
                        </select>
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
                        <label for="currency_id" class="font-weight-bold text-dark" style="font-size: 14px;">Currency <small id="currency_details" style="color: #ff0000"></small></label>
                        <select name="currency_id" id="currencySelect" class="form-control" required>
                            <option value="" disabled selected>Choose Currency</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name" class="font-weight-bold text-dark" style="font-size: 14px;">Amount<small id="amount_currency"></small></label>
                        <input type="number" step="any" min="0" id="amount" name="amount" class="form-control" placeholder="Amount" required>
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
                        <label for="month_year" class="font-weight-bold text-dark" style="font-size: 14px;">Month-Year</label>
                        <input type="month" id="month_year" name="month_year" class="form-control" placeholder="Month-Year">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" id="is_expire" class="form-check-input">
                        <label class="form-check-label" for="is_expire">Is Expire</label>
                    </div>
                    <div class="form-group" id="perDiv" style=display:none;>
                        <label for="expiry_date" class="font-weight-bold text-dark" style="font-size: 14px;">Expiry Date</label>
                        <input type="date" id="expiry_date" name="expiry_date" class="form-control" placeholder="Expiry Date" required>
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



