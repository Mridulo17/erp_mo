@extends('backend.layouts.app')
@section('title', config('app.name') . ' - Investors')
@section('content')
<div class="box">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
        <div>
            <h3 class="box-title">Investor Management</h3>
            <h6 class="box-subtitle">This is the complete Investor List</h6>
        </div>
        <button type="button" class="btn btn-warning" id="addInvestorBtn" data-toggle="modal" data-target="#investorModal">
            <i class="fa fa-plus"></i> Add Investor
        </button>
    </div>
    @include('backend.components.people.investor_modal')
    <div class="box-body">
        <div class="table-responsive">
            <table id="investorDataTable" style="table-layout: fixed; width: 100%;" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                <thead>
                    <tr>
                        <th width="50px">Action</th>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Cell No</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($investors as $key => $investor)
                    <tr>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bars"></i> Action
                                </button>
                                <div class="dropdown-menu">
                                    <button type="button" class="dropdown-item editInvestorBtn" data-id="{{ $investor->id }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <button type="button" class="dropdown-item text-danger deleteInvestorBtn" data-id="{{ $investor->id }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $investor->name }}</td>
                        <td>{{ $investor->cell_no }}</td>
                        <td>{{ $investor->email }}</td>
                        <td>{!! $investor->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' !!}</td>
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
<script src="{{ asset('backend/assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
    if ($.fn.DataTable.isDataTable('#investorDataTable')) {
        $('#investorDataTable').DataTable().clear().destroy();
    }
    $('#investorDataTable').DataTable({
        responsive: true,
        autoWidth: false,
        ordering: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        columnDefs: [
            { orderable: false, targets: 0 },
        ]
    });
    // Add Investor
    $('#addInvestorBtn').on('click', function() {
        $('#investorForm')[0].reset();
        $('#investor_id').val('');
        $('#investorModalTitle').text('Add Investor');
        $('#investorModalSubmitText').text('Save');
        $('#investorModal').modal('show');
    });
    // Edit Investor
    $(document).on('click', '.editInvestorBtn', function() {
        let id = $(this).data('id');
        $.get(`/admin/investors/${id}`, function(res) {
            $('#investor_id').val(res.id);
            $('#name').val(res.name);
            $('#cell_no').val(res.cell_no);
            $('#email').val(res.email);
            $('#password').val('');
            $('#current_address').val(res.current_address);
            $('#permanent_address').val(res.permanent_address);
            $('#note').val(res.note);
            $('#status').prop('checked', res.status == 1);
            // TODO: Populate selects and file previews if needed
            $('#investorModalTitle').text('Edit Investor');
            $('#investorModalSubmitText').text('Update');
            $('#investorModal').modal('show');
        });
    });
    // Save (Add/Edit) Investor
    $('#investorForm').on('submit', function(e) {
        e.preventDefault();
        let id = $('#investor_id').val();
        let isEdit = id && id !== '';
        let url = isEdit ? `/admin/investors/${id}` : `/admin/investors`;
        let method = isEdit ? 'POST' : 'POST';
        let formData = new FormData(this);
        if (isEdit) {
            formData.append('_method', 'PUT');
        }
        Swal.fire({
            title: isEdit ? 'Update Investor?' : 'Add Investor?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, proceed'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 'success' || response.message) {
                            $('#investorModal').modal('hide');
                            Swal.fire('Success!', response.message || 'Saved successfully.', 'success');
                            $('#investorForm')[0].reset();
                            $('#investor_id').val('');
                            location.reload();
                        } else {
                            Swal.fire('Error!', response.message || 'Failed to save.', 'error');
                        }
                    },
                    error: function(xhr) {
                        let message = 'Failed to save investor.';
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
    // Delete Investor
    $(document).on('click', '.deleteInvestorBtn', function() {
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
                    url: `/admin/investors/${id}`,
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