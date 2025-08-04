@extends('backend.layouts.app')
@section('title', config('app.name') . ' - Buy Ticket')

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
                <h3 class="box-title">Buy Ticket</h3>
                <h6 class="box-subtitle">This is all Buy Ticket List</h6>
            </div>
            <button type="button" class="btn btn-warning addBlogButton" data-toggle="modal" data-target="#modal-center">
                <i class="fa-solid fa-plus"></i> Add Data
            </button>
        </div>

        @include('backend.components.ticket.ticket_modal')

        <div class="box-body">
            <div class="table-responsive">
                <table id="customDataTable" style="table-layout: fixed; width: 100%;"
                       class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                    <thead>
                    <tr>
                        <th style="">Action</th>
                        <th style="">DB:ID</th>
                        <th style="">Issue Date</th>
                        <th style="">Name</th>
                        <th style="">Source</th>
                        <th style="">Country</th>
                        <th style="">Ticket Type</th>
                        <th title="Candidate Number" style="">C:N</th>
                        <th title="Passenger Name Record/Flight Number" style="">PNR/FN</th>
                        <th style="">Flight Date and Time</th>
                        <th style="">Assign</th>
                        <th style="">Purchase Type</th>
                        <th style="">Paid</th>
                        <th style="">Due</th>
                        <th style="">Payment</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($visas as $key =>$bonus)
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i> Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Edit Button inside Dropdown -->
                                        <a href="#" class="dropdown-item editBlogButton" data-toggle="modal" data-target="#modal-center" data-id="{{ $bonus->id }}">
                                            <i class="fa fa-edit"></i> Edit
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
                            <td class="wrap-text">{{ $bonus->sponsor ? $bonus->sponsor->sponsor_name : '' }}</td>
                            <td class="wrap-text">{{ $bonus->sponsor_type  }}</td>
                        @if(isset($bonus->sponsor) && $bonus->sponsor->sponsor_type == 'Prime Sponsor')
                                <td class="wrap-text">{{$bonus->sponsor ? $bonus->sponsor->sponsor_type : '' }} | {{$bonus->sponsor ? $bonus->sponsor->sponsor_name : ''}}</td>
                            @elseif(isset($bonus->sponsor) && $bonus->sponsor->sponsor_type == 'Delegate')
                                <td class="wrap-text">{{$bonus->sponsor ? $bonus->sponsor->sponsor_type : '' }} | {{$bonus->sponsor->delegate ? $bonus->sponsor->delegate->first_name : '' }} {{$bonus->sponsor->delegate ? $bonus->sponsor->delegate->last_name : '' }}</td>
                            @endif
                            <td class="wrap-text">{{ $bonus->country ? $bonus->country->name : '' }}</td>
                            <td class="wrap-text">{{ $bonus->jobList ? $bonus->jobList->name : '' }}</td>
                            <td class="wrap-text">{{ $bonus->gender  }}</td>
                            <td class="wrap-text">{{ $bonus->age_from  }} - {{ $bonus->age_to  }}</td>
                            <td>0.00</td>
                            <td>{{ $bonus->visa_qty  }}</td>
                            <td class="wrap-text">{{ $bonus->currency ? $bonus->currency->name : '' }}</td>
                            <td class="wrap-text">{{ $bonus->purchase_amount  }}</td>
                            <td class="wrap-text">0.00</td>
                            <td>
                            <span class="badge {{ $bonus->payment_type == 'Paid' ? 'badge-success' : 'badge-danger' }}">
                                {{ $bonus->payment_type == 'Paid' ? 'Paid' : 'Due' }}
                            </span>
                            </td>
                            <td>
                            <span class="badge {{ $bonus->status == 'Enabled' ? 'badge-success' : 'badge-danger' }}">
                                {{ $bonus->status == 'Enabled' ? 'Enabled' : 'Disabled' }}
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
                    url: '{{ route("supper_admin.visas.index") }}',
                    type: 'GET',
                    success: function (data) {
                        let newBody = $(data).find('table tbody').html();
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

                fetchCandidateTypes();

                function fetchCandidateTypes() {
                    $.ajax({
                        url: "{{ route('admin.candidate-type.active') }}",
                        method: "GET",
                        success: function (data) {
                            let select = $('#candidateType');
                            select.empty();
                            select.append('<option value="" disabled selected>Candidate Type</option>');

                            data.forEach(function (candidate) {
                                select.append(
                                    '<option data-name="' + candidate.name + '" value="' + candidate.id + '">' +
                                    candidate.name +
                                '</option>'
                                );
                            });
                        },
                        error: function (xhr) {
                            console.error("Failed to fetch candidate types:", xhr);
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
                            let select = $('#selectCandidate');
                            select.empty();
                            select.append('<option value="" disabled selected>Choose Candidate</option>');

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

                            let select1 = $('#multiSelectCandidate');
                            select1.empty();

                            data.forEach(function (candidate) {
                                let selected = candidate.id === selectedCandidateId ? 'selected' : '';
                                select1.append(
                                    '<option value="' + candidate.id + '" ' + selected + '>' +
                                    candidate.personal_info.first_name + ' ' +
                                    candidate.personal_info.last_name +
                                    '</option>'
                                );
                            });
                            // Ensure the item dropdown value is updated after population
                            select1.val(selectedCandidateId).trigger('change');  // Set selected candidate
                        },
                        error: function (xhr) {
                            console.error("Failed to fetch candidates:", xhr);
                        }
                    });
                }

                // Trigger the fetchEmployees function when a category is selected
                $('#candidateType').on('change', function () {
                    const selectedOption = $(this).find('option:selected');
                    const name = selectedOption.data('name');
                    if(name && name.toLowerCase() === "air ticket") {
                        $('#make_flight').show();
                    } else {
                        $('#make_flight').hide();
                    }
                    const typeId = $(this).val();
                    if (typeId) {
                        fetchCandidates(typeId);  // Fetch candidate based on the selected type
                    } else {
                        $('#selectCandidate').empty().append('<option value="" disabled selected>Choose Candidate</option>');
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
                    const selectElement = document.getElementById('selectCandidate'); // the actual DOM element

                    if (selectedText === 'System Ticket - Single person') {
                        $('#refund_button_container').show();
                        $('#multiple-div').hide();
                        $('#single-div').show();
                    }
                    else if (selectedText === 'System Ticket - Multi person') {
                        $('#refund_button_container').show();
                        $('#multiple-div').show();
                        $('#single-div').hide();
                    }
                    else {
                        $('#refund_button_container').hide();
                        $('#multiple-div').hide();
                        $('#single-div').show();
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

                $('#make_flight_complete').on('change', function () {
                    if ($(this).is(':checked')) {
                        $('#flight-radio').show();

                        if($('#current_payment').is(':checked')) {
                            $('#partial_amount_div').hide();
                            $('#ticket_payment_method_container').show();
                            $('#agent_commission_div').show();

                        } else if($('#partial_payment').is(':checked')) {
                            $('#partial_amount_div').show();
                            $('#ticket_payment_method_container').show();
                            $('#agent_commission_div').show();
                        } else if($('#payment_by_agent').is(':checked')) {
                            $('#partial_amount_div').hide();
                            $('#ticket_payment_method_container').hide();
                            $('#agent_commission_div').show();
                        } else if($('#due_payment').is(':checked')) {
                            $('#partial_amount_div').hide();
                            $('#ticket_payment_method_container').hide();
                            $('#agent_commission_div').show();
                        } else {
                            $('#partial_amount_div').hide();
                            $('#ticket_payment_method_container').hide();
                            $('#agent_commission_div').hide();
                        }
                    } else {
                        $('#flight-radio').hide();
                    }
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
                    $('#modalTitle').text('Buy Ticket');
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
                            $('#issue_date').val(res.issue_date);
                            $('#age_from').val(res.age_from);
                            $('#age_to').val(res.age_to);
                            $('#visa_number').val(res.visa_number);
                            $('#visa_qty').val(res.visa_qty);
                            $('#type').val(res.type);
                            $('#gender').val(res.gender);
                            $('#monthly_salary').val(res.monthly_salary);
                            $('#purchase_amount').val(res.purchase_amount);
                            $('#agent_price').val(res.agent_price);
                            $('#candidate_price').val(res.candidate_price);
                            $('#commission_amount').val(res.commission_amount);
                            $('#payment_type').val(res.payment_type);
                            // Show existing file
                            if (res.demand_latter) {
                                const filePath = res.demand_latter; // example: expense_categories/filename.pdf
                                const ext = filePath.split('.').pop().toLowerCase();

                                // Prepend Laravel's public storage path
                                const fileUrl = `/storage/${filePath}`;

                                let previewHtml = '';

                                if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
                                    previewHtml = `<img src="${fileUrl}" alt="Uploaded File" class="img-thumbnail" style="max-height: 200px;">`;
                                } else {
                                    previewHtml = `<a href="${fileUrl}" target="_blank" class="btn btn-outline-primary btn-sm">View File</a>`;
                                }

                                $('#existing-file-preview1').html(previewHtml);
                                $('#remove-file-section1').removeClass('d-none');
                            } else {
                                $('#existing-file-preview1').empty();
                                $('#remove-file-section1').addClass('d-none');
                                $('#remove_file1').prop('checked', false);
                            }
                            // Show existing file
                            if (res.attachment) {
                                const filePath = res.attachment; // example: expense_categories/filename.pdf
                                const ext = filePath.split('.').pop().toLowerCase();

                                // Prepend Laravel's public storage path
                                const fileUrl = `/storage/${filePath}`;

                                let previewHtml = '';

                                if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
                                    previewHtml = `<img src="${fileUrl}" alt="Uploaded File" class="img-thumbnail" style="max-height: 200px;">`;
                                } else {
                                    previewHtml = `<a href="${fileUrl}" target="_blank" class="btn btn-outline-primary btn-sm">View File</a>`;
                                }

                                $('#existing-file-preview').html(previewHtml);
                                $('#remove-file-section').removeClass('d-none');
                            } else {
                                $('#existing-file-preview').empty();
                                $('#remove-file-section').addClass('d-none');
                                $('#remove_file').prop('checked', false);
                            }
                            $('#provide_food').prop('checked', res.provide_food == '1');
                            $('#provide_accommodation').prop('checked', res.provide_accommodation == '1');
                            $('#status').prop('checked', res.status === 'Enabled');
                            $('#modalTitle').text('Edit Visa');
                            $('#modal-center').modal('show');
                        },
                        error: function () {
                            Swal.fire('Error', 'Could not load visa data.', 'error');
                        }
                    });
                });

                $(document).on('click', '.deleteBonusBtn', function () {
                    const id = $(this).data('id');
                    const url = '{{ route("admin.tickets.destroy", ":id") }}'.replace(':id', id);

                    Swal.fire({
                        title: 'Delete Visa?',
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
                                    Swal.fire('Error!', 'Failed to delete the visa.', 'error');
                                }
                            });
                        }
                    });
                });
            });
        </script>

    @endsection
@endsection
