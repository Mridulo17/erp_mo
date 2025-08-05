<div id="view_ticket" class="modal center-modal fade view_profile_modal show" style="padding-right: 7px;" aria-modal="true"><div class="modal-dialog modal-xl" style="min-width: 25%;"><div class="modal-content" style="border-radius: 10px !important;">
            <div class="modal-header">
                <h5 class="modal-title view_profile_modal_title">Ticket:<b id="profile_sponsor"></b></h5>
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
                                        Entry by: <b>SHARIFUL ISLAM</b> |
                                        Employee id: <b>00010</b><br>
                                        Department: <b>Reservation</b> |
                                        Designation: <b>Executive</b><br>
                                        Date: <b>Thursday, 28th of November 2024 (2024-11-28)</b>
                                    </center>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-sm candidate_details_table">
                                <tbody>
                                <tr>
                                    <td>Title</td><td>:</td><td><b>SHAHED AHMED, BABUL MIA_ZYL-DAC</b></td>
                                    <td>Source</td><td>:</td><td><b>Local Office</b></td>
                                </tr>
                                <tr>
                                    <td>Ticket type</td><td>:</td><td><b>System Ticket - Multi person</b></td>
                                    <td>Country</td><td>:</td><td><b>Bangladesh</b></td>
                                </tr>
                                <tr>
                                    <td>Office</td><td>:</td><td><b>Trip Lover</b></td>
                                    <td>Quantity</td><td>:</td><td><b>2</b></td>
                                </tr>
                                <tr>
                                    <td>PNR Number</td><td>:</td><td><b>TOJGTA</b></td>
                                    <td>Attachment</td><td>:</td><td><b><a href="http://erp.mahfuza-overseas.com/mahfuza_v2/assets/uploads/documents/ticket/files_2024_11_29_335631489852819314.pdf" title="click to view file" target="_blank" class="mr-5"><i class="fa fa-file"></i></a></b></td>
                                </tr>
                                <tr>
                                    <td>Flight date</td><td>:</td><td><b>2024-11-30</b></td>
                                    <td>Flight time</td><td>:</td><td><b>04:10:00 pm</b></td>
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
