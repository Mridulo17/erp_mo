@extends('supper_admin.layouts.app')
@section('title', config('app.name') . ' - Manage Sponsor')

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
                <h3 class="box-title">Manage Sponsor</h3>
                <h6 class="box-subtitle">This is all Manage Sponsor List</h6>
            </div>
            <button type="button" class="btn btn-warning addBlogButton" data-toggle="modal" data-target="#modal-center">
                <i class="fa-solid fa-plus"></i> Add Data
            </button>
        </div>

        @include('supper_admin.components.sponsor.sponsor_modal')

        <div class="box-body">
            <div class="table-responsive">
                <table id="customDataTable" style="table-layout: fixed; width: 100%;"
                       class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                    <thead>
                    <tr>
                        <th style="">Action</th>
                        <th style="">DB:ID</th>
                        <th style="">Employee</th>
                        <th style="">Department</th>
                        <th style="">Month</th>
                        <th style="">Impression</th>
                        <th style="">Type</th>
                        <th style="">Amount</th>
                        <th style="">Entry Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sponsors as $key =>$bonus)
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i> Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Edit Button inside Dropdown -->
                                        <a href="#" class="dropdown-item editBlogButton" data-toggle="modal" data-target="#modal-center" data-id="{{ $serivice->id }}">
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
                            <td class="wrap-text">{{$bonus->employee ? $bonus->employee->first_name : '' }} {{$bonus->employee ? $bonus->employee->last_name : '' }}</td>
                            <td class="wrap-text">{{$bonus->department ? $bonus->department->name : '' }}</td>
                            <td class="wrap-text">{{ $bonus->month  }}</td>
                            <td class="wrap-text">{{ $bonus->impression_type  }}</td>
                            <td class="wrap-text">{{ $bonus->amount_type  }}</td>
                            <td class="wrap-text">{{ $bonus->amount  }}</td>
                            <td class="wrap-text">{{ $bonus->created_at->format('F d, Y') }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @section('script')
        <script>
            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('preview');
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function fetchSponsors() {
                $.ajax({
                    url: '{{ route("supper_admin.sponsors.index") }}',
                    type: 'GET',
                    success: function (data) {
                        let newBody = $(data).find('table tbody').html();
                        $('#customDataTable tbody').html(newBody);
                    },
                    error: function () {
                        console.error('Failed to refresh expense table.');
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

                fetchAgents();

                function fetchAgents() {
                    $.ajax({
                        url: "{{ route('admin.agent.active') }}",
                        method: "GET",
                        success: function (data) {
                            let select = $('#agentSelect');
                            select.empty();
                            select.append('<option value="" disabled selected>Choose Agent</option>');

                            data.forEach(function (agent) {
                                select.append(
                                    '<option value="' + agent.id + '">' +
                                    agent.first_name + ' - ' + agent.last_name +
                                '</option>'
                                );
                            });
                        },
                        error: function (xhr) {
                            console.error("Failed to fetch agents:", xhr);
                        }
                    });
                }

                fetchDelegates();

                function fetchDelegates() {
                    $.ajax({
                        url: "{{ route('admin.delegate.active') }}",
                        method: "GET",
                        success: function (data) {
                            let select = $('#delegateSelect');
                            select.empty();
                            select.append('<option value="" disabled selected>Choose Delegate</option>');

                            data.forEach(function (delegate) {
                                select.append(
                                    '<option value="' + delegate.id + '">' +
                                    delegate.first_name + ' - ' + delegate.last_name +
                                    '</option>'
                                );
                            });
                        },
                        error: function (xhr) {
                            console.error("Failed to fetch delegates:", xhr);
                        }
                    });
                }

                // Fetch Countries based on Continent
                function fetchDelegateOffices(delegateId, selectDelegateOfficeId) {
                    $.ajax({
                        url: "{{ route('admin.delegate-office.active') }}",
                        method: "GET",
                        data: {delegate_id: delegateId}, // Pass delegate_id to filter delegate offices
                        success: function (data) {
                            let select = $('#delegateOfficeSelect');
                            select.empty();
                            select.append('<option value="" disabled selected>Delegate Office</option>');
                            data.forEach(function (office) {
                                let selected = office.id === selectDelegateOfficeId ? 'selected' : '';
                                select.append('<option value="' + office.id + '" ' + selected + '>' +
                                    office.office_name +
                                    '</option>');
                            });

                            // Ensure the item dropdown value is updated after population
                            select.val(selectDelegateOfficeId).trigger('change');  // Set selected delegate office
                        },
                        error: function (xhr) {
                            console.error("Failed to fetch delegate offices:", xhr);
                        }
                    });
                }

                // Trigger the fetchDelegateOffices function when a delegate is selected
                $('#delegateSelect').on('change', function () {
                    const delegateId = $(this).val();
                    if (delegateId) {
                        fetchDelegateOffices(delegateId);  // Fetch delegate office based on the selected delegate
                    } else {
                        $('#delegateOfficeSelect').empty().append('<option value="" disabled selected>Delegate Office</option>');
                    }
                });

                $('#sponsor_type').on('change', function () {
                    const selectedText = $(this).find('option:selected').text();

                    if (selectedText === 'Agent') {
                        $('#agentDiv').show();
                        $('#delegateDiv').hide();
                        $('#delegateOfficeDiv').hide();
                    } else if (selectedText === 'Delegate') {
                        $('#delegateDiv').show();
                        $('#delegateOfficeDiv').show();
                        $('#agentDiv').hide();
                    } else {
                        $('#agentDiv').hide();
                        $('#delegateDiv').hide();
                        $('#delegateOfficeDiv').hide();
                    }
                });

                $('#sponsorForm').on('submit', function (e) {
                    e.preventDefault();
                    let isEdit = $('#sponsor_id').val() !== '';
                    let formData = new FormData(this);
                    let id = $('#sponsor_id').val();
                    formData.set('status', $('#status').is(':checked') ? 'Enabled' : 'Disabled');
                    const baseUpdateUrl = "{{ url('supper_admin/sponsors') }}";

                    let url = isEdit
                        ? `${baseUpdateUrl}/${id}`
                        : `{{ route('supper_admin.sponsors.store') }}`;

                    let method = isEdit ? 'POST' : 'POST';
                    if (isEdit) {
                        formData.append('_method', 'PUT');
                    }

                    Swal.fire({
                        title: isEdit ? "Update Sponsor?" : "Add Sponsor?",
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
                                        $('#sponsorForm')[0].reset();
                                        $('#sponsor_id').val('');
                                        fetchSponsors();
                                    } else {
                                        Swal.fire('Error!', response.message, 'error');
                                    }
                                },
                                error: function () {
                                    Swal.fire('Error!', 'Failed to save sponsor.', 'error');
                                }
                            });
                        }
                    });
                });

                $(document).on('click', '.addBlogButton', function () {
                    $('#sponsorForm')[0].reset();
                    $('#sponsor_id').val('');
                    $('#sponsor_type').val('').trigger('change');
                    $('#agentSelect').val('').trigger('change');
                    $('#delegateSelect').val('').trigger('change');
                    $('#delegateOfficeSelect').empty().append('<option value="" disabled selected>Delegate Office</option>');
                    $('#preview').attr('src', '').hide();
                    $('#modalTitle').text('Manage Sponsor');
                    $('#modal-center').modal('show');

                });

                const storageBaseUrl = "{{ asset('storage') }}/";
                $(document).on('click', '.editBlogButton', function () {
                    const id = $(this).data('id');
                    const url = '{{ route("supper_admin.sponsors.edit", ":id") }}'.replace(':id', id);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (res) {
                            $('#sponsor_id').val(id);
                            $('#sponsor_type').val(res.sponsor_type).trigger('change');
                            $('#sponsor_name').val(res.sponsor_name);
                            $('#cell_number').val(res.cell_number);
                            $('#email').val(res.email);
                            $('#nid').val(res.nid);
                            if (res.sponsor_photo) {
                                $('#preview').attr('src', storageBaseUrl + res.sponsor_photo);
                                $('#preview').show();
                            } else {
                                console.log('No image path found');  // Log if no image is found
                                $('#preview').attr('src', '');
                                $('#preview').hide();
                            }
                            $('#status').prop('checked', res.status === 'Enabled');
                            $('#modalTitle').text('Edit Sponsor');
                            $('#modal-center').modal('show');
                            $('#agentSelect').val(res.agent_id).trigger('change');
                            $('#delegateSelect').val(res.delegate_id).trigger('change');
                            $('#delegateOfficeSelect').val(res.delegate_office_id).trigger('change');
                            fetchDelegateOffices(res.delegate_id, res.delegate_office_id);
                        },
                        error: function () {
                            Swal.fire('Error', 'Could not load sponsor data.', 'error');
                        }
                    });
                });

                $(document).on('click', '.deleteBonusBtn', function () {
                    const id = $(this).data('id');
                    const url = '{{ route("supper_admin.sponsors.destroy", ":id") }}'.replace(':id', id);

                    Swal.fire({
                        title: 'Delete Sponsor?',
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
                                        fetchSponsors();
                                    } else {
                                        Swal.fire('Error!', response.message, 'error');
                                    }
                                },
                                error: function () {
                                    Swal.fire('Error!', 'Failed to delete the sponsor.', 'error');
                                }
                            });
                        }
                    });
                });
            });
        </script>

    @endsection
@endsection
