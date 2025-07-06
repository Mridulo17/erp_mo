@extends('backend.layouts.app')
@section('title', config('app.name') . ' - Phone Calls')

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
                <h3 class="box-title">Phone Calls Form</h3>
            </div>
            <a href="{{ route('admin.phone-calls.index') }}" class="btn btn-warning addCandidateButton">
                <i class="fa-solid fa-list"></i> List
            </a>
        </div>

        <div class="box-body">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.phone-calls.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Phone *</label>
                                <input type="text" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control">
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Choose Country</label>
                                <select name="country_id" class="form-control select2" required>
                                    <option value="">Choose Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label class="form-label">Choose Category</label>
                                <select name="candidate_type_id" class="form-control select2" required>
                                    <option value="">Choose Category</option>
                                    @foreach ($candidateTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Note</label>
                            <textarea name="note" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Followup Date</label>
                                <input type="date" name="followup_date" class="form-control">
                            </div>

                            <div class="col">
                                <label class="form-label">How to find us</label>
                                <select name="how_find_us" class="form-control select2" required>
                                    <option value="">Choose find us</option>
                                    <option value="Old Candidate">Old Candidate</option>
                                    <option value="Listen from neighbor">Listen from neighbor</option>
                                    <option value="Walking Candidate">Walking Candidate</option>
                                    <option value="Online Marketing link">Online Marketing link</option>
                                    <option value="News Paper">News Paper</option>
                                    <option value="Google">Google</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Linkedin">Linkedin</option>
                                    <option value="TikTok">TikTok</option>
                                    <option value="SMS">SMS</option>
                                    <option value="WhatsApp">WhatsApp</option>
                                    <option value="Telegram">Telegram</option>
                                    <option value="Youtube">Youtube</option>
                                    <option value="Parents">Parents</option>
                                    <option value="TVC">TVC</option>
                                    <option value="Friends">Friends</option>
                                    <option value="Colleague">Colleague</option>
                                    <option value="I dont Know">I don't Know</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Save
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
