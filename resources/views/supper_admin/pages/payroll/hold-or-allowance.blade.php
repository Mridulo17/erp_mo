@extends('supper_admin.layouts.app')
@section('title', config('app.name') . ' - Hold/Allowance')

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
                <h3 class="box-title">Hold/Allowance</h3>
                <h6 class="box-subtitle">This is all hold/allowance List</h6>
            </div>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="customDataTable" style="table-layout: fixed; width: 100%;"
                       class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                    <thead>
                    <tr>
                        <th style="width: 5%;">DB:ID</th>
                        <th>Employee Name & ID</th>
                        <th>Department</th>
                        <th>Hold Salary</th>
                        <th>Mobile Bill</th>
                        <th>Accommodation</th>
                        <th>White List</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $key =>$employee)
                        <tr>
                            <td style="width: 5%;">{{ $key + 1 }}</td>
                            <td><b>{{$employee->employee_code}}</b> - {{$employee->first_name}} {{$employee->last_name}}</td>
                            <td><b>{{$employee->department ? $employee->department->name : '' }}</b> - {{$employee->designation ? $employee->designation->name : '' }}</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input"
                                           onclick="hold_and_allowance_config('{{ $employee->id }}', 'hold_salary')"
                                           id="hold_salary_{{ $employee->id }}"
                                           type="checkbox">
                                    <label for="hold_salary_{{ $employee->id }}"></label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input"
                                           onclick="hold_and_allowance_config('{{ $employee->id }}', 'mobile_allowance')"
                                           id="mobile_allowance_{{ $employee->id }}"
                                           type="checkbox">
                                    <label for="mobile_allowance_{{ $employee->id }}"></label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input"
                                           onclick="hold_and_allowance_config('{{ $employee->id }}', 'accommodation')"
                                           id="accommodation{{ $employee->id }}"
                                           type="checkbox">
                                    <label for="accommodation{{ $employee->id }}"></label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input"
                                           onclick="hold_and_allowance_config('{{ $employee->id }}', 'white_list')"
                                           id="white_list_{{ $employee->id }}"
                                           type="checkbox">
                                    <label for="white_list_{{ $employee->id }}"></label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @section('script')
        <script>
            function fetchSetupWeekend(departmentId = null) {
                $.ajax({
                    url: '{{ route("supper_admin.weekends.index") }}',
                    type: 'GET',
                    data: {department_id: departmentId}, // Pass department_id to filter employees
                    success: function (data) {
                        let newBody = $(data).find('#customDataTable tbody').html();
                        $('#customDataTable tbody').html(newBody);
                        // Explicitly set selected department in dropdown after update
                        if (departmentId) {
                            $('#departmentSelect').val(departmentId);

                        }
                    },
                    error: function () {
                        console.error('Failed to refresh assign roasting table.');
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

            function hold_and_allowance_config(employeeId, type) {
                console.log(`Employee ID: ${employeeId}, Type: ${type}`);

                // Example: send update via AJAX
                $.ajax({
                    url: `/supper_admin/hold-or-allowances/store`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        employee_id: employeeId,
                        config_type: type
                    },
                    success: function (response) {
                        Swal.fire('Updated!', response.message || 'Configuration updated.', 'success');
                    },
                    error: function () {
                        Swal.fire('Error', 'Failed to update configuration.', 'error');
                    }
                });
            }


            function update_employee_weekend(employeeId, selectElement) {
                const selectedWeekendId = selectElement.value;

                $.ajax({
                    url: `/supper_admin/weekends/${employeeId}`, // adjust route
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        weekend_day: selectedWeekendId
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire('Success!', response.message, 'success');
                            fetchSetupWeekend();
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error!', 'Failed to setup weekend.', 'error');
                    }
                });
            }

            $(document).ready(function () {

                // Trigger the fetchEmployees function when a category is selected
                $('#departmentSelect').on('change', function () {
                    const departmentId = $(this).val();
                    if (departmentId) {
                        fetchSetupWeekend(departmentId);
                    }
                });
            });
        </script>

    @endsection
@endsection
