@extends('backend.layouts.app')
@section('title', config('app.name') . ' - Visitor Book')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 38px;
            padding: 6px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px;
            padding-left: 0px;
            padding-top: 3px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            right: 10px;
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
                <h3 class="box-title">Visitor Book Information</h3>
                <h6 class="box-subtitle">This is the complete Visitor Book List</h6>
            </div>
            <button type="button" class="btn btn-warning" id="addVisitorBookBtn" data-toggle="modal" data-target="#visitorBookModal">
                <i class="fa fa-plus"></i> Add Visitor Book
            </button>
        </div>
        @include('backend.components.enquiry.visitor_book_modal', ['candidateTypes' => $candidateTypes ?? []])
        <div class="box-body">
            <div class="table-responsive">
                <table id="vistorDataTable" style="table-layout: fixed; width: 100%;" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                    <thead>
                        <tr>
                            <th width="50px">Action</th>
                            <th>Serial</th>
                            <th>Phone</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Category</th>
                            <th>Entry Time</th>
                            <th>Find Us</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visitorBooks as $key => $visitor)
                            <tr>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i> Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item editVisitorBookBtn" data-id="{{ $visitor->id }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            <button type="button" class="dropdown-item text-danger deleteVisitorBookBtn" data-id="{{ $visitor->id }}">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $visitor->phone }}</td>
                                <td>{{ $visitor->full_name }}</td>
                                <td>{{ $visitor->address }}</td>
                                <td>{{ $visitor->candidateType->name ?? '' }}</td>
                                <td>{{ $visitor->entry_time }}</td>
                                <td>{{ $visitor->how_find_us }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $visitorBooks->links() }} --}} <!-- Remove pagination for DataTables -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('backend/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            // Destroy DataTable if already initialized
            if ($.fn.DataTable.isDataTable('#vistorDataTable')) {
                $('#vistorDataTable').DataTable().clear().destroy();
            }
            $('#vistorDataTable').DataTable({
                responsive: true,
                autoWidth: false,
                ordering: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                columnDefs: [
                    { orderable: false, targets: 0 },
                ]
            });
            // Add Visitor Book
            $('#addVisitorBookBtn').on('click', function() {
                $('#visitorBookForm')[0].reset();
                $('#visitor_book_id').val('');
                $('#visitorBookModalTitle').text('Add Visitor Book');
                $('#visitorBookModalSubmitText').text('Save');
                $('#visitorBookModal').modal('show');
            });
            // Edit Visitor Book
            $(document).on('click', '.editVisitorBookBtn', function() {
                let id = $(this).data('id');
                $.get(`/admin/enquiry/visitor-books/${id}`, function(res) {
                    $('#visitor_book_id').val(res.id);
                    $('#phone').val(res.phone);
                    $('#full_name').val(res.full_name);
                    $('#address').val(res.address);
                    $('#candidate_type_id').val(res.candidate_type_id).trigger('change');
                    $('#reference_type').val(res.reference_type).trigger('change');
                    $('#note').val(res.note);
                    $('#entry_time').val(res.entry_time);
                    $('#how_find_us').val(res.how_find_us).trigger('change');
                    $('#visitorBookModalTitle').text('Edit Visitor Book');
                    $('#visitorBookModalSubmitText').text('Update');
                    $('#visitorBookModal').modal('show');
                });
            });
            // Save (Add/Edit) Visitor Book
            $('#visitorBookForm').on('submit', function(e) {
                e.preventDefault();
                let id = $('#visitor_book_id').val();
                let isEdit = id && id !== '';
                let url = isEdit ? `/admin/enquiry/visitor-books/${id}` : `/admin/enquiry/visitor-books`;
                let method = isEdit ? 'POST' : 'POST';
                let formData = $(this).serializeArray();
                if (isEdit) {
                    formData.push({ name: '_method', value: 'PUT' });
                }
                Swal.fire({
                    title: isEdit ? 'Update Visitor Book?' : 'Add Visitor Book?',
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
                                if (response.status === 'success' || response.message) {
                                    $('#visitorBookModal').modal('hide');
                                    Swal.fire('Success!', response.message || 'Saved successfully.', 'success');
                                    $('#visitorBookForm')[0].reset();
                                    $('#visitor_book_id').val('');
                                    location.reload();
                                } else {
                                    Swal.fire('Error!', response.message || 'Failed to save.', 'error');
                                }
                            },
                            error: function(xhr) {
                                let message = 'Failed to save visitor book.';
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
            // Delete Visitor Book
            $(document).on('click', '.deleteVisitorBookBtn', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Delete Record?',
                    text: "This cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/enquiry/visitor-books/${id}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(res) {
                                Swal.fire('Deleted!', res.message, 'success').then(() => location.reload());
                            },
                            error: function() {
                                Swal.fire('Error!', 'Could not delete record.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
