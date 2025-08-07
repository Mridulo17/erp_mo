@extends('backend.layouts.app')
@section('title', config('app.name') . ' - Assign Ticket')

@section('style')
    <style>
        .wrap-text {
            white-space: normal !important;
            word-wrap: break-word !important;
            word-break: break-word !important;
        }
    </style>
@endsection

@section('content')

    @if (session('status'))
        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (session('status') == 'success')
                            <i class="fas fa-check-circle text-success"></i>
                            <h5 class="mt-3 text-success">Success</h5>
                        @else
                            <i class="fas fa-times-circle text-danger"></i>
                            <h5 class="mt-3 text-danger">Error</h5>
                        @endif
                        <p class="mt-2">{{ session('message') }}</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="box">
        <!-- Header Section -->
        <div class="box-header with-border d-flex justify-content-between align-items-center">
            <div>
                <h3 class="box-title">Assign Ticket</h3>
                <h6 class="box-subtitle">This is all Assign Ticket List</h6>
            </div>
            <button type="button" class="btn btn-warning addBlogButton" data-toggle="modal" data-target="#modal-center">
                <i class="fa-solid fa-plus"></i> Add Data
            </button>
        </div>

        @include('backend.components.ticket.assign_ticket_modal')
        @include('backend.components.ticket.view_candidate_list_modal')
        @include('backend.components.ticket.view_candidate_modal')

        <div class="box-body">
            <div class="table-responsive">
                <table id="customDataTable" style="table-layout: fixed; width: 100%;"
                       class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                    <thead>
                    <tr>
                        <th style="">Action</th>
                        <th style="">DB:ID</th>
                        <th style="">Ticket</th>
                        <th style="">Type</th>
                        <th title="Passenger Name Record" style="">PNR</th>
                        <th title="Candidate Number" style="">C:N</th>
                       <th style="">Flight Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $key =>$bonus)
                        <tr>
                            <td>
                                <div class="btn-group">

                                        <!-- Edit Button inside Dropdown -->
                                        <a href="#" class="dropdown-item editBlogButton btn btn-primary btn-sm" title="View Candidate" data-toggle="modal" data-target="#view_ticket" data-id="{{ $bonus->id }}">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                </div>
                            </td>

                            <td>{{ $key + 1 }}</td>
                            <td class="wrap-text">{{ $bonus->ticket ? $bonus->ticket->ticket_name : '' }}</td>
                            <td class="wrap-text">{{ $bonus->ticket_type  }}</td>
                            <td class="wrap-text">{{ $bonus->pnr_number  }}</td>
                            <td class="wrap-text">{{ $bonus->total_candidate  }}</td>
                            <td class="wrap-text">{{ $bonus->created_at->format('Y-m-d')  }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            function fetchAssignTickets() {
                $.ajax({
                    url: '{{ route("admin.assign-tickets.index") }}',
                    type: 'GET',
                    success: function (data) {
                        let newBody = $(data).find('#customDataTable tbody').html();
                        $('#customDataTable tbody').html(newBody);
                    },
                    error: function () {
                        console.error('Failed to refresh assign ticket table.');
                    }
                });
            }

            $('#modal-center').on('shown.bs.modal', function () {
                $('.wrapper').removeAttr('aria-hidden');
            });

            // When the modal is hidden
            $('#modal-center').on('hidden.bs.modal', function () {
                $('.wrapper').attr('aria-hidden', 'true');
            });

            $(document).ready(function () {

                fetchTickets();

                function fetchTickets() {
                    $.ajax({
                        url: "{{ route('admin.pre-purchase-ticket') }}",
                        method: "GET",
                        success: function (data) {
                            let select = $('#selectTicket');
                            select.empty();
                            select.append('<option value="" disabled selected>Choose Ticket</option>');

                            data.forEach(function (ticket) {
                                select.append(
                                    '<option data-total_candidate="' + ticket.total_candidate + '" data-ticket_type="' + ticket.ticket_type + '" data-candidate_type_id="' + ticket.candidate_type_id + '" value="' + ticket.id + '">' +
                                    ticket.ticket_name +
                                '</option>'
                                );
                            });
                        },
                        error: function (xhr) {
                            console.error("Failed to fetch tickets:", xhr);
                        }
                    });
                }

                fetchCandidates();

                function fetchCandidates(typeId, selectedCandidateId) {
                    $.ajax({
                        url: "{{ route('admin.candidate.active') }}",
                        method: "GET",
                        data: {candidate_type_id: typeId}, // Pass candidate_type_id to filter employees
                        success: function (data) {
                            let select = $('#SelectCandidate');
                            select.empty();

                            data.forEach(function (candidate) {
                                let selected = candidate.id === selectedCandidateId ? 'selected' : '';
                                select.append(
                                    '<option value="' + candidate.id + '" ' + selected + '>' +
                                    candidate.personal_info.first_name + ' ' +
                                    candidate.personal_info.last_name +
                                    '</option>'
                                );
                            });
                            // Ensure the item dropdown value is updated after population
                            select.val(selectedCandidateId).trigger('change');  // Set selected candidate
                        },
                        error: function (xhr) {
                            console.error("Failed to fetch candidates:", xhr);
                        }
                    });
                }

                // Trigger the fetchEmployees function when a category is selected
                $('#selectTicket').on('change', function () {
                    const selectedOption = $(this).find('option:selected');
                    const ticket_type = selectedOption.data('ticket_type');
                    const total_candidate = selectedOption.data('total_candidate');
                    if(ticket_type === "System Ticket - Multi person" || ticket_type === "Group Ticket - Multi person") {
                        $('#complete_assign_div').show();
                        $('#show_total_candidate_text').text("(" +" Selected candidate should be " + total_candidate + ")");
                    } else {
                        $('#complete_assign_div').hide();
                    }
                    const candidate_type_id = selectedOption.data('candidate_type_id');
                    if (candidate_type_id) {
                        fetchCandidates(candidate_type_id);  // Fetch candidate based on the selected type
                    }
                });

                function getSelectedCount() {
                    return $('#SelectCandidate option:selected').length;
                }

                function getTotalCandidate() {
                    const selectedOption = $('#selectTicket').find('option:selected');
                    return selectedOption.data('total_candidate');
                }

                $('#is_complete_assigned').on('change', function () {
                    const selectedCount = getSelectedCount();
                    const totalCandidate = getTotalCandidate();

                    if ($(this).is(':checked')) {
                        if (selectedCount !== totalCandidate) {
                            // Show warning
                            $('#show_total_candidate_text').text(
                                "(You must select exactly " + totalCandidate + " candidates)"
                            );

                            // Uncheck the checkbox
                            $(this).prop('checked', false);
                        } else {
                            $('#show_total_candidate_text').text(""); // clear warning
                        }
                    } else {
                        $('#show_total_candidate_text').text(""); // clear warning on uncheck
                    }
                });

                // Optional: clear warning on select change
                $('#SelectCandidate').on('change', function () {
                    if ($('#is_complete_assigned').is(':checked')) {
                        // Revalidate when changing selection
                        $('#is_complete_assigned').trigger('change');
                    }
                });

                $('#ticketForm').on('submit', function (e) {
                    e.preventDefault();
                    let isEdit = $('#ticket_id').val() !== '';
                    let formData = new FormData(this);
                    let id = $('#ticket_id').val();
                    formData.set('is_complete_assigned', $('#is_complete_assigned').is(':checked') ? '1' : '0');
                    const baseUpdateUrl = "{{ url('admin/assign-tickets') }}";
                    let url = isEdit
                        ? `${baseUpdateUrl}/${id}`
                        : `{{ route('admin.assign-tickets.store') }}`;

                    let method = isEdit ? 'POST' : 'POST';
                    if (isEdit) {
                        formData.append('_method', 'PUT');
                    }

                    Swal.fire({
                        title: isEdit ? "Update Assign?" : "Assign Ticket?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Yes, proceed"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: method,
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    if (response.status === 'success') {
                                        $('#modal-center').modal('hide');
                                        Swal.fire('Success!', response.message, 'success');
                                        $('#ticketForm')[0].reset();
                                        $('#ticket_id').val('');
                                        fetchAssignTickets();
                                    } else {
                                        Swal.fire('Error!', response.message, 'error');
                                    }
                                },
                                error: function () {
                                    Swal.fire('Error!', 'Failed to assign ticket.', 'error');
                                }
                            });
                        }
                    });
                });

                $(document).on('click', '.addBlogButton', function () {
                    $('#ticketForm')[0].reset();
                    $('#ticket_id').val('');
                    $('#countrySelect').val('').trigger('change');
                    $('#candidateType').val('').trigger('change');
                    $('#selectOtherOffice').val('').trigger('change');
                    $('#selectOffice').val('').trigger('change');
                    $('#SelectCandidate').val('').trigger('change');
                    $('#multiSelectCandidate').val('').trigger('change');
                    $('#modalTitle').text('Assign Ticket');
                    $('#modal-center').modal('show');

                });

                $(document).on('click', '.editBlogButton', function () {
                    const id = $(this).data('id');
                    const url = '{{ route("admin.assign-tickets.edit", ":id") }}'.replace(':id', id);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (res) {
                            $('#view_name').html('<b>Name</b>: ' + res.ticket.ticket_name);
                            $('#view_source').html('<b>Source</b>: ' + res.ticket.source);
                            $('#view_type').html('<b>Type</b>: ' + res.ticket_type);
                            $('#view_country').html('<b>Country</b>: ' + res.ticket.country.name);
                            $('#view_pnr').text(res.pnr_number);
                            $('#view_flight').text(res.ticket.flight_number);
                            const time = res.ticket.flight_time;
                            const dateTime = '1970-01-01T' + time; // ISO 8601 format

                            const formattedTime = new Date(dateTime).toLocaleTimeString('en-US', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });

                            $('#view_time').html('<b>Time</b>: ' + res.ticket.flight_date + ' - ' + '<small></small>' + formattedTime);
                            let candidateListHtml = '';

                            res.assign_ticket_candidates.forEach(function (candidate) {
                                candidateListHtml += `
        <li>
            <a href="#" class="dropdown-item viewCandidateButton" data-toggle="modal" data-target="#view_candidate" data-id="${candidate.id}">
                <b>${candidate.candidate.personal_info.first_name} ${candidate.candidate.personal_info. last_name}</b>
            </a>(${candidate.candidate.candidate_type.name})
        </li>`;
                            });

                            $('#candidateList').html(candidateListHtml);

                            $('#modalTitle').text('View Ticket');
                            $('#view_ticket').modal('show');
                        },
                        error: function () {
                            Swal.fire('Error', 'Could not load ticket data.', 'error');
                        }
                    });
                });

                $(document).on('click', '.viewCandidateButton', function () {
                    const id = $(this).data('id');
                    const url = '{{ route("admin.assign-ticket.candidateInfoByID", ":id") }}'.replace(':id', id);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (res) {
                            $('#view_candidate_name').text(res.candidate.personal_info.first_name + ' '+res.candidate.personal_info.last_name);
                            $('#candidate_registration_by').text(res.assign_ticket.ticket.user.name);
                            const date = new Date(res.created_at);
                            const formattedDate = date.toISOString().split('T')[0]; // YYYY-MM-DD

                            const formattedRegistrationDay = date
                                    .toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })
                                    .replace(/(\d+)(?=,)/, (_, d) => d + (["th","st","nd","rd"][(d%10>3||Math.floor(d%100/10)==1)?0:d%10]) + ' of')
                                + ` (${formattedDate})`;
                            $('#candidate_date').text(formattedRegistrationDay);
                            if (res.candidate.file && res.candidate.file.file_type === 'photo' && res.candidate.file.file_path) {
                                const filePath = res.candidate.file.file_path;
                                const fileUrl = `/storage/${filePath}`;

                                let previewHtml = '';
                                let previewLinkHtml = '';

                                previewHtml = `<img src="${fileUrl}" class="img-responsive img-circle">`;
                                previewLinkHtml = `<a href="${fileUrl}" title="click to view file" target="_blank" class="mr-5"><i class="fa fa-file"></i></a>	`;

                                $('#image_preview').html(previewHtml);
                                $('#img_pre').html(previewLinkHtml);
                            }
                            $('#first_name').text(res.candidate.personal_info.first_name);
                            $('#last_name').text(res.candidate.personal_info.last_name);
                            $('#gender').text(res.candidate.personal_info.gender.name);
                            $('#dob').text(res.candidate.personal_info.date_of_birth);
                            $('#email').text(res.candidate.personal_info.email);
                            $('#number').text(res.candidate.personal_info.phone_number);
                            $('#contact').text(res.candidate.personal_info.contact_person_number);
                            $('#birth').text(res.candidate.personal_info.nid_or_birth_certificate);
                            $('#father').text(res.candidate.personal_info.father_name);
                            $('#mother').text(res.candidate.personal_info.mother_name);
                            $('#marital').text(res.candidate.personal_info.marital_status);
                            $('#spouse').text(res.candidate.personal_info.spouse_name);
                            $('#nominee').text(res.candidate.personal_info.nominee_name);
                            $('#relation').text(res.candidate.personal_info.nominee_relation.name);
                            $('#religion').text(res.candidate.personal_info.religion.name);
                            $('#blood').text(res.candidate.personal_info.blood_group.name);
                            $('#note').text(res.candidate.personal_info.note);

                            $('#type').text(res.candidate.candidate_type.name);
                            $('#interested_country').text(res.candidate.country.name);
                            $('#interested_job').text(res.candidate.profession.name);
                            $('#referral_agent').text(res.candidate.agent.first_name + ' ' + res.candidate.agent.last_name);
                            $('#nationality').text(res.candidate.nationality);

                            let candidateExperienceHtml = '';

                            res.candidate.experiences.forEach(function (experience) {
                                candidateExperienceHtml += `
        <tr>
            <td style="width: 150px;">Experience Type</td> <td>:</td> <td colspan="4"><b>${experience.experience_type}</b></td>
        </tr>
        <tr>
            <td style="width: 150px;">Company Name</td> <td>:</td> <td><b>${experience.company_name}</b></td>
            <td>Work Type</td> <td>:</td> <td><b>${experience.workType?.name || ''}</b></td>
        </tr>
        <tr>
            <td style="width: 150px;">Departure Date</td> <td>:</td> <td><b>${experience.departure_date}</b></td>
            <td>Arrival Date</td> <td>:</td> <td><b>${experience.arrival_date}</b></td>
        </tr>
        <tr>
            <td style="width: 150px;">Departure Seal</td> <td>:</td> <td><b>${experience.departure_seal}</b></td>
            <td>Arrival Seal</td> <td>:</td> <td><b>${experience.arrival_seal}</b></td>
        </tr>
        <tr>
            <td style="width: 150px;">Old Company Address</td> <td>:</td> <td colspan="4"><b>${experience.old_company_address}</b></td>
        </tr>
        <tr>
            <td style="width: 150px;">Travelled Country</td> <td>:</td> <td colspan="4"><b>${experience.travelledCountry?.name || ''}</b></td>
        </tr>
        <tr><td colspan="6" style="border-bottom: 2px solid #ddd;"></td></tr>
    `;
                            });

                            $('#candidateExperience').html(candidateExperienceHtml);

                            $('#pass_no').text(res.candidate.passport.passport_number);
                            $('#pass_issue_date').text(res.candidate.passport.passport_issue_date);
                            $('#pass_issue_place').text(res.candidate.passport.issue_place.name);
                            $('#validate_year').text(res.candidate.passport.validity_years);
                            $('#pass_note').text(res.candidate.passport.note);

                            if (res.candidate.passport.passport_scan_copy) {
                                const filePath = res.candidate.passport.passport_scan_copy;
                                const fileUrl = `/storage/${filePath}`;

                                let passportHtml = '';

                                passportHtml = `<a href="${fileUrl}" title="click to view file" target="_blank" class="mr-5"><i class="fa fa-file"></i></a>	`;

                                $('#pass_scan').html(passportHtml);
                            }
                            $('#country').text(res.candidate.location.country.name);
                            $('#division').text(res.candidate.location.division.name);
                            $('#district').text(res.candidate.location.district.name);
                            $('#thana').text(res.candidate.location.thana.name);
                            $('#postOffice').text(res.candidate.location.post_office.name);
                            $('#state').text(res.candidate.location.state.name);
                            $('#current_address').text(res.candidate.location.current_address);
                            $('#permanent_address').text(res.candidate.location.permanent_address);


                            $('#candidate_ticket').text(res.assign_ticket.ticket.ticket_name);
                            $('#candidate_source').text(res.assign_ticket.ticket.source);
                            $('#candidate_ticket_type').text(res.assign_ticket.ticket.ticket_type);
                            $('#ticket_country').text(res.assign_ticket.ticket.country.name);
                            $('#candidate_office_name').text(res.assign_ticket.ticket.airline_office.name);
                            $('#pnr_flight').text(res.assign_ticket.ticket.pnr_number + '-' + res.assign_ticket.ticket.flight_number);

                            const time = res.assign_ticket.ticket.flight_time;
                            const dateTime = '1970-01-01T' + time; // ISO 8601 format

                            const formattedTime = new Date(dateTime).toLocaleTimeString('en-US', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });
                            $('#candidate_flight_date_time').text(res.assign_ticket.ticket.flight_date + '-' + formattedTime);

                            if (res.assign_ticket.ticket.attachment) {
                                const filePath = res.assign_ticket.ticket.attachment;
                                const fileUrl = `/storage/${filePath}`;

                                let passportHtml = '';

                                passportHtml = `<a href="${fileUrl}" title="click to view file" target="_blank" class="mr-5"><i class="fa fa-file"></i></a>	`;

                                $('#candidate_ticket_attachment').html(passportHtml);
                            }

                            let candidateDocsHtml = '';

                            res.candidate.files.forEach(function (eachFile) {
                                if (eachFile.file_path) {
                                    const filePath = eachFile.file_path;
                                    const fileUrl = `/storage/${filePath}`;

                                    // Format file_type: "passport_copy" => "Passport Copy"
                                    const formattedType = eachFile.file_type
                                        .replace(/_/g, ' ')                // replace underscores with spaces
                                        .replace(/\b\w/g, char => char.toUpperCase()); // capitalize each word

                                    candidateDocsHtml += `
            <tr>
                <td>${formattedType}</td>
                <td>:</td>
                <td><a href="${fileUrl}" target="_blank"><i class="fa fa-eye"></i></a></td>
            </tr>
        `;
                                }
                            });

                            $('#related_docs').html(candidateDocsHtml);



                            $('#modalTitle').text('View Ticket');
                            $('#view_candidate').modal('show');
                        },
                        error: function () {
                            Swal.fire('Error', 'Could not load candidate data.', 'error');
                        }
                    });
                });

                $(document).on('click', '.deleteBonusBtn', function () {
                    const id = $(this).data('id');
                    const url = '{{ route("admin.tickets.destroy", ":id") }}'.replace(':id', id);

                    Swal.fire({
                        title: 'Delete Ticket?',
                        text: "This action cannot be undone.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Delete'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    _method: 'DELETE',
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function (response) {
                                    if (response.status === 'success') {
                                        Swal.fire('Deleted!', response.message, 'success');
                                        fetchAssignTickets();
                                    } else {
                                        Swal.fire('Error!', response.message, 'error');
                                    }
                                },
                                error: function () {
                                    Swal.fire('Error!', 'Failed to delete the ticket.', 'error');
                                }
                            });
                        }
                    });
                });
            });
        </script>

    @endsection
@endsection
