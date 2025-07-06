@extends('backend.layouts.app')
@section('title', config('app.name') . ' - Edit Phone Call')

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
<div class="box">
    <div class="box-header with-border d-flex justify-content-between align-items-center">
        <div>
            <h3 class="box-title">Edit Phone Call</h3>
        </div>
        <a href="{{ route('admin.phone-calls.index') }}" class="btn btn-warning">
            <i class="fa fa-list"></i> Phone Calls List
        </a>
    </div>

    <div class="box-body">
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.phone-calls.update', $phoneCall->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Phone *</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $phoneCall->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $phoneCall->email) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $phoneCall->full_name) }}">
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Choose Country</label>
                            <select name="country_id" class="form-control select2" required>
                                <option value="">Choose Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ $country->id == $phoneCall->country_id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label class="form-label">Choose Category</label>
                            <select name="candidate_type_id" class="form-control select2" required>
                                <option value="">Choose Category</option>
                                @foreach ($candidateTypes as $type)
                                    <option value="{{ $type->id }}" {{ $type->id == $phoneCall->candidate_type_id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea name="note" class="form-control" rows="3">{{ old('note', $phoneCall->note) }}</textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Followup Date</label>
                            <input type="date" name="followup_date" class="form-control" value="{{ old('followup_date', $phoneCall->followup_date) }}">
                        </div>

                        <div class="col">
                            <label class="form-label">How to find us</label>
                            <select name="how_find_us" class="form-control select2" required>
                                <option value="">Choose find us</option>
                                @php
                                    $options = [
                                        "Old Candidate", "Listen from neighbor", "Walking Candidate",
                                        "Online Marketing link", "News Paper", "Google", "Facebook",
                                        "Instagram", "Linkedin", "TikTok", "SMS", "WhatsApp", "Telegram",
                                        "Youtube", "Parents", "TVC", "Friends", "Colleague", "I dont Know", "Other"
                                    ];
                                @endphp

                                @foreach($options as $option)
                                    <option value="{{ $option }}" {{ $phoneCall->how_find_us == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Please Select",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection
