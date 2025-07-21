<div id="transaction-details" class="modal modal-left fade make_transaction_modal" style="padding-right: 7px;" aria-modal="true" role="dialog">
    <div class="modal-dialog" style="min-width: 25%;">
        <div class="modal-content" style="border-radius: 10px !important;">
            <div class="modal-header">
                <h5 class="modal-title view_leave_modal_title">Related transaction about: <b id="sponsor_name"></b></h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body view_leave_modal_body" style="overflow-x: hidden;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box-body pt-0 pb-0">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="data-table-transaction" class="table table-sm table-bordered table-hover display nowrap margin-top-10 w-p100 dataTable no-footer" role="grid" aria-describedby="data-table-transaction_info" style="width: 0px;">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Account</th>
                                            <th>B:Balance</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>A:Balance</th>
                                            <th>Note</th>
                                        </tr>
                                        </thead>
                                        <tbody id="transaction_data_list">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
</div>
