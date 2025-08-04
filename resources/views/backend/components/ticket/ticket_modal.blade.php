<div class="modal fade" id="modal-center" tabindex="-1" aria-labelledby="modalTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Buy Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- The Form -->
            <form id="visaForm">
                @csrf
                <input type="hidden" id="visa_id" name="visa_id" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Ticket name</label>
                                <input type="text" name="ticket_name" placeholder="Ticket name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Issue Date</label>
                                <input type="date" name="issue_date" value="{{date('Y-m-d')}}" placeholder="Issue Date" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Choose Source</label>
                                <select id="source" name="source" class="form-control" required>
                                    <option value="" disabled selected>Choose Source</option>
                                    <option value="IATA">IATA</option>
                                    <option value="Local Office">Local Office</option>
                                    <option value="Budget Carrier">Budget Carrier</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>To country</label>
                                <select name="country_id" id="countrySelect" class="form-control">
                                    <option value="" disabled selected>Choose Country</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Ticket Type</label>
                                <select id="ticket_type" name="ticket_type" class="form-control" required>
                                    <option value="" disabled selected>Choose Type</option>
                                    <option value="System Ticket - Single person">System Ticket - Single person</option>
                                    <option value="System Ticket - Multi person">System Ticket - Multi person</option>
                                    <option value="Group Ticket - Multi person">Group Ticket - Multi person</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Candidate Type</label>
                                <select id="candidateType" name="candidate_type_id" class="form-control" required>
                                    <option value="" disabled selected>Candidate Type</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="other-office-div" style="display: none">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Other Office</label>
                                <select id="selectOtherOffice" name="airline_office_id" class="form-control" required>
                                    <option value="" disabled selected>Other Office</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Airlines Office</label>
                                <select id="selectOffice" name="airline_office_id" class="form-control" required>
                                    <option value="" disabled selected>Airlines Office</option>
                                </select>
                             </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>&nbsp;&nbsp;&nbsp;</label>
                                <div class="checkbox checkbox-success">
                                    <input name="is_pre_purchase" id="is_pre_purchase" type="checkbox">
                                    <label for="is_pre_purchase"> Pre Purchase </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6" id="single-div">
                            <div class="form-group">
                                <label>Choose Candidate</label>
                                <select id="selectCandidate" name="airline_office_id[]" class="form-control">
                                    <option value="" disabled selected>Choose Candidate</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6" id="multiple-div" style="display: none">
                            <div class="form-group">
                                <label>Choose Candidate</label>
                                <select id="multiSelectCandidate" name="airline_office_id[]" class="form-control select2" multiple>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>PNR Number </label>
                                <input type="text" name="pnr_number" placeholder="PNR Number" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Attachment <span class="attachment"></span></label>
                                <input type="file" style="padding: 3px;" name="attachment" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Flight Date </label>
                                <input type="date" name="flight_date" placeholder="Flight Date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time</label>
                                <input type="time" name="flight_time" placeholder="Flight Time" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Flight Number</label>
                        <input type="text" name="flight_number" placeholder="Flight Number" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Purchase Payment Type</label>
                                <select id="purchase_payment_type" name="purchase_payment_type" class="form-control">
                                    <option value="" disabled selected>Payment Type</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Due">Due</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Purchase Amount</label>
                                <input type="number" step="any" name="purchase_amount" value="0" placeholder="Amount/Cost" class="form-control" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="payment_vat_tax_container" style="display: none">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Vat and/or Tax amount</label>
                                <input type="number" step="any" name="vat_or_tax_amount" placeholder="Vat and/or Tax amount" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div id="purchase_div" style="display: none">
                        <div class="form-group">
                            <label>Choose Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-control">
                                <option value="" disabled selected>Payment Method</option>
                                <option value="Bank Account">Bank Account</option>
                                <option value="Cash in Hand">Cash in Hand</option>
                                <option value="Mobile Banking">Mobile Banking</option>
                                <option value="Office Assets">Office Assets</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Transaction Related Note</label>
                            <textarea name="transaction_note" class="form-control" placeholder="Transaction Related Note"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Sell amount total <small><b class="c_qty text-danger"></b></small></label>
                                <input type="number" step="any" name="sell_amount_total" placeholder="Amount/Price" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Per ticket Amount</label>
                                <input type="number" step="any" name="per_ticket_amount" placeholder="Amount/Price" class="form-control" readonly="">
                                <input type="hidden" name="total_candidate" id="total_candidate">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="refund_button_container">
                        <div class="checkbox checkbox-success">
                            <input name="is_refundable" id="is_refundable" type="checkbox">
                            <label for="is_refundable"> Support Refund/Reissue </label>
                        </div>
                    </div>
                    <div id="make_flight" style="display: none;">
                        <div class="form-group">
                            <div class="checkbox checkbox-success">
                                <input name="make_flight_compleate" id="make_flight_compleate" type="checkbox" onchange="return make_flight_compleate_func();">
                                <label for="make_flight_compleate"> Make Flight Compleate </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="box-body">
                                    <div class="demo-radio-button">
                                        <input name="radio_paymeny_type" value="current_payment" type="radio" id="current_payment" class="radio-col-primary" checked="">
                                        <label for="current_payment">Current Payment</label>
                                        <input name="radio_paymeny_type" value="partial_payment" type="radio" id="partial_payment" class="radio-col-success">
                                        <label for="partial_payment">Partial Payment</label>
                                        <input name="radio_paymeny_type" value="payment_by_agent" type="radio" id="payment_by_agent" class="radio-col-info">
                                        <label for="payment_by_agent">Payment By Agent</label>
                                        <input name="radio_paymeny_type" value="due_payment" type="radio" id="due_payment" class="radio-col-warning">
                                        <label for="due_payment">Due Payment</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="payment_type_mood" value="current_payment">
                            <div class="col-sm-6">
                                <div class="form-group ticket_partial_payment_container">
                                    <label>Partial Amount</label>
                                    <input type="number" step="any" name="partial_sell_amount" max="" placeholder="Partial amount" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ticket_payment_method_container">
                                    <label>Ticket Price Received Payment Method</label>
                                    <select name="ticket_price_payment_method" class="form-control">
                                        <option value="" disabled selected>Payment Method</option>
                                        <option value="Bank Account">Bank Account</option>
                                        <option value="Cash in Hand">Cash in Hand</option>
                                        <option value="Mobile Banking">Mobile Banking</option>
                                        <option value="Office Assets">Office Assets</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Agent Commission</label>
                                    <input type="number" step="any" name="agent_commission" value="0" placeholder="Agent comission amount" class="form-control" required="">
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



