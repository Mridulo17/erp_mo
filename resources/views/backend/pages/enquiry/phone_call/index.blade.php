@extends('backend.layouts.app')
@section('title', config('app.name') . ' - Phone Calls')

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
            <h3 class="box-title">Phone Calls Information</h3>
            <h6 class="box-subtitle">This is the complete Phone Call List</h6>
        </div>
        <a href="{{ route('admin.phone-calls.create') }}" class="btn btn-warning">
            <i class="fa fa-plus"></i> Add Phone Call
        </a>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="customDataTable" style="table-layout: fixed; width: 100%;" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                <thead>
                    <tr>
                        <th>Action</th>
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
                    @foreach($phoneCalls as $key => $call)
                    <tr>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bars"></i> Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{ route('admin.phone-calls.edit', $call->id) }}" class="dropdown-item">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="dropdown-item text-danger deletePhoneCallBtn" data-id="{{ $call->id }}">
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
<script>
    function fetchPhoneCalls() {
        $.ajax({
            url: '{{ route("admin.phone-calls.index") }}',
            type: 'GET',
            success: function (data) {
                let newBody = $(data).find('table tbody').html();
                $('#customDataTable tbody').html(newBody);
            },
            error: function () {
                console.error('Failed to refresh phone call table.');
            }
        });
    }

    $(document).on('click', '.deletePhoneCallBtn', function () {
        const id = $(this).data('id');
        const url = '{{ route("admin.phone-calls.destroy", ":id") }}'.replace(':id', id);

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
                    success: function (res) {
                        if (res.status === 'success') {
                            Swal.fire('Deleted!', res.message, 'success');
                            fetchPhoneCalls();
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
</script>
@endsection
