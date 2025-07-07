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
            <a href="{{ route('admin.phone-calls.create') }}" class="btn btn-warning">
                <i class="fa fa-plus"></i> Add Visitor Book
            </a>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="visitorBookTable">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>ID</th>
                            <th>Phone</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Category</th>
                            <th>Entry Time</th>
                            <th>Find Us</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visitorBooks as $visitor)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.visitor-books.edit', $visitor->id) }}"
                                        class="btn btn-sm btn-primary editBtn">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $visitor->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                                <td>{{ $visitor->id }}</td>
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

                {{ $visitorBooks->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $('.editBtn').on('click', function() {
                let id = $(this).data('id');
                $.get(`/admin/enquiry/visitor-books/${id}/edit`, function(res) {
                    $('#visitor_book_id').val(res.id);
                    $('#phone').val(res.phone);
                    $('#full_name').val(res.full_name);
                    $('#address').val(res.address);
                    $('#candidate_type_id').val(res.candidate_type_id).trigger('change');
                    $('#reference_type').val(res.reference_type);
                    $('#note').val(res.note);
                    $('#entry_time').val(res.entry_time);
                    $('#how_find_us').val(res.how_find_us);
                    $('#submitBtnText').text('Update');
                });
            });

            $('.deleteBtn').on('click', function() {
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
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(res) {
                                Swal.fire('Deleted!', res.message, 'success').then(() =>
                                    location.reload());
                            },
                            error: function() {
                                Swal.fire('Error!', 'Could not delete record.',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
