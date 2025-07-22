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

            // English Number to Words
            function numberToEnglishWords(num) {
                const a = [
                    '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine',
                    'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen',
                    'sixteen', 'seventeen', 'eighteen', 'nineteen'
                ];
                const b = [
                    '', '', 'twenty', 'thirty', 'forty', 'fifty',
                    'sixty', 'seventy', 'eighty', 'ninety'
                ];

                function convert(n) {
                    if (n < 20) return a[n];
                    if (n < 100) return b[Math.floor(n / 10)] + (n % 10 ? " " + a[n % 10] : "");
                    if (n < 1000) return a[Math.floor(n / 100)] + " hundred" + (n % 100 ? " " + convert(n % 100) : "");
                    if (n < 1000000) return convert(Math.floor(n / 1000)) + " thousand" + (n % 1000 ? " " + convert(n % 1000) : "");
                    return "amount too large";
                }

                return convert(num) + " taka only";
            }

            // Bangla Number to Words
            function numberToBanglaWords(num) {
                const numbers = {
                    0: 'শূন্য',
                    1: 'এক',
                    2: 'দুই',
                    3: 'তিন',
                    4: 'চার',
                    5: 'পাঁচ',
                    6: 'ছয়',
                    7: 'সাত',
                    8: 'আট',
                    9: 'নয়',
                    10: 'দশ',
                    11: 'এগারো',
                    12: 'বারো',
                    13: 'তেরো',
                    14: 'চৌদ্দ',
                    15: 'পনেরো',
                    16: 'ষোল',
                    17: 'সতেরো',
                    18: 'আঠারো',
                    19: 'উনিশ',
                    20: 'বিশ',
                    21: 'একুশ',
                    22: 'বাইশ',
                    23: 'তেইশ',
                    24: 'চব্বিশ',
                    25: 'পঁচিশ',
                    26: 'ছাব্বিশ',
                    27: 'সাতাশ',
                    28: 'আটাশ',
                    29: 'ঊনত্রিশ',
                    30: 'ত্রিশ',
                    31: 'একত্রিশ',
                    32: 'বত্রিশ',
                    33: 'তেত্রিশ',
                    34: 'চৌত্রিশ',
                    35: 'পঁইত্রিশ',
                    36: 'ছত্রিশ',
                    37: 'সাঁইত্রিশ',
                    38: 'আটত্রিশ',
                    39: 'ঊনচল্লিশ',
                    40: 'চল্লিশ',
                    41: 'একচল্লিশ',
                    42: 'বিয়াল্লিশ',
                    43: 'তেতাল্লিশ',
                    44: 'চুয়াল্লিশ',
                    45: 'পঁয়তাল্লিশ ',
                    46: 'ছিচল্লিশ',
                    47: 'সাতচল্লিশ',
                    48: 'আটচল্লিশ',
                    49: 'ঊনপঞ্চাশ',
                    50: 'পঞ্চাশ',
                    51: 'একান্ন',
                    52: 'বাহান্ন',
                    53: 'তিপ্পান্ন',
                    54: 'চুয়ান্ন',
                    55: 'পঁচান্ন',
                    56: 'ছাপ্পান্ন',
                    57: 'সাতান্ন',
                    58: 'আটান্ন',
                    59: 'ঊনষাট',
                    60: 'ষাট',
                    61: 'একষট্টি',
                    62: 'বাষট্টি',
                    63: 'তেষট্টি',
                    64: 'চৌষট্টি',
                    65: 'পঁইষট্টি',
                    66: 'ছেষট্টি',
                    67: 'সাতষট্টি',
                    68: 'আটষট্টি',
                    69: 'ঊনসত্তর',
                    70: 'সত্তর',
                    71: 'একাত্তর',
                    72: 'বাহাত্তর',
                    73: 'তিয়াত্তর',
                    74: 'চুয়াত্তর',
                    75: 'পঁচাত্তর',
                    76: 'ছিয়াত্তর',
                    77: 'সাতাত্তর',
                    78: 'আটাত্তর',
                    79: 'ঊনআশি',
                    80: 'আশি',
                    81: 'একাশি',
                    82: 'বিরাশি',
                    83: 'তিরাশি',
                    84: 'চুরাশি',
                    85: 'পঁচাশি',
                    86: 'ছিয়াশি',
                    87: 'সাতাশি',
                    88: 'আটাশি',
                    89: 'ঊননব্বই',
                    90: 'নব্বই',
                    91: 'একানব্বই',
                    92: 'বিরানব্বই',
                    93: 'তিরানব্বই',
                    94: 'চুরানব্বই',
                    95: 'পঁচানব্বই',
                    96: 'ছিয়ানব্বই',
                    97: 'সাতানব্বই',
                    98: 'আটানব্বই',
                    99: 'নিরানব্বই'
                };

                function convert(n) {
                    if (n <= 99) {
                        return numbers[n] || '';
                    } else if (n < 1000) {
                        const hundred = Math.floor(n / 100);
                        const rest = n % 100;
                        return numbers[hundred] + ' শত' + (rest > 0 ? ' ' + convert(rest) : '');
                    } else if (n < 100000) {
                        const thousand = Math.floor(n / 1000);
                        const rest = n % 1000;
                        return convert(thousand) + ' হাজার' + (rest > 0 ? ' ' + convert(rest) : '');
                    } else if (n < 10000000) {
                        const lakh = Math.floor(n / 100000);
                        const rest = n % 100000;
                        return convert(lakh) + ' লক্ষ' + (rest > 0 ? ' ' + convert(rest) : '');
                    }
                    return 'অতিরিক্ত পরিমাণ';
                }

                return convert(num) + ' টাকা মাত্র';
            }

            fetchEmployees();

            function fetchEmployees() {
                $.ajax({
                    url: "{{ route('supper_admin.unpaid.employees') }}",
                    method: "GET",
                    success: function (data) {
                        let select = $('#employeeSelect');
                        select.empty();
                        select.append('<option value="" disabled selected>Choose Employee</option>');

                        data.forEach(function (employee) {
                            select.append(
                                '<option data-employee_salary="' + employee.employee_salary + '" value="' + employee.employee_id + '">' +
                                employee.employee.first_name + ' ' + employee.employee.last_name +
                                '</option>'
                            );
                        });
                    },
                    error: function (xhr) {
                        console.error("Failed to fetch employees:", xhr);
                    }
                });
            }

            $('#employeeSelect').on('change', function () {
                const selectedOption = $(this).find('option:selected');
                const amount = selectedOption.data('employee_salary');
                $('#net_salary').text(amount);
                $('#new_salary').val(amount);
                const bangla = numberToBanglaWords(amount);
                const english = numberToEnglishWords(amount);

                $('#amount_translate').html(
                    '<b style="color: #7b7a7a;">' + bangla + '<hr style="margin: 0px;">' +
                    '<span style="text-transform: capitalize;font-size: 9px;">' + english + '</span>' +
                    '</b>'
                );
                $('#infoDiv').show();
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
