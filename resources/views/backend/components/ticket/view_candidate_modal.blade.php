<div id="view_candidate" class="modal center-modal fade view_profile_modal show" style="padding-right: 7px;" aria-modal="true"><div class="modal-dialog modal-xl" style="min-width: 25%;"><div class="modal-content" style="border-radius: 10px !important;">
            <div class="modal-header">
                <h5 class="modal-title view_profile_modal_title"><b id="view_candidate_name"></b>'s Profile</h5><button type="button" class="close text-danger" data-dismiss="modal"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body view_profile_modal_body" style="overflow-x: hidden;max-height: 80vh; overflow-y: scroll;">
                <link rel="stylesheet" type="text/css" href="http://erp.mahfuza-overseas.com/mahfuza_v2/assets/home/js/cropper/cropper.css">
                <div class="row">
                    <div class="col-sm-12 print_button_container">
                        <button type="button" class="btn btn-xs btn-warning" style="float: right;" id="print_button_new"><i class="fa fa-print"></i> &nbsp; Print</button>
                    </div>
                </div>
                <div class="row" id="print-area-2">
                    <div class="col-sm-12">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <center>
                                                <div class="logo-lg p-0">
                                                    <span class="light-logo" style="font-size: 20px; font-weight: 500;"><i class="fa fa-plane" style="font-size: x-large;"></i><i><span style="color: #f00;">M</span>ahfuza<span style="color: #f00;">O</span>verseas</i></span>
                                                </div>
                                                Registration by: <b id="candidate_registration_by"></b> |
                                                Employee id: <b></b><br>
                                                Department: <b></b> |
                                                Designation: <b></b><br>
                                                Date: <b id="candidate_date"></b>
                                            </center>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3" style="max-width: 30%;">
                                            <div class="image_preview">

                                            </div>
                                        </div>
                                        <div class="col-sm-9" style="max-width: 70%;">
                                            <b><u>Personal Information</u></b>
                                            <table class="table table-sm">
                                                <tbody><tr>
                                                    <td>First name</td> <td>:</td> <td><b id="first_name"></b></td>
                                                    <td>Last name</td> <td>:</td> <td><b id="last_name"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Gender</td> <td>:</td> <td><b id="gender"></b></td>
                                                    <td>Date of birth</td> <td>:</td> <td><b id="dob"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td> <td>:</td> <td><b id="email"></b></td>
                                                    <td>Phone number</td> <td>:</td> <td><b id="number"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Contact person number</td> <td>:</td> <td><b id="contact"></b></td>
                                                    <td>NID / Birth certificate</td> <td>:</td> <td><b id="birth"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Father name</td> <td>:</td> <td><b id="father"></b></td>
                                                    <td>Mother name</td> <td>:</td> <td><b id="mother"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Marital status</td> <td>:</td> <td><b id="marital"></b></td>
                                                    <td>Spouse name</td> <td>:</td> <td><b id="spouse"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Nominee name</td> <td>:</td> <td><b id="nominee"></b></td>
                                                    <td>Relation with nominee</td> <td>:</td> <td><b id="relation"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Religion</td> <td>:</td> <td><b id="religion"></b></td>
                                                    <td>Blood group</td> <td>:</td> <td><b id="blood"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Note</td> <td>:</td> <td colspan="4"><b id="note"></b></td>
                                                </tr>
                                                </tbody></table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8 mt-30">
                                            <b><u>Basic Information</u></b>
                                            <table class="table table-sm">
                                                <tbody><tr>
                                                    <td style="width: 150px;">Candidate type</td> <td>:</td> <td colspan="4"><b id="type"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">Interested Country</td> <td>:</td> <td><b id="interested_country"></b></td>
                                                    <td style="width: 150px;">Interested job</td> <td>:</td> <td><b id="interested_job"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">Process Country</td> <td>:</td> <td><b id="process_country">Bangladesh</b></td>
                                                    <td style="width: 150px;">Process job</td> <td>:</td> <td><b id="process_job">N/A</b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">Referral Agent</td> <td>:</td> <td><b id="referral_agent"></b></td>
                                                    <td style="width: 150px;">Nationality</td> <td>:</td> <td><b id="nationality"></b></td>
                                                </tr>
                                                </tbody></table>
                                        </div>
                                        <div class="col-sm-4 mt-30">
                                            <b><u>Document Information</u></b>
                                            <table class="table table-sm">
                                                <tbody><tr>
                                                    <td>Candidate photo</td> <td>:</td> <td><b id="img_pre"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Police Verification</td> <td>:</td> <td><b>
                                                        </b></td>
                                                </tr>
                                                <tr>
                                                    <td>Other Certification</td> <td>:</td> <td><b>
                                                        </b></td>
                                                </tr>
                                                <tr>
                                                    <td>Optional File/Files</td> <td>:</td> <td><b>
                                                        </b></td>
                                                </tr>
                                                </tbody></table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <b><u>Experience Information</u></b>
                                            <table class="table table-sm">
                                                <tbody id="candidateExperience">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <b><u>Passport Information</u></b>
                                            <table class="table table-sm">
                                                <tbody><tr>
                                                    <td style="width: 150px;">Passport Number</td> <td>:</td> <td><b id="pass_no"></b></td>
                                                    <td style="width: 150px;">Passport Issue Date</td> <td>:</td> <td><b id="pass_issue_date"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">Passport Issue Place</td> <td>:</td> <td><b id="pass_issue_place"></b></td>
                                                    <td style="width: 150px;">Validity Year</td> <td>:</td> <td><b id="validate_year"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">Passport Scan Copy</td> <td>:</td> <td><b id="pass_scan"></b></td>
                                                    <td style="width: 150px;">Note</td> <td>:</td> <td><b id="pass_note"></b></td>
                                                </tr>
                                                </tbody></table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <b><u>Location Information</u></b>
                                            <table class="table table-sm">
                                                <tbody><tr>
                                                    <td style="width: 150px;">Country</td> <td>:</td> <td><b id="country"></b></td>
                                                    <td style="width: 150px;">Division</td> <td>:</td> <td><b id="division"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">District</td> <td>:</td> <td><b id="district"></b></td>
                                                    <td style="width: 150px;">Thana</td> <td>:</td> <td><b id="thana"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">PostOffice</td> <td>:</td> <td><b id="postOffice"></b></td>
                                                    <td style="width: 150px;">State</td> <td>:</td> <td><b id="state"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">Current address</td> <td>:</td> <td colspan="4"><b id="current_address"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">Permanent address</td> <td>:</td> <td colspan="4"><b id="permanent_address"></b></td>
                                                </tr>
                                                </tbody></table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <b><u>Candidate Related All files</u></b>
                                            <table class="table table-sm">
                                                <tbody><tr><td>Candidate Photo</td> <td>:</td> <td><a href="http://erp.mahfuza-overseas.com/mahfuza_v2/assets/uploads/documents/candidate/files_2024_11_30_374426092666812548.jpg" target="_blank"><i class="fa fa-eye"></i></a></td></tr>																																																																							</tbody></table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-7">
                                            <b><u>Candidate Ticket Information</u></b>
                                            <table class="table table-sm">
                                                <tbody><tr>
                                                    <td style="width: 150px;">Ticket name</td> <td>:</td> <td><b id="candidate_ticket"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">Ticket Source</td> <td>:</td> <td><b id="candidate_source"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">Ticket Type</td> <td>:</td> <td><b id="candidate_ticket_type"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">Ticket Country</td> <td>:</td> <td><b id="ticket_country"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">Office Name</td> <td>:</td> <td><b id="candidate_office_name"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">PNR - Flight</td> <td>:</td> <td><b id="pnr_flight"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">Flight Time</td> <td>:</td> <td><b id="candidate_flight_date_time"></b></td>
                                                </tr>
                                                <tr>.
                                                    <td style="width: 150px;">Attachment</td> <td>:</td> <td id="candidate_ticket_attachment"></td>
                                                </tr>
                                                </tbody></table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    var $modal = $('#modal_profile_picture');
                    var image = document.getElementById('sample_image');
                    var cropper;
                    function close_inner_modal(){
                        $modal.modal('hide');
                    }
                    $(document).ready(function(){
                        $('#upload_image').change(function(event){
                            var files = event.target.files;
                            var done = function(url){
                                image.src = url;
                                $modal.modal('show');
                            };
                            if(files && files.length > 0) {
                                reader = new FileReader();
                                reader.onload = function(event) {
                                    done(reader.result);
                                };
                                reader.readAsDataURL(files[0]);
                            }
                        });
                        $modal.on('shown.bs.modal', function() {
                            cropper = new Cropper(image, {
                                viewMode: 2,
                                preview:'.preview'
                            });
                        }).on('hidden.bs.modal', function(){
                            cropper.destroy();
                            cropper = null;
                        });
                        $('#crop').click(function(){
                            canvas = cropper.getCroppedCanvas({
                                width:800,
                                height:800
                            });
                            canvas.toBlob(function(blob){
                                url = URL.createObjectURL(blob);
                                var reader = new FileReader();
                                reader.readAsDataURL(blob);
                                reader.onloadend = function(){
                                    var base64data = reader.result;
                                    $.ajax({
                                        url:'http://erp.mahfuza-overseas.com/mahfuza_v2/home-pages/candidates/new-candidates',
                                        method:'POST',
                                        data:{
                                            candidate_profile_picture_change: 'active',
                                            candidate_id: '1649',
                                            image: base64data
                                        },
                                        beforeSend: function(data){ $.skylo('start'); },
                                        success:function(data) {  $.skylo('end');
                                            var value = jQuery.parseJSON(data);
                                            $('#ajax_message').html(value['message']);
                                            if(value['type'] == 1){
                                                $modal.modal('hide');
                                                $('#uploaded_image').attr('src', value['picture']);
                                            }
                                        }
                                    });
                                };
                            });
                        });
                    });

                    $('.print_button_container').off();
                    $('.print_button_container').on('click', '#print_button_new', function () {
                        $("#print-area-2").printThis({
                            debug: true,                   // show the iframe for debugging
                            importCSS: true,                // import parent page css
                            importStyle: true,             // import style tags
                            printContainer: true,           // grab outer container as well as the contents of the selector
                            // loadCSS: "path/to/my.css",      // path to additional css file - use an array [] for multiple
                            pageTitle: "",                  // add title to print page
                            removeInline: false,            // remove all inline styles from print elements
                            removeInlineSelector: "body *", // custom selectors to filter inline styles. removeInline must be true
                            printDelay: 333,                // variable print delay
                            header: null,                   // prefix to html
                            footer: null,                   // postfix to html
                            base: false,                    // preserve the BASE tag, or accept a string for the URL
                            formValues: true,               // preserve input/form values
                            canvas: false,                  // copy canvas elements
                            doctypeString: '',           // enter a different doctype for older markup
                            removeScripts: false,           // remove script tags from print content
                            copyTagClasses: false           // copy classes from the html & body tag
                            // beforePrintEvent: null,         // callback function for printEvent in iframe
                            // beforePrint: null,              // function called before iframe is filled
                            // afterPrint: null                // function called before iframe is removed
                        });
                    });
                </script>
                <style>
                    .image_area {
                        position: relative;
                    }

                    img {
                        display: block;
                        max-width: 100%;
                    }

                    .preview {
                        overflow: hidden;
                        width: 160px;
                        height: 160px;
                        margin: 10px;
                        border: 1px solid red;
                    }

                    .modal-lg{
                        max-width: 1000px !important;
                    }

                    .overlay {
                        position: absolute;
                        bottom: 10px;
                        left: 0;
                        right: 0;
                        background-color: rgba(255, 255, 255, 0.5) !important;
                        overflow: hidden;
                        height: 0;
                        transition: .5s ease;
                        width: 100%;
                        border-radius: 0px !important;
                    }

                    .image_area:hover .overlay {
                        height: 100%;
                        cursor: pointer;
                    }

                    .text { color: #333; font-size: 20px; position: absolute; top: 50%; left: 50%; -webkit-transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%); text-align: center; }
                </style>
            </div>
            </div>
        </div>
    </div>
