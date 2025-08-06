<div id="view_ticket" class="modal center-modal fade view_profile_modal show" style="padding-right: 7px;" aria-modal="true">
    <div class="modal-dialog modal-sm" style="min-width: 20%;">
        <div class="modal-content" style="border-radius: 10px !important;">
            <div class="modal-header">
                <h5 class="modal-title view_profile_modal_title">View Candidate List</h5>
                <button type="button" class="close text-danger" data-dismiss="modal"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body view_candidate_container">
                <p class="m-0" id="view_name"></p>
                <p class="m-0" id="view_source"></p>
                <p class="m-0" id="view_type"></p>
                <p class="m-0" id="view_country"></p>
                <p class="m-0"><b>PNR</b>: <b class="text-danger" id="view_pnr"></b></p>
                <p class="m-0"><b>Flight</b>: <b class="text-success" id="view_flight"></b></p>
                <p class="m-0" id="view_time"></p>
            <hr>
            <ul style="list-style: decimal;" id="candidateList">
             </ul>
            </div>
        </div>
    </div>
</div>
