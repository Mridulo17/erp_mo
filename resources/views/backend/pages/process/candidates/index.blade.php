@extends('backend.layouts.app')
@section('title', config('app.name') . ' - Candidates')

@section('style')
    <style>
        .dataTables_wrapper .form-control {
            margin: 0 0;
            padding: 5px 5px 5px 5px;
        }
        .table-responsive {
            overflow: visible !important;
        }
        .table-responsive .dropdown-menu {
            position: absolute !important;
            z-index: 1050;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .table-responsive .dropdown-menu .dropdown-item {
            padding: 3px 10px;
            margin: 3px 0;
            text-transform: capitalize;
        }
        .table-responsive .dropdown-menu .dropdown-item:hover {
            background-color: #f5a4a4;
            color: #000;
            border-radius: 4px;
        }
        .profile-image-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
        .profile-image-wrapper .overlay {
            position: absolute;
            top: 0;
            width: 250px;
            height: 250px;
            background: rgba(102, 98, 98, 0.6);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 50%;
            text-align: center;
            font-size: 16px;
            padding: 10px;
        }
        .profile-image-wrapper:hover .overlay {
            opacity: 1;
        }
        .swal2-popup {
            padding: 1.2em 1.2em !important;
            font-size: 0.95rem !important;
            width: 20em !important;
        }
        .swal2-title {
            font-size: 1.1rem !important;
        }
        .swal2-btn {
            font-size: 0.9rem !important;
            padding: 0.3em 1.2em !important;
        }
    </style>
@endsection

@section('content')
<div class="box">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
        <div>
            <h3 class="box-title">Candidates Information</h3>
            <h6 class="box-subtitle">This is all Candidate List</h6>
        </div>
        <a href="{{ route('admin.candidates.create') }}" type="button" class="btn btn-md btn-warning addAgentButton" >
            <i class="fa-solid fa-plus"></i> Add Candidates
        </a>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="candidateDataTable" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                <thead>
                    <tr>
                        <th style="width: 30px;">ID</th>
                        <th>Name</th>
                        <th>Agent</th>
                        <th>Age-Gender</th>
                        <th>NID</th>
                        <th>Passport</th>
                        <th>Validity</th>
                        <th>Interested Country</th>
                        <th>Interested Job</th>
                        <th>Process</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('backend.pages.process.candidates.partials.candidate_profile_modal')
@include('backend.pages.process.candidates.partials.candidate_type_transfer_modal', ['candidateTypes' => $candidateTypes])
@include('backend.pages.process.candidates.partials.candidate_comments_modal')
@endsection

@section('script')
<script type="text/javascript">
    let datatable_columns = [
        { data: 'DT_RowIndex',name:"DT_RowIndex", orderable: false, searchable: false },
        { data: 'name', name: 'name', defaultContent: '' },
        { data: 'agent', name: 'agent', defaultContent: '' },
        { data: 'age_gender', name: 'age_gender', defaultContent: '' },
        { data: 'nid', name: 'personalInfo.nid_or_birth_certificate', defaultContent: '' },
        { data: 'passport', name: 'passport.passport_number', defaultContent: '' },
        { data: 'passport_validity', name: 'passport.passport_expired_date', defaultContent: '' },
        { data: 'interested_country', name: 'interested_country', defaultContent: '' },
        { data: 'interested_profession', name: 'interested_profession', defaultContent: '' },
        { data: 'status', name: 'status', orderable: false, searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]

    let datatable_columns_defs = [
        {'bSortable': true, 'aTargets': [0,1,2,3,4]},
        {'bSearchable': false, 'aTargets': [0]},
        { className: 'text-center', targets: [9,10] },
        { className: 'text-uppercase', targets: [1,2] },
    ]

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    var dtTable = $('#candidateDataTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 25,
        serverMethod: 'get',
        lengthMenu: [10, 25, 50,100],
        order: [ 0, "asc" ],
        language: {
            'loadingRecords': '&nbsp;',
            'processing': 'Loading ...'
        },
        ajax: {
            url: '{{ route('admin.candidates.index') }}',
            type: 'get',
            dataType: 'JSON',
            cache: true,
        },
        columns: datatable_columns,
        search: {
            "regex": true
        },
        columnDefs: datatable_columns_defs,

        dom: "<'row mb-3'<'col-sm-12 text-right'B>>" +   // Buttons top-right
        "<'row mb-2'<'col-sm-6'l><'col-sm-6'f>>" +   // Length left, Search right
        "<'row'<'col-sm-12'tr>>" +                   // Table
        "<'row mt-2'<'col-sm-5'i><'col-sm-7'p>>",    // Info left, Pagination right

        buttons: [
            {
                extend: 'copy',
                className: 'btn btn-md btn-warning'
            },
            {
                extend: 'csv',
                className: 'btn btn-md btn-warning'
            },
            {
                extend: 'excel',
                className: 'btn btn-md btn-warning'
            },
            {
                extend: 'pdf',
                className: 'btn btn-md btn-warning'
            },
            {
                extend: 'print',
                className: 'btn btn-md btn-warning'
            }
        ]

    });
</script>

<script>
    $(document).on('click', '.view-profile-btn', function(e) {
        e.preventDefault();
        const candidateId = $(this).data('id');    

        // Optional: show loading
        $('#modalContent').html('<p>Loading...</p>');

        // Fetch candidate details
        $.ajax({
            url: '/admin/candidates/' + candidateId,
            type: 'GET',
            success: function(response) {
                console.log(response);
                
                $('#modalContent').html(response);
            },
            error: function() {
                $('#modalContent').html('<p class="text-danger">Failed to load candidate profile.</p>');
            }
        });
    });
</script>

<script>
    $(document).on('change', '#candidate_photo_update', function() {
        const [file] = this.files;
        if (file) {
            $('#candidate_photo_preview').attr('src', URL.createObjectURL(file));
        }
        // Automatically upload the image
        var form = $('#candidatePhotoForm')[0];
        var formData = new FormData(form);
        $.ajax({
            url: '/admin/candidates/update-candidate-photo',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.status === 'success') {
                    if(response.photo_url) {
                        $('#candidate_photo_preview').attr('src', response.photo_url);
                    }
                } else {
                    alert('Failed to update photo.');
                }
            },
            error: function(xhr) {
                let msg = 'Error uploading photo.';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    msg = Object.values(xhr.responseJSON.errors).join('\n');
                }
                alert(msg);
            }
        });
    });
