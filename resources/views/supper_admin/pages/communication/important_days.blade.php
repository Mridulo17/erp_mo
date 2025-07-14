@extends('supper_admin.layouts.app')
@section('title', config('app.name') . ' - important_days')

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
            <h3 class="box-title">Important Days</h3>
            <h6 class="box-subtitle">Important Days List</h6>
        </div>
        <button type="button" class="btn btn-warning addBlogButton" data-toggle="modal" data-target="#modal-center">
            <i class="fa-solid fa-plus"></i> Add Data
        </button>
    </div>
</div>

@include('supper_admin.components.communication.important_days_modal')

<div class="box-body">
        <div class="table-responsive">
            <table id="customDataTable" style="table-layout: fixed; width: 100%;" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                <thead>
                    <tr>
                        <th style="">Action</th>
                        <th style="">Serial</th>
                        <th style="">Day Name</th>
                        <th style="">Day Date</th>
                        <th style="">Entry Date</th>
                        <th style="">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($importantDays as $key =>$importantDay)
                    <tr>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bars"></i> Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item editBlogButton" data-toggle="modal" data-target="#modal-center" data-id="{{ $importantDay->id }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    
                                    <button type="button"
                                            class="dropdown-item text-danger deletecountryBtn"
                                            data-id="{{ $importantDay->id }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                        
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $importantDay->name}}</td>
                        <td class="wrap-text">{{ $importantDay->date }}</td>
                        <td class="wrap-text">{{ $importantDay->created_at  }}</td>
                        <td>
                            <span class="badge {{ $importantDay->status == '1' ? 'badge-success' : 'badge-danger' }}">
                                {{ $importantDay->status == '1' ? 'Active' : 'Inactive' }}
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
            $(document).ready(function () {

                function fetchImportantDays() {
                    $.ajax({
                        url: '{{ route("supper_admin.important-days.index") }}',
                        type: 'GET',
                        success: function (data) {
                            let newBody = $(data).find('table tbody').html();
                            $('#customDataTable tbody').html(newBody);
                        },
                        error: function () {
                            console.error('Failed to refresh important days table.');
                        }
                    });
                }
                
                $('#modal-center').on('shown.bs.modal', function () {
                    $('.wrapper').removeAttr('aria-hidden');
                });

                $('#modal-center').on('hidden.bs.modal', function () {
                    $('.wrapper').attr('aria-hidden', 'true');
                });

                $('#importantDaysForm').on('submit', function (e) {
                    e.preventDefault();

                    let formData = new FormData(this);
                    let url = `{{ route('supper_admin.important-days.store') }}`;

                    Swal.fire({
                        title: "Add Important Day?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Yes, Add"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    if (response.status === 'success') {
                                        $('#modal-center').modal('hide');
                                        Swal.fire('Success!', response.message, 'success');
                                        $('#importantDaysForm')[0].reset();
                                        fetchImportantDays();
                                    } else {
                                        Swal.fire('Error!', response.message, 'error');
                                    }
                                },
                                error: function (xhr) {
                                    Swal.fire('Error!', 'Failed to save important day.', 'error');
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });
                });
            });
        </script>
        @endsection


@endsection

