@extends('supper_admin.layouts.app')
@section('title', config('app.name') . ' - important-template')

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
@endif

<div class="box">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
        <div>
            <h3 class="box-title">Important Templates</h3>
            <h6 class="box-subtitle">Important Templates List</h6>
        </div>
        <button type="button" class="btn btn-warning addTemplateButton" data-toggle="modal" data-target="#modal-center">
            <i class="fa-solid fa-plus"></i> Add Data
        </button>
    </div>
</div>

@include('supper_admin.components.communication.important_templates_modal')

<div class="box-body">
        <div class="table-responsive">
            <table id="customDataTable" style="table-layout: fixed; width: 100%;" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                <thead>
                    <tr>
                        <th style="">Action</th>
                        <th style="">Serial</th>
                        <th style="">Day Name</th>
                        <th style="">Message Body</th>
                        <th style="">File</th>
                        <th style="">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($importantTemplates as $key =>$importantTemplate)
                    <tr>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bars"></i> Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item editImportantTemplateButton" data-toggle="modal" data-target="#modal-center" data-id="{{ $importantTemplate->id }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    
                                    <button type="button"
                                            class="dropdown-item text-danger deleteImportantTemplateButton"
                                            data-id="{{ $importantTemplate->id }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                        
                        <td>{{ $key + 1 }}</td>

                        <td>{{ $importantTemplate->importantDay ? $importantTemplate->importantDay->name : 'N/' }}</td>
                        <td class="wrap-text">{{ $importantTemplate->message_template }}</td>
                        <td class="wrap-text">{{ $importantTemplate->attachment ?? 'N/A' }}</td>
                        <td>
                            <span class="badge {{ $importantTemplate->status == 'Active' ? 'badge-success' : 'badge-danger' }}">
                                {{ $importantTemplate->status == 'Active' ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>

     @section('script')

         <script>
            function fetchImportantTemplates() {
                $.ajax({
                    url: '{{ route("supper_admin.important-template.index") }}',
                    type: 'GET',
                    success: function (data) {
                        let newBody = $(data).find('table tbody').html();
                        $('#customDataTable tbody').html(newBody);
                    },
                    error: function () {
                        console.error('Failed to refresh important template table.');
                    }
                });
            }

            $('#modal-center').on('shown.bs.modal', function () {
                $('.wrapper').removeAttr('aria-hidden');
            });

            $('#modal-center').on('hidden.bs.modal', function () {
                $('.wrapper').attr('aria-hidden', 'true');
            });

            $(document).ready(function () {
                fetchImportantDays();
                function fetchImportantDays() {
                    $.ajax({
                        url: "{{ route('supper_admin.important-days.active') }}",
                        method: "GET",
                        success: function(data) {
                            let select = $('#daySelect');
                            select.empty();
                            select.append('<option value="" disabled selected>Select a Day</option>');
                            data.forEach(function(day) {
                                select.append('<option value="' + day.id + '">' + day.name + '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.error("Failed to fetch days:", xhr);
                        }
                    });
                }

                $('#importantTemplateForm').on('submit', function (e) {
                    e.preventDefault();

                    let isEdit = $('#important_templates_id').val() !== ''; 
                    let formData = new FormData(this); 
                    let id = $('#important_templates_id').val(); 
                    let url = isEdit 
                        ? `{{ route('supper_admin.important-template.update', ['important_template' => '__id__']) }}`.replace('__id__', id) 
                        : `{{ route('supper_admin.important-template.store') }}`;

                    let method = isEdit ? 'POST' : 'POST'; 
                    if (isEdit) {
                        formData.append('_method', 'PUT');
                    }

                    Swal.fire({
                        title: isEdit ? "Update template?" : "Add template?",
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
                                        $('#importantTemplateForm')[0].reset();
                                        $('#important_templates_id').val('');
                                        fetchImportantTemplates();
                                    } else {
                                        Swal.fire('Error!', response.message, 'error');
                                    }
                                },
                                error: function () {
                                    Swal.fire('Error!', 'Failed to save templates.', 'error');
                                }
                            });
                        }
                    });
                });

                $(document).on('click', '.addTemplateButton', function () {
                    $('#importantTemplateForm')[0].reset();
                    $('#important_templates_id').val('');
                    $('#modalTitle').text('Add Template');
                    $('#modal-center').modal('show');
                });

                $(document).on('click', '.editImportantTemplateButton', function () {
                    const id = $(this).data('id');
                    const url = '{{ route("supper_admin.important-template.edit", ":id") }}'.replace(':id', id);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (res) {
                            $('#important_templates_id').val(id);
                            $('#message_template').val(res.message_template);
                            $('#status').prop('checked', res.status === 'Active');
                            $('#modalTitle').text('Edit template');
                            $('#modal-center').modal('show');
                            $('#daySelect').val(res.important_days_id).trigger('change');
                            
                        },
                        error: function () {
                            Swal.fire('Error', 'Could not load country data.', 'error');
                        }
                    });
                });

                $(document).on('click', '.deleteImportantTemplateButton', function () {
                    const id = $(this).data('id');
                    const url = '{{ route("supper_admin.important-template.destroy", ":id") }}'.replace(':id', id);

                    Swal.fire({
                        title: 'Delete template?',
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
                                success: function (res) {
                                    if (res.status === 'success') {
                                        Swal.fire('Deleted!', res.message, 'success');
                                        fetchImportantTemplates();
                                    } else {
                                        Swal.fire('Error!', res.message, 'error');
                                    }
                                },
                                error: function () {
                                    Swal.fire('Error!', 'Failed to delete.', 'error');
                                }
                            });
                        }
                    });
                });
            });
        </script>
        @endsection


@endsection

