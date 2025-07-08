@extends('backend.layouts.app')
@section('title', config('app.name') . ' - Candidates')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container .select2-selection--single {
            height: 32px;
            border: 1px solid #86a4c3;
            border-radius: 5px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 32px;
            /* right: 0px; */
        }

        .step-nav { display: flex; flex-wrap: wrap; justify-content: space-between; margin-bottom: 30px; }
        .step-item {
            flex: 1;
            text-align: center;
            padding: 10px 5px;
            border-bottom: 3px solid #dee2e6;
            color: #6c757d;
            font-weight: 500;
            font-size: 14px;
        }
        .step-item.active {
            border-color: #0d6efd;
            color: #0d6efd;
            font-weight: 700;
        }
    </style>
@endsection

@section('content')
<div class="box">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
        <h3 class="box-title">New Worker Form</h3>
    </div>
    <div class="box-body" id="content-wrapper">
        @include('backend.pages.process.candidates.partials.form', ['step' => $step])
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    let currentStep = {{ $step }};
    // console.log("Current Step:", currentStep);

    // Handle form submit (Next or Final Submit)
    $(document).on('submit', '#candidateForm', function (e) {        
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('step', currentStep); // always send current step

        $.ajax({
            url: "{{ route('admin.candidates.store') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.success) {
                    if (res.redirect) {
                        window.location.href = res.redirect;
                    }else {
                        currentStep = res.step;
                        $('#content-wrapper').html(res.html);
                        initSelect2();
                    }
                }
            },
            error: function (xhr) {
                alert('Submission failed!');
                console.log(xhr.responseText);
            }
        });
    });

    // Handle previous button click
    $(document).on('click', '#prevBtn', function () {
        if (currentStep > 1) {
            let formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('step', currentStep - 1);
            formData.append('prev', true); // flag to indicate previous request

            $.ajax({
                url: "{{ route('admin.candidates.store') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res.success) {
                        currentStep = res.step;
                        $('#content-wrapper').html(res.html);
                        initSelect2();
                    }
                },
                error: function (xhr) {
                    alert('Something went wrong.');
                    console.log(xhr.responseText);
                }
            });
        }
    });

    function initSelect2() {
        $('.select2').select2({ width: '100%' });
    }
</script>
@endsection
