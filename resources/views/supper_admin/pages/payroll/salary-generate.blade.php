@extends('supper_admin.layouts.app')
@section('title', config('app.name') . ' - Salary Generate')

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
        <!-- Header Section -->
        <div class="box-header with-border d-flex justify-content-between align-items-center">
            <div>
                <h3 class="box-title">Salary Generate</h3>
                <h6 class="box-subtitle">This is all Salary Generate List</h6>
            </div>
            <button type="button" class="btn btn-warning addBlogButton" data-toggle="modal" data-target="#modal-center">
                <i class="fa-solid fa-plus"></i> Add Data
            </button>
        </div>

        @include('supper_admin.components.payroll.salary_generate_modal')
        @include('supper_admin.components.payroll.salary_distribution_modal')

        <div class="box-body">
            <div class="table-responsive">
                <table id="customDataTable" style="table-layout: fixed; width: 100%;"
                       class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                    <thead>
                    <tr>
                        <th style="">Action</th>
                        <th style="">DB:ID</th>
                        <th style="">Year</th>
                        <th style="">Month</th>
                        <th style="">Total Employee</th>
                        <th style="">Total Amount</th>
                        <th style="">Generate By</th>
                        <th style="">Generate Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salaries as $key =>$bonus)
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i> Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Edit Button inside Dropdown -->
                                        <a href="#" class="dropdown-item editBlogButton" data-toggle="modal"
                                           data-target="#modal-distribution" data-id="{{ $bonus->id }}">
                                            <i class="fa fa-edit"></i> Salary Distribution
                                        </a>

                                        <!-- Delete Form inside Dropdown -->
                                        <button type="button"
                                                class="dropdown-item text-danger deleteBonusBtn"
                                                data-id="{{ $bonus->id }}">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </td>

                            <td>{{ $key + 1 }}</td>
                            <td class="wrap-text">  {{ \Carbon\Carbon::parse($bonus->month_year)->format('Y') }}</td>
                            <td class="wrap-text">  {{ \Carbon\Carbon::parse($bonus->month_year)->format('m') }}</td>
                            <td class="wrap-text">{{ $bonus->total_employee  }}</td>
                            <td class="wrap-text">{{ $bonus->total_employee_salary  }}</td>
                            <td class="wrap-text">{{ $bonus->user ? $bonus->user->name : ''  }}</td>
                            <td class="wrap-text">{{ $bonus->created_at->format('Y-m-d') }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @section('script')
        <script>

            function fetchSalaryGenerates() {
                $.ajax({
                    url: '{{ route("supper_admin.salary-generate.index") }}',
                    type: 'GET',
                    success: function (data) {
                        let newBody = $(data).find('#customDataTable tbody').html();
                        $('#customDataTable tbody').html(newBody);
                    },
                    error: function () {
                        console.error('Failed to refresh salary generate table.');
                    }
                });
            }

            $('#modal-center').on('shown.bs.modal', function () {
                $('.wrapper').removeAttr('aria-hidden');
            });

            // When the modal is hidden
            $('#modal-center').on('hidden.bs.modal', function () {
                $('.wrapper').attr('aria-hidden', 'true');
            });

            $(document).ready(function () {

                $('#salaryGenerateForm').on('submit', function (e) {
                    e.preventDefault();
                    let isEdit = $('#festival_bonus_id').val() !== '';
                    let formData = new FormData(this);
                    let id = $('#festival_bonus_id').val();
                    const baseUpdateUrl = "{{ url('supper_admin/salary-generate') }}";
                    let url = isEdit
                        ? `${baseUpdateUrl}/${id}`
                        : `{{ route('supper_admin.salary-generate.store') }}`;

                    let method = isEdit ? 'POST' : 'POST';
                    if (isEdit) {
                        formData.append('_method', 'PUT');
                    }

                    Swal.fire({
                        title: isEdit ? "Update Festival Bonus?" : "Salary Generate?",
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
                                        $('#salaryGenerateForm')[0].reset();
                                        $('#festival_bonus_id').val('');
                                        fetchSalaryGenerates();
                                    } else {
                                        Swal.fire('Error!', response.message, 'error');
                                    }
                                },
                                error: function () {
                                    Swal.fire('Error!', 'Failed to save festival bonus.', 'error');
                                }
                            });
                        }
                    });
                });

                $(document).on('click', '.addBlogButton', function () {
                    $('#salaryGenerateForm')[0].reset();
                    $('#festival_bonus_id').val('');
                    $('#modalTitle').text('Add Festival Bonus');
                    $('#modal-center').modal('show');

                });
                $(document).on('click', '.editBlogButton', function () {
                    $('#distributionForm')[0].reset();
                    $('#festival_bonus_id').val('');
                    $('#modalTitle').text('Salary Distribution');
                    $('#modal-distribution').modal('show');

                });

                $(document).on('click', '.deleteBonusBtn', function () {
                    const id = $(this).data('id');
                    const url = '{{ route("supper_admin.salary-generate.destroy", ":id") }}'.replace(':id', id);

                    Swal.fire({
                        title: 'Are You Sure?',
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
                                    _method: 'DELETE',
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function (response) {
                                    if (response.status === 'success') {
                                        Swal.fire('Deleted!', response.message, 'success');
                                        fetchSalaryGenerates();
                                    } else {
                                        Swal.fire('Error!', response.message, 'error');
                                    }
                                },
                                error: function () {
                                    Swal.fire('Error!', 'Failed to delete the salary generate.', 'error');
                                }
                            });
                        }
                    });
                });
            });
        </script>

    @endsection
@endsection
