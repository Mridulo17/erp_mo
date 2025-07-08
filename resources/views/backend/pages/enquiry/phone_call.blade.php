@extends('backend.layouts.app')
@section('title', config('app.name') . ' - Phone Calls')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .wrap-text {
            white-space: normal !important;
            word-wrap: break-word !important;
            word-break: break-word !important;
        }

        .select2-container .select2-selection--single {
            height: 38px;
            padding: 6px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            right: 10px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px;
            padding-left: 0px;
            padding-top: 3px;
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
        <div class="box-header with-border d-flex justify-content-between align-items-center">
            <div>
                <h3 class="box-title">Phone Calls Information</h3>
                <h6 class="box-subtitle">This is the complete Phone Call List</h6>
            </div>
            <div>
                <button type="button" class="btn btn-warning" id="addPhoneCallBtn" data-toggle="modal"
                    data-target="#phoneCallModal">
                    <i class="fa fa-plus"></i> Add Phone Call
                </button>
                <button type="button" class="btn btn-success">
                    Employee Phone Call Feedback Report
                </button>
            </div>
        </div>

        @include('backend.components.enquiry.phone_call_modal', [
            'countries' => $countries ?? [],
            'candidateTypes' => $candidateTypes ?? [],
        ])

        <div class="box-body">
            <div class="table-responsive">
                <table id="customDataTable" style="table-layout: fixed; width: 100%;"
                    class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                    <thead>
                        <tr>
                            <th width="50px">Action</th>
                            <th>Serial</th>
                            <th>Phone</th>
                            <th>Full Name</th>
                            <th>Country</th>
                            <th>Category</th>
                            <th>Followup Date</th>
                            <th>Find Us</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($phoneCalls as $key => $call)
                            <tr>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i> Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item " data-id="{{ $call->id }}">
                                                <i class="fa fa-plus"></i> Add Follow Up
                                            </button>
                                            <button type="button" class="dropdown-item editPhoneCallBtn"
                                                data-id="{{ $call->id }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            <button type="button" class="dropdown-item text-danger deletePhoneCallBtn"
                                                data-id="{{ $call->id }}">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $call->phone }}</td>
                                <td class="wrap-text">{{ $call->full_name }}</td>
                                <td>{{ $call->country->name ?? '' }}</td>
                                <td>{{ $call->candidateType->name ?? '' }}</td>
                                <td>{{ $call->followup_date }}</td>
                                <td class="wrap-text">{{ $call->how_find_us }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function fetchPhoneCalls() {
            $.ajax({
                url: '{{ route('admin.phone-calls.index') }}',
                type: 'GET',
                success: function(data) {
                    let newBody = $(data).find('table tbody').html();
                    $('#customDataTable tbody').html(newBody);
                },
                error: function() {
                    console.error('Failed to refresh phone call table.');
                }
            });
        }

        $(document).on('click', '.deletePhoneCallBtn', function() {
            const id = $(this).data('id');
            const url = '{{ route('admin.phone-calls.destroy', ':id') }}'.replace(':id', id);

            Swal.fire({
                title: 'Delete Phone Call?',
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
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(res) {
                            if (res.status === 'success') {
                                Swal.fire('Deleted!', res.message, 'success');
                                fetchPhoneCalls();
                            } else {
                                Swal.fire('Error!', res.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Failed to delete.', 'error');
                        }
                    });
                }
            });
        });

        // --- Phone Call Modal Add/Edit Logic ---
        $(document).on('click', '#addPhoneCallBtn', function() {
            // Reset form for add
            $('#phoneCallForm')[0].reset();
            $('#phone_call_id').val('');
            $('#phoneCallModalTitle').text('Add Phone Call');
            $('#phoneCallModalSubmitText').text('Save');
            $('#phoneCallModal').modal('show');
        });

        $(document).on('click', '.editPhoneCallBtn', function() {
            const id = $(this).data('id');
            const url = '{{ route('admin.phone-calls.show', ':id') }}'.replace(':id', id);
            // Reset form
            $('#phoneCallForm')[0].reset();
            $('#phone_call_id').val(id);
            $('#phoneCallModalTitle').text('Edit Phone Call');
            $('#phoneCallModalSubmitText').text('Update');
            // Fetch data and populate
            $.get(url, function(res) {
                $('#phone').val(res.phone ?? '');
                $('#email').val(res.email ?? '');
                $('#full_name').val(res.full_name ?? '');
                $('#country_id').val(res.country_id ?? '').trigger('change');
                $('#candidate_type_id').val(res.candidate_type_id ?? '').trigger('change');
                $('#note').val(res.note ?? '');
                $('#followup_date').val(res.followup_date ?? '');
                $('#how_find_us').val(res.how_find_us ?? '').trigger('change');
                $('#phoneCallModal').modal('show');
            });
        });

        $('#phoneCallForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#phone_call_id').val();
            let isEdit = id && id !== '';
            let url = isEdit ?
                '{{ route('admin.phone-calls.update', ':id') }}'.replace(':id', id) :
                '{{ route('admin.phone-calls.store') }}';
            let method = isEdit ? 'POST' : 'POST';
            let formData = $(this).serializeArray();
            if (isEdit) {
                formData.push({
                    name: '_method',
                    value: 'PUT'
                });
            }
            Swal.fire({
                title: isEdit ? 'Update Phone Call?' : 'Add Phone Call?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, proceed'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: method,
                        data: formData,
                        success: function(response) {
                            // For redirect-based response, show success and reload
                            if (response.status === 'success' || response.message) {
                                $('#phoneCallModal').modal('hide');
                                Swal.fire('Success!', response.message || 'Saved successfully.',
                                    'success');
                                $('#phoneCallForm')[0].reset();
                                $('#phone_call_id').val('');
                                fetchPhoneCalls();
                            } else {
                                Swal.fire('Error!', response.message || 'Failed to save.',
                                    'error');
                            }
                        },
                        error: function(xhr) {
                            let message = 'Failed to save phone call.';
                            if (xhr.responseJSON?.errors) {
                                const errors = xhr.responseJSON.errors;
                                message = Object.values(errors).flat().join('<br>');
                            } else if (xhr.responseJSON?.message) {
                                message = xhr.responseJSON.message;
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: message
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
