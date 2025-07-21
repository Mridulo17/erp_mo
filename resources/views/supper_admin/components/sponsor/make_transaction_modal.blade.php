<div class="modal fade" id="make-transaction" tabindex="-1" aria-labelledby="modalTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Make Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4">
                        <img id="preview1" src="" style="" class="image-responsve">
                    </div>
                    <div class="col-sm-8">
                        <table class="table table-sm candidate_details_table">
                            <tbody>
                            <tr><td>Name</td><td>:</td><td id="sponsor_name1"><b></b></td></tr>
                            <tr><td>Phone</td><td>:</td><td id="cell_number1"><b></b></td></tr>
                            <tr><td>Email</td><td>:</td><td id="email1"><b></b></td></tr>
                            <tr><td>Address</td><td>:</td><td id="address1"><b></b></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- The Form -->
            <form id="transactionForm">
                @csrf
                <input type="hidden" id="sponsor" name="sponsor_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-700 font-size-16" for="transaction_type">Transaction Type</label>
                        <select name="transaction_type" id="transaction_type" class="form-control" required>
                            <option value="" disabled selected>Transaction Type</option>
                            <option value="Received Payment">Received Payment</option>
                            <option value="Give Payment">Give Payment</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="currency_id" class="font-weight-bold text-dark" style="font-size: 14px;">Currency <small id="currency_details" style="color: #ff0000"></small></label>
                                <select name="currency_id" id="currencySelect" class="form-control" required>
                                    <option value="" disabled selected>Choose Currency</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold text-dark" style="font-size: 14px;">Amount<small id="amount_currency"></small></label>
                                <input type="number" step="any" min="0" id="amount" name="amount" class="form-control" placeholder="Amount" required>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" id="amount_translate">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="salary" class="font-weight-bold text-dark" style="font-size: 14px;">BDT Amount</label>
                                <input type="number" id="bdt_amount" name="bdt_amount" class="form-control" placeholder="BDT Amount" required readonly style="color: #ff0000">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="candidate_id" class="font-weight-bold text-dark" style="font-size: 14px;">Care/Of Candidates</label>
                        <select name="candidate_id" id="candidateSelect" class="form-control">
                            <option value="" disabled selected>Candidates</option>
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



