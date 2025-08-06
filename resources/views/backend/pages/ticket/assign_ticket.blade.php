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
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i> Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Edit Button inside Dropdown -->
                                        <a href="#" class="dropdown-item editBlogButton" data-toggle="modal" data-target="#view_ticket" data-id="{{ $bonus->id }}">
                                            <i class="fa fa-ticket"></i>  View ticket
                                        </a>

                                        <!-- Delete Form inside Dropdown -->
                                        <button type="button"
                                                class="dropdown-item text-danger deleteBonusBtn"
                                                data-id="{{ $bonus->id }}">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </td>

                            <td>{{ $key + 1 }}</td>
                            <td class="wrap-text">{{ $bonus->issue_date  }}</td>
                            <td class="wrap-text">{{ $bonus->ticket_name  }}</td>
                            <td class="wrap-text">{{ $bonus->source  }}</td>
                            <td class="wrap-text">{{ $bonus->country ? $bonus->country->name : '' }}</td>
                            <td class="wrap-text">{{ $bonus->ticket_type  }}</td>
                            <td class="wrap-text">{{ $bonus->total_candidate  }}</td>
                            <td><b style="font-size: 14px;">{{ $bonus->pnr_number  }}</b> <br> <b style="font-size: 14px;" class="text-primary">{{ $bonus->flight_number  }}</b></td>
                            <td class="wrap-text">{{ $bonus->flight_date  }} {{ \Carbon\Carbon::parse($bonus->flight_time)->format('h:i A') }} </td>
                            <td>
                            <span class="badge {{ $bonus->is_assigned == '1' ? 'badge-success' : 'badge-danger' }}">
                                {{ $bonus->is_assigned == '1' ? 'Assigned' : 'Not Yet!' }}
                            </span>
                            </td>
                            <td>
                            <span class="badge {{ $bonus->is_pre_purchase == '1' ? 'badge-primary' : 'badge-success' }}">
                                {{ $bonus->is_pre_purchase == '1' ? 'Pre Purchase' : 'Live Purchase!' }}
                            </span>
                            </td>
                            <td class="wrap-text">{{ $bonus->purchase_amount  }}</td>
                            <td class="wrap-text">{{ $bonus->purchase_payment_type == 'Paid' ? '0.00' : $bonus->purchase_amount  }}</td>
                            <td>
                            <span class="badge {{ $bonus->purchase_payment_type == 'Paid' ? 'badge-success' : 'badge-danger' }}">
                                {{ $bonus->purchase_payment_type == 'Paid' ? 'Paid' : 'Due' }}
                            </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            function fetchTickets() {
                $.ajax({
                    url: '{{ route("admin.tickets.index") }}',
                    type: 'GET',
                    success: function (data) {
                        let newBody = $(data).find('#customDataTable tbody').html();
                        $('#customDataTable tbody').html(newBody);
                    },
                    error: function () {
                        console.error('Failed to refresh sponsor table.');
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
                    if(ticket_type === "System Ticket - Multi person" || ticket_type === "Group Ticket - Multi person") {
                        $('#complete_assign_div').show();
                    } else {
                        $('#complete_assign_div').hide();
                    }
                    const candidate_type_id = selectedOption.data('candidate_type_id');
                    if (candidate_type_id) {
                        fetchCandidates(candidate_type_id);  // Fetch candidate based on the selected type
                    }
                });

                fetchcountriess();
                function fetchcountriess() {
                    $.ajax({
                        url: "{{ route('supper_admin.country.active') }}",
                        method: "GET",
                        success: function(data) {
                            let select = $('#countrySelect');
                            select.empty();
                            select.append('<option value="" disabled selected>Country</option>');
                            data.forEach(function(State) {
                                select.append('<option value="' + State.id + '">' + State.name + '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.error("Failed to fetch countries:", xhr);
                        }
                    });
                }

                fetchAirlineOffices();

                function fetchAirlineOffices() {
                    $.ajax({
                        url: "{{ route('admin.airline-office.active') }}",
                        method: "GET",
                        success: function (data) {
                            let select = $('#selectOffice');
                            select.empty();
                            select.append('<option value="" disabled selected>Airlines Office</option>');
                            data.forEach(function (office) {
                                select.append(
                                    '<option value="' + office.id + '">' +
                                    office.name + '</option>'
                                );
                            });

                        },
                        error: function (xhr) {
                            console.error("Failed to fetch currencies:", xhr);
                        }
                    });
                }

                fetchOtherOffices();

                function fetchOtherOffices() {
                    $.ajax({
                        url: "{{ route('admin.other-office.active') }}",
                        method: "GET",
                        success: function (data) {
                            let select = $('#selectOtherOffice');
                            select.empty();
                            select.append('<option value="" disabled selected>Other Office</option>');

                            data.forEach(function (office) {
                                select.append(
                                    '<option value="' + office.id + '">' +
                                    office.name +
                                    '</option>'
                                );
                            });
                        },
                        error: function (xhr) {
                            console.error("Failed to fetch candidate types:", xhr);
                        }
                    });
                }

                $('#source').on('change', function () {
                    const selectedText = $(this).find('option:selected').text();

                    if (selectedText === 'Local Office' || selectedText === 'Budget Carrier') {
                        $('#other-office-div').show();
                    } else if (selectedText === 'IATA' || selectedText === 'Budget Carrier') {
                        $('#payment_vat_tax_container').show();
                    } else {
                        $('#other-office-div').hide();
                        $('#payment_vat_tax_container').hide();
                    }
                });
                $('#ticket_type').on('change', function () {
                    const selectedText = $(this).find('option:selected').text();

                    if (selectedText === 'System Ticket - Single person') {
                        $('#refund_button_container').show();
                    }
                    else if (selectedText === 'System Ticket - Multi person') {
                        $('#refund_button_container').show();
                    }
                    else {
                        $('#refund_button_container').hide();
                    }
                });

                $('#purchase_payment_type').on('change', function () {
                    const selectedText = $(this).find('option:selected').text();

                    if (selectedText === 'Paid') {
                        $('#purchase_div').show();
                    } else {
                        $('#purchase_div').hide();
                    }
                });

                function handlePaymentOption() {
                    if ($('#current_payment').is(':checked')) {
                        $('#partial_amount_div').hide();
                        $('#ticket_payment_method_container').show();
                        $('#agent_commission_div').show();
                    } else if ($('#partial_payment').is(':checked')) {
                        $('#partial_amount_div').show();
                        $('#ticket_payment_method_container').show();
                        $('#agent_commission_div').show();
                    } else if ($('#payment_by_agent').is(':checked')) {
                        $('#partial_amount_div').hide();
                        $('#ticket_payment_method_container').hide();
                        $('#agent_commission_div').show();
                    } else if ($('#due_payment').is(':checked')) {
                        $('#partial_amount_div').hide();
                        $('#ticket_payment_method_container').hide();
                        $('#agent_commission_div').show();
                    } else {
                        $('#partial_amount_div').hide();
                        $('#ticket_payment_method_container').hide();
                        $('#agent_commission_div').hide();
                    }
                }

                // When checkbox is toggled
                $('#make_flight_complete').on('change', function () {
                    if ($(this).is(':checked')) {
                        $('#flight-radio').slideDown(); // smoother than show()

                        // Run handler on load
                        handlePaymentOption();

                        // Attach radio change only once to avoid duplicates
                        $('input[name="payment_type"]').off('change').on('change', function () {
                            handlePaymentOption();
                        });
                    } else {
                        $('#flight-radio').slideUp();
                        $('#partial_amount_div').hide();
                        $('#ticket_payment_method_container').hide();
                        $('#agent_commission_div').hide();
                    }
                });

                $('#is_pre_purchase').on('change', function () {
                    if ($(this).is(':checked')) {
                        $('#single-div').hide();
                        $('#candidate-qty-div').show();
                    } else {
                        $('#single-div').show();
                        $('#candidate-qty-div').hide();
                    }
                });

                $('#total_candidate').on('input', function () {
                    const candidate =  $(this).val();
                    $('#show_total_candidate').text("(" +candidate+ ")");

                });
                $('#sell_amount_total').on('input', function () {
                    const totalSell =  $(this).val();
                    const candidate =  $('#total_candidate').val();
                    const perTicket = totalSell/candidate;
                    $('#per_ticket_amount').val(perTicket);

                });

                $('#selectCandidate').on('change', function () {
                    const selectedCount = $(this).find('option:selected').length;
                    $('#total_candidate').val(selectedCount);
                    $('#show_total_candidate').text("(" + selectedCount + ")");
                });

                $('#ticketForm').on('submit', function (e) {
                    e.preventDefault();
                    let isEdit = $('#ticket_id').val() !== '';
                    let formData = new FormData(this);
                    let id = $('#ticket_id').val();
                    formData.set('is_pre_purchase', $('#is_pre_purchase').is(':checked') ? '1' : '0');
                    formData.set('is_refundable', $('#is_refundable').is(':checked') ? '1' : '0');
                    formData.set('is_make_flight_complete', $('#make_flight_complete').is(':checked') ? '1' : '0');
                    const baseUpdateUrl = "{{ url('admin/tickets') }}";
                    let url = isEdit
                        ? `${baseUpdateUrl}/${id}`
                        : `{{ route('admin.tickets.store') }}`;

                    let method = isEdit ? 'POST' : 'POST';
                    if (isEdit) {
                        formData.append('_method', 'PUT');
                    }

                    Swal.fire({
                        title: isEdit ? "Update Ticket?" : "Add Ticket?",
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
                                        fetchTickets();
                                    } else {
                                        Swal.fire('Error!', response.message, 'error');
                                    }
                                },
                                error: function () {
                                    Swal.fire('Error!', 'Failed to save ticket.', 'error');
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
                    $('#selectCandidate').val('').trigger('change');
                    $('#multiSelectCandidate').val('').trigger('change');
                    $('#modalTitle').text('Assign Ticket');
                    $('#modal-center').modal('show');

                });

                $(document).on('click', '.editBlogButton', function () {
                    const id = $(this).data('id');
                    const url = '{{ route("admin.tickets.edit", ":id") }}'.replace(':id', id);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (res) {
                            $('#ticket_id').val(id);
                            $('#sponsorSelect').val(res.sponsor_id).trigger('change');
                            $('#jobSelect').val(res.job_list_id).trigger('change');
                            $('#countrySelect').val(res.country_id).trigger('change');
                            $('#currencySelect').val(res.currency_id).trigger('change');
                            $('#view_ticket_name').text(res.pnr_number + '-' + res.ticket_name);
                            $('#user_name').text(res.user.name);
                            const date = new Date(res.created_at);
                            const formattedDate = date.toISOString().split('T')[0]; // YYYY-MM-DD

                            const formattedRegistrationDay = date
                                    .toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })
                                    .replace(/(\d+)(?=,)/, (_, d) => d + (["th","st","nd","rd"][(d%10>3||Math.floor(d%100/10)==1)?0:d%10]) + ' of')
                                + ` (${formattedDate})`;
                            $('#ticket_date').text(formattedRegistrationDay);

                            $('#title').text(res.ticket_name);
                            $('#view_source').text(res.source);
                            $('#view_ticket_type').text(res.ticket_type);
                            $('#view_country').text(res.country.name);
                            $('#view_office').text(res.airline_office.name);
                            $('#view_qty').text(res.total_candidate);
                            $('#view_pnr').text(res.pnr_number);
                            $('#view_flight_date').text(res.flight_date);

                            // Show existing file
                            if (res.attachment) {
                                const filePath = res.attachment;
                                const ext = filePath.split('.').pop().toLowerCase();
                                const fileUrl = `/storage/${filePath}`;

                                let previewHtml = '';

                                previewHtml = `<a href="${fileUrl}" title="click to view file" target="_blank" class="mr-5"><i class="fa fa-file"></i></a>`;

                                $('#existing-file-preview').html(previewHtml);
                            }

                            const time = res.flight_time;
                            const dateTime = '1970-01-01T' + time; // ISO 8601 format

                            const formattedTime = new Date(dateTime).toLocaleTimeString('en-US', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });

                            $('#view_flight_time').text(formattedTime);
                            $('#modalTitle').text('View Ticket');
                            $('#view_ticket').modal('show');
                        },
                        error: function () {
                            Swal.fire('Error', 'Could not load ticket data.', 'error');
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
                                        fetchTickets();
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
