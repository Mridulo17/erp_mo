<div id="view_ticket" class="modal center-modal fade view_profile_modal show" style="padding-right: 7px;" aria-modal="true"><div class="modal-dialog modal-xl" style="min-width: 25%;"><div class="modal-content" style="border-radius: 10px !important;">
            <div class="modal-header">
                <h5 class="modal-title view_profile_modal_title">Ticket:<b id="view_ticket_name"></b></h5>
                <button type="button" class="close text-danger" data-dismiss="modal"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body view_profile_modal_body" style="overflow-x: hidden;max-height: 80vh; overflow-y: scroll;"><div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <center>
                                        <div class="logo-lg p-0">
                                            <span class="light-logo" style="font-size: 20px; font-weight: 500;"><i class="fa fa-plane" style="font-size: x-large;"></i><i><span style="color: #f00;">M</span>ahfuza<span style="color: #f00;">O</span>verseas</i></span>
                                        </div>
                                        Entry by: <b id="user_name">SHARIFUL ISLAM</b> |
                                        Employee id: <b></b><br>
                                        Department: <b></b> |
                                        Designation: <b></b><br>
                                        Date: <b id="ticket_date"></b>
                                    </center>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-sm candidate_details_table">
                                <tbody>
                                <tr>
                                    <td>Title</td><td>:</td><td><b id="title"></b></td>
                                    <td>Source</td><td>:</td><td><b id="view_source"></b></td>
                                </tr>
                                <tr>
                                    <td>Ticket type</td><td>:</td><td><b id="view_ticket_type"></b></td>
                                    <td>Country</td><td>:</td><td><b id="view_country"></b></td>
                                </tr>
                                <tr>
                                    <td>Office</td><td>:</td><td><b id="view_office"></b></td>
                                    <td>Quantity</td><td>:</td><td><b id="view_qty"></b></td>
                                </tr>
                                <tr>
                                    <td>PNR Number</td><td>:</td><td><b id="view_pnr"></b></td>
                                    <td>Attachment</td><td>:</td><td><b id="existing-file-preview1"></b></td>
                                </tr>
                                <tr>
                                    <td>Flight date</td><td>:</td><td><b id="view_flight_date"></b></td>
                                    <td>Flight time</td><td>:</td><td><b id="view_flight_time"></b></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <script>
                    function remove_assign_candidate(candidate_id, ticket_id){
                        Swal.fire({
                            title				: 'Are you sure?',
                            text				: "You have to assign candidate again",
                            icon				: 'warning',
                            showCancelButton	: true,
                            confirmButtonColor	: '#3085d6',
                            cancelButtonColor	: '#d33',
                            confirmButtonText	: 'Yes, remove it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.post({
                                    url: 'http://erp.mahfuza-overseas.com/mahfuza_v2/home-pages/sponsor/buy-ticket',
                                    data: {remove_assign_candidate: 'active', candidate_id: candidate_id, ticket_id: ticket_id},
                                    beforeSend: function(){},
                                    success: function(data){
                                        var value = jQuery.parseJSON(data);
                                        $('#ajax_message').html(value['message']);
                                        view_ticket('ticket', ticket_id);
                                    }
                                });
                            }
                        });
                    }
                </script></div>
        </div>
    </div>
</div>
