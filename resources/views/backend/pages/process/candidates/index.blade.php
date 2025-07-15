@extends('backend.layouts.app')
@section('title', config('app.name') . ' - Candidates')

@section('style')
    <style>
        .wrap-text {
            white-space: normal !important;
            word-wrap: break-word !important;
            word-break: break-word !important;
        }
        /* Move DataTables search field to the right */
        div.dataTables_filter {
            text-align: right !important;
        }
    </style>
@endsection

@section('content')
{{-- @if (session('status'))
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
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
@endif --}}

<div class="box">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
        <div>
            <h3 class="box-title">Candidates Information</h3>
            <h6 class="box-subtitle">This is all Candidate List</h6>
        </div>
        <a href="{{ route('admin.candidates.create') }}" type="button" class="btn btn-warning addAgentButton" >
            <i class="fa-solid fa-plus"></i> Add Candidates
        </a>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="candidateDataTable" style="table-layout: fixed; width: 100%;" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
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
        { data: 'name', name: 'personalInfo.full_name', defaultContent: '' },
        { data: 'agent', name: 'agent.full_name', defaultContent: '' },
        { data: 'age_gender', name: 'personalInfo.date_of_birth', defaultContent: '' },
        { data: 'nid', name: 'personalInfo.nid_or_birth_certificate', defaultContent: '' },
        { data: 'passport', name: 'passport.passport_number', defaultContent: '' },
        { data: 'passport_validity', name: 'passport.passport_expired_date', defaultContent: '' },
        { data: 'interested_country', name: 'country.name', defaultContent: '' },
        { data: 'interested_profession', name: 'profession.name', defaultContent: '' },
        { data: 'status', name: 'status', orderable: false, searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]

    let datatable_columns_defs = [
        {'bSortable': true, 'aTargets': [0,1,2,3,4]},
        {'bSearchable': false, 'aTargets': [0]},
        { className: 'text-center', targets: [0,4,5] },
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
    });
</script>
@endsection
