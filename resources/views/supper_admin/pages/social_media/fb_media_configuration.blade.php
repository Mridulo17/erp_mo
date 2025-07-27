@extends('supper_admin.layouts.app')
@section('title', config('app.name') . ' - Facebook Media Configuration')

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
            <h3 class="box-title">Facebook Media Configuration</h3>
            <h6 class="box-subtitle">Manage your Facebook App and Page details</h6>
        </div>
        <button type="button" class="btn btn-warning addConfigButton" data-toggle="modal" data-target="#modal-center">
            <i class="fa-solid fa-plus"></i> Add Data
        </button>
    </div>
</div>

@include('supper_admin.components.social_media.configuration.facebook_config_modal')

<div class="box-body">
    <div class="table-responsive">
        <table id="customDataTable" style="table-layout: fixed; width: 100%;" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Serial</th>
                    <th>Page Name</th>
                    <th>Page ID</th>
                    <th>App ID</th>
                    <th>Update Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facebookConfigs as $key => $config)
                <tr>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bars"></i> Action
                            </button>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item editConfigButton" data-toggle="modal" data-target="#modal-center" data-id="{{ $config->id }}">
                                    <i class="fa fa-edit"></i> Edit
                                </a>

                                <button type="button"
                                        class="dropdown-item text-danger deleteConfigButton"
                                        data-id="{{ $config->id }}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </td>

                    <td>{{ $key + 1 }}</td>
                    <td class="wrap-text">{{ $config->page_name }}</td>
                    <td class="wrap-text">{{ $config->page_id }}</td>
                    <td class="wrap-text">{{ $config->app_id }}</td>
                    <td>{{ $config->updated_at->format('Y-m-d') }}</td>
                    <td>
                        <span class="badge {{ $config->status == 'Active' ? 'badge-success' : 'badge-danger' }}">
                            {{ $config->status }}
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

                function fetchFacebookConfiguration() {
                    $.ajax({
                        url: '{{ route("supper_admin.social-media-configuration.index") }}',
                        type: 'GET',
                        success: function (data) {
                            let newBody = $(data).find('table tbody').html();
                            $('#customDataTable tbody').html(newBody);
                        },
                        error: function () {
                            console.error('Failed to refresh social media configuration table.');
                        }
                    });
                }
                
                $('#modal-center').on('shown.bs.modal', function () {
                    $('.wrapper').removeAttr('aria-hidden');
                });

                $('#modal-center').on('hidden.bs.modal', function () {
                    $('.wrapper').attr('aria-hidden', 'true');
                });

                $('#facebookConfigurationForm').on('submit', function (e) {
                    e.preventDefault();

                    let formData = new FormData(this);
                    let isEdit = $('#facebook_configuration_id').val() !== ''; 
                    let id = $('#facebook_configuration_id').val();
                    let url = isEdit 
                            ? `{{ route('supper_admin.social-media-configuration.update', ['social_media_configuration' => '__id__']) }}`.replace('__id__', id)
                            : `{{ route('supper_admin.social-media-configuration.store') }}`;

                    let method = isEdit ? 'POST' : 'POST'; 
                    if (isEdit) {
                        formData.append('_method', 'PUT');
                    }

                    Swal.fire({
                        title: isEdit ? "Update Facebook Configuration?" : "Add Facebook Configuration?",
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
                                        $('#facebookConfigurationForm')[0].reset();
                                        $('#facebook_configuration_id').val('');
                                        fetchFacebookConfiguration();
                                    } else {
                                        Swal.fire('Error!', response.message, 'error');
                                    }
                                },
                                error: function (xhr) {
                                    Swal.fire('Error!', 'Failed to save facebook configuration.', 'error');
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });
                });

                $(document).on('click', '.addConfigButton', function () {
                    $('#facebookConfigurationForm')[0].reset();
                    $('#facebook_configuration_id').val('');
                    $('#modalTitle').text('Add Facebook Configuration');
                    $('#modal-center').modal('show');
                });

                
                $(document).on('click', '.editConfigButton', function () {
                    const id = $(this).data('id');
                    const url = '{{ route("supper_admin.social-media-configuration.edit", ":id") }}'.replace(':id', id);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (res) {
                            $('#facebook_configuration_id').val(id);
                            $('#page_name').val(res.page_name);
                            $('#page_id').val(res.page_id);
                            $('#app_id').val(res.app_id);
                            $('#app_secret').val(res.app_secret);
                            $('#access_token').val(res.access_token);
                            $('#status').prop('checked', res.status === 'Active');
                            $('#modalTitle').text('Edit Facebook Configuration');
                            $('#modal-center').modal('show');
                            
                        },
                        error: function () {
                            Swal.fire('Error', 'Could not load facebook configuration data.', 'error');
                        }
                    });
                });

                $(document).on('click', '.deleteConfigButton', function () {
                    const id = $(this).data('id');
                    const url = '{{ route("supper_admin.social-media-configuration.destroy", ":id") }}'.replace(':id', id);

                    Swal.fire({
                        title: 'Delete facebook configuration?',
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
                                        fetchFacebookConfiguration();
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

