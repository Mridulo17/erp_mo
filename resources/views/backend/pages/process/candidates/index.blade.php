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
    $('#candidateDataTable').DataTable({
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
@endsection