</script>

<script>
    // Open modal and set candidate ID
    $(document).on('click', '.candidate-type-transfer-btn', function(e) {
        e.preventDefault();
        var candidateId = $(this).data('id');
        var currentType = $(this).data('current-type') || '';
        $('#transfer_candidate_id').val(candidateId);
        $('#current_candidate_type').val(currentType);
        $('#candidateTypeTransferModal').modal('show');
    });

    // Handle form submit
    $(document).on('submit', '#candidateTypeTransferForm', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/admin/candidates/type-transfer',
            type: 'POST',
            data: formData,
            success: function(response) {
                if(response.status === 'success') {
                    $('#candidateTypeTransferModal').modal('hide');
                    Swal.fire({
                        position: "center",
                        icon: 'success',
                        title: 'Success',
                        text: 'Candidate type transferred!',
                        customClass: {
                            popup: 'swal2-popup',
                            title: 'swal2-title',
                            confirmButton: 'swal2-btn'
                        }
                    });

                    // Reload the page
                    setTimeout(function() {
                        // location.reload();
                        $('#candidate_type_id').val('').trigger('change'); // reset select2 if used
                        dtTable.ajax.reload(null, false); // reload yajra datatable
                    }, 1000);
                } else {
                    Swal.fire({
                        position: "center",
                        icon: 'error',
                        title: 'Failed',
                        text: 'Failed to transfer candidate type.',
                        customClass: {
                            popup: 'swal2-popup',
                            title: 'swal2-title',
                            confirmButton: 'swal2-btn'
                        }
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    position: "center",
                    icon: 'error',
                    title: 'Error',
                    text: (xhr.responseJSON?.message || 'Unknown error'),
                    customClass: {
                        popup: 'swal2-popup',
                        title: 'swal2-title',
                        confirmButton: 'swal2-btn'
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).on('click', '.candidate-comments-btn', function(e) {
        e.preventDefault();
        var candidateId = $(this).data('id');
        $('#comments_candidate_id').val(candidateId);
        $('#new_comment').val('');
        $('#candidateCommentsModal').modal('show');

        $.get(`/admin/candidates/comment/${candidateId}`, function(response) {
            $('#new_comment').val(response.comment || '');
        });
    });

    $(document).on('submit', '#candidateCommentsForm', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: '/admin/candidates/comment',
            type: 'POST',
            data: formData,
            success: function(response) {
                if(response.status === 'success') {
                    $('#candidateCommentsModal').modal('hide');
                    Swal.fire({
                        position: "center",
                        icon: 'success',
                        title: 'Success',
                        text: 'Comments saved successfully!',
                        customClass: {
                            popup: 'swal2-popup',
                            title: 'swal2-title',
                            confirmButton: 'swal2-btn'
                        }
                    });
                } else {
                    Swal.fire({
                        position: "center",
                        icon: 'error',
                        title: 'Failed',
                        text: 'Failed to saved comments.',
                        customClass: {
                            popup: 'swal2-popup',
                            title: 'swal2-title',
                            confirmButton: 'swal2-btn'
                        }
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    position: "center",
                    icon: 'error',
                    title: 'Error',
                    text: (xhr.responseJSON?.message || 'Unknown error'),
                    customClass: {
                        popup: 'swal2-popup',
                        title: 'swal2-title',
                        confirmButton: 'swal2-btn'
                    }
                });
            }
        });
    });
</script>
@endsection
