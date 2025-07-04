@extends('backend.layouts.app')
@section('title', config('app.name') . ' - Candidates')

@section('style')
<style>
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
        <div>
            <h3 class="box-title">New Worker Form</h3>
        </div>
        <button type="button" class="btn btn-warning addCandidateButton" data-toggle="modal" data-target="#modal-center">
            <i class="fa-solid fa-list"></i> List
        </button>
    </div>

    <div class="box-body">
        <div class="step-nav">
            @php
                $steps = [
                    1 => 'New Candidate',
                    2 => 'Personal Information',
                    3 => 'Experience Information',
                    4 => 'Passport Information',
                    5 => 'Location',
                    6 => 'Files',
                    7 => 'Review',
                ];
            @endphp

            @foreach($steps as $i => $label)
                <div class="step-item {{ $step == $i ? 'active' : '' }}">
                    {{ $i }} - {{ $label }}
                </div>
            @endforeach
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.candidates.store') }}">
                    @csrf
                    <input type="hidden" name="step" value="{{ $step }}">

                    @if($step == 1)
                        <div class="row form-group col-md-3">
                            <label for="candidate_type" class="font-weight-bold text-dark" style="font-size: 14px;">Candidate Type</label>
                            <select id="candidate_type" name="candidate_type" class="form-control">
                                <option value="" disabled selected>--Select One--</option>
                                <option value="skilled" {{ session('form.step_1.candidate_type') == 'skilled' ? 'selected' : '' }}>Skilled</option>
                                <option value="unskilled" {{ session('form.step_1.candidate_type') == 'unskilled' ? 'selected' : '' }}>Unskilled</option>
                                <option value="professional" {{ session('form.step_1.candidate_type') == 'professional' ? 'selected' : '' }}>Professional</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="referral_agent" class="font-weight-bold text-dark" style="font-size: 14px;">Referral Agent</label>
                                <select id="referral_agent" name="referral_agent" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="agent_1" {{ session('form.step_1.referral_agent') == 'agent_1' ? 'selected' : '' }}>Agent 1</option>
                                    <option value="agent_2" {{ session('form.step_1.referral_agent') == 'agent_2' ? 'selected' : '' }}>Agent 2</option>
                                    <option value="agent_3" {{ session('form.step_1.referral_agent') == 'agent_3' ? 'selected' : '' }}>Agent 3</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="interested_country" class="font-weight-bold text-dark" style="font-size: 14px;">Interested Country</label>
                                <select id="interested_country" name="interested_country" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="saudi_arabia" {{ session('form.step_1.interested_country') == 'saudi_arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                                    <option value="uae" {{ session('form.step_1.interested_country') == 'uae' ? 'selected' : '' }}>UAE</option>
                                    <option value="malaysia" {{ session('form.step_1.interested_country') == 'malaysia' ? 'selected' : '' }}>Malaysia</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="interested_profession" class="font-weight-bold text-dark" style="font-size: 14px;">Interested Profession</label>
                                <select id="interested_profession" name="interested_profession" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="driver" {{ session('form.step_1.interested_profession') == 'driver' ? 'selected' : '' }}>Driver</option>
                                    <option value="electrician" {{ session('form.step_1.interested_profession') == 'electrician' ? 'selected' : '' }}>Electrician</option>
                                    <option value="cleaner" {{ session('form.step_1.interested_profession') == 'cleaner' ? 'selected' : '' }}>Cleaner</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="nationality" class="font-weight-bold text-dark" style="font-size: 14px;">Nationality</label>
                                <input type="text" id="nationality" name="nationality" class="form-control" value="{{ session('form.step_1.nationality') ?? 'Bangladeshi' }}">
                            </div>
                        </div>
                    @elseif($step == 2)
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="first_name" class="font-weight-bold text-dark" style="font-size: 14px;">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="{{ session('form.step_2.first_name') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="last_name" class="font-weight-bold text-dark" style="font-size: 14px;">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="{{ session('form.step_2.last_name') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="gender" class="font-weight-bold text-dark" style="font-size: 14px;">Gender</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="male" {{ session('form.step_2.gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ session('form.step_2.gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="others" {{ session('form.step_2.gender') == 'others' ? 'selected' : '' }}>Others</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="dob" class="font-weight-bold text-dark" style="font-size: 14px;">Date of birth</label>
                                <input type="text" id="dob" name="dob" class="form-control" placeholder="Date of birth" value="{{ session('form.step_2.dob') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="email" class="font-weight-bold text-dark" style="font-size: 14px;">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ session('form.step_2.email') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="phone_number" class="font-weight-bold text-dark" style="font-size: 14px;">Phone Number</label>
                                <input type="number" id="phone_number" name="phone_number" class="form-control" placeholder="Phone Number" value="{{ session('form.step_2.phone_number') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="contact_person_number" class="font-weight-bold text-dark" style="font-size: 14px;">Contact Person Number</label>
                                <input type="number" id="contact_person_number" name="contact_person_number" class="form-control" placeholder="Contact Person Number" value="{{ session('form.step_2.contact_person_number') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="nid_or_birth_certificate" class="font-weight-bold text-dark" style="font-size: 14px;">NID / Birth Certificate</label>
                                <input type="text" id="nid_or_birth_certificate" name="nid_or_birth_certificate" class="form-control" placeholder="NID / Birth Certificate" value="{{ session('form.step_2.nid_or_birth_certificate') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="father_name" class="font-weight-bold text-dark" style="font-size: 14px;">Father Name</label>
                                <input type="text" id="father_name" name="father_name" class="form-control" placeholder="Father Name" value="{{ session('form.step_2.father_name') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="mother_name" class="font-weight-bold text-dark" style="font-size: 14px;">Mother Name</label>
                                <input type="text" id="mother_name" name="mother_name" class="form-control" placeholder="Mother Name" value="{{ session('form.step_2.mother_name') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="marital_status" class="font-weight-bold text-dark" style="font-size: 14px;">Marital status</label>
                                <select id="marital_status" name="marital_status" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="single" {{ session('form.step_2.marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                                    <option value="married" {{ session('form.step_2.marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="spouse_name" class="font-weight-bold text-dark" style="font-size: 14px;">Spouse Name</label>
                                <input type="text" id="spouse_name" name="spouse_name" class="form-control" placeholder="Spouse Name" value="{{ session('form.step_2.spouse_name') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="nominee_name" class="font-weight-bold text-dark" style="font-size: 14px;">Nominee Name</label>
                                <input type="text" id="nominee_name" name="nominee_name" class="form-control" placeholder="Nominee Name" value="{{ session('form.step_2.nominee_name') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="relation_with_nominee" class="font-weight-bold text-dark" style="font-size: 14px;">Relation With Nominee</label>
                                <select id="relation_with_nominee" name="relation_with_nominee" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="father" {{ session('form.step_2.relation_with_nominee') == 'father' ? 'selected' : '' }}>Father</option>
                                    <option value="mother" {{ session('form.step_2.relation_with_nominee') == 'mother' ? 'selected' : '' }}>Mother</option>
                                    <option value="brother" {{ session('form.step_2.relation_with_nominee') == 'brother' ? 'selected' : '' }}>Brother</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="religion" class="font-weight-bold text-dark" style="font-size: 14px;">Religion</label>
                                <select id="religion" name="religion" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="islam" {{ session('form.step_2.religion') == 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="hinduism" {{ session('form.step_2.religion') == 'hinduism' ? 'selected' : '' }}>Hinduism</option>
                                    <option value="christianity" {{ session('form.step_2.religion') == 'christianity' ? 'selected' : '' }}>Christianity</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="blood_group" class="font-weight-bold text-dark" style="font-size: 14px;">Blood group</label>
                                <select id="blood_group" name="blood_group" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="a+" {{ session('form.step_2.blood_group') == 'a+' ? 'selected' : '' }}>A+</option>
                                    <option value="a-" {{ session('form.step_2.blood_group') == 'a-' ? 'selected' : '' }}>A-</option>
                                    <option value="b+" {{ session('form.step_2.blood_group') == 'b+' ? 'selected' : '' }}>B+</option>
                                    <option value="b-" {{ session('form.step_2.blood_group') == 'b-' ? 'selected' : '' }}>B-</option>
                                    <option value="o+" {{ session('form.step_2.blood_group') == '0+' ? 'selected' : '' }}>O+</option>
                                    <option value="o-" {{ session('form.step_2.blood_group') == '0-' ? 'selected' : '' }}>O-</option>
                                    <option value="ab+" {{ session('form.step_2.blood_group') == 'ab+' ? 'selected' : '' }}>AB+</option>
                                    <option value="ab-" {{ session('form.step_2.blood_group') == 'ab-' ? 'selected' : '' }}>AB-</option>
                                    <option value="none" {{ session('form.step_2.blood_group') == 'none' ? 'selected' : '' }}>N/A</option>
                                    <option value="unknown" {{ session('form.step_2.blood_group') == 'unknown' ? 'selected' : '' }}>Unknown</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="note" class="font-weight-bold text-dark" style="font-size: 14px;">Note</label>
                                <textarea id="note" name="note" class="form-control" placeholder="Note" rows="2">{{ session('form.step_2.note') }}</textarea>
                            </div>
                        </div>
                    @elseif($step == 3)
                        <div class="row form-group col-md-3">
                            <label for="experience_type" class="font-weight-bold text-dark" style="font-size: 14px;">Experience Type</label>
                            <select id="experience_type" name="experience_type" class="form-control">
                                <option value="" disabled selected>--Select One--</option>
                                <option value="fresher" {{ session('form.step_3.experience_type') == 'fresher' ? 'selected' : '' }}>Fresher</option>
                                <option value="experianced" {{ session('form.step_3.experience_type') == 'experianced' ? 'selected' : '' }}>Experianced</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="company_name" class="font-weight-bold text-dark" style="font-size: 14px;">Company Name</label>
                                <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Company Name" value="{{ session('form.step_3.company_name') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="work_type" class="font-weight-bold text-dark" style="font-size: 14px;">Work Type</label>
                                <select id="work_type" name="work_type" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="work_type_1" {{ session('form.step_3.work_type') == 'work_type_1' ? 'selected' : '' }}>Work Type 1</option>
                                    <option value="work_type_2" {{ session('form.step_3.work_type') == 'work_type_2' ? 'selected' : '' }}>Work Type 2</option>
                                    <option value="work_type_3" {{ session('form.step_3.work_type') == 'work_type_3' ? 'selected' : '' }}>Work Type 3</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="departure_date" class="font-weight-bold text-dark" style="font-size: 14px;">Departure Date</label>
                                <input type="text" id="departure_date" name="departure_date" class="form-control" placeholder="Departure Date" value="{{ session('form.step_3.departure_date') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="arrival_date" class="font-weight-bold text-dark" style="font-size: 14px;">Arrival Date</label>
                                <input type="text" id="arrival_date" name="arrival_date" class="form-control" placeholder="Arrival Date" value="{{ session('form.step_3.arrival_date') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="departure_seal" class="font-weight-bold text-dark" style="font-size: 14px;">Departure Seal</label>
                                <input type="file" id="departure_seal" name="departure_seal" class="form-control" accept="image/*">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="arrival_seal" class="font-weight-bold text-dark" style="font-size: 14px;">Arrival Seal</label>
                                <input type="file" id="arrival_seal" name="arrival_seal" class="form-control" accept="image/*">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="travelled_country" class="font-weight-bold text-dark" style="font-size: 14px;">Travelled Country</label>
                                <select id="travelled_country" name="travelled_country" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="andorra" {{ session('form.step_3.travelled_country') == 'andorra' ? 'selected' : '' }}>Andorra</option>
                                    <option value="angola" {{ session('form.step_3.travelled_country') == 'angola' ? 'selected' : '' }}>Angola</option>
                                    <option value="albania" {{ session('form.step_3.travelled_country') == 'albania' ? 'selected' : '' }}>Albania</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="old_company_address" class="font-weight-bold text-dark" style="font-size: 14px;">Old Company Address</label>
                                <textarea id="old_company_address" name="old_company_address" class="form-control" placeholder="Old Company Address" rows="2">{{ session('form.step_3.old_company_address') }}</textarea>
                            </div>
                        </div>
                    @elseif($step == 4)
                        <div class="row form-group col-md-3">
                            <label for="passport_type" class="font-weight-bold text-dark" style="font-size: 14px;">Passport Type</label>
                            <select id="passport_type" name="passport_type" class="form-control">
                                <option value="" disabled selected>--Select One--</option>
                                <option value="no_passport" {{ session('form.step_4.passport_type') == 'no_passport' ? 'selected' : '' }}>NoPassport</option>
                                <option value="ordinary" {{ session('form.step_4.passport_type') == 'ordinary' ? 'selected' : '' }}>Ordinary</option>
                                <option value="official" {{ session('form.step_4.passport_type') == 'official' ? 'selected' : '' }}>Official</option>
                                <option value="diplomatic" {{ session('form.step_4.passport_type') == 'diplomatic' ? 'selected' : '' }}>Diplomatic</option>
                                <option value="special" {{ session('form.step_4.passport_type') == 'special' ? 'selected' : '' }}>Special</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="passport_number" class="font-weight-bold text-dark" style="font-size: 14px;">Passport Number</label>
                                <input type="text" id="passport_number" name="passport_number" class="form-control" placeholder="Passport Number" value="{{ session('form.step_4.passport_number') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="passport_issue_date" class="font-weight-bold text-dark" style="font-size: 14px;">Passport Issue Date</label>
                                <input type="text" id="passport_issue_date" name="passport_issue_date" class="form-control" placeholder="Passport Issue Date" value="{{ session('form.step_4.passport_issue_date') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="passport_expired_date" class="font-weight-bold text-dark" style="font-size: 14px;">Passport Expired Date</label>
                                <input type="text" id="passport_expired_date" name="passport_expired_date" class="form-control" placeholder="Passport Expired Date" value="{{ session('form.step_4.passport_expired_date') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="passport_issue_place" class="font-weight-bold text-dark" style="font-size: 14px;">Passport Issue Place</label>
                                <select id="passport_issue_place" name="passport_issue_place" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="dhaka" {{ session('form.step_4.passport_issue_place') == 'dhaka' ? 'selected' : '' }}>Dhaka</option>
                                    <option value="barisal" {{ session('form.step_4.passport_issue_place') == 'barisal' ? 'selected' : '' }}>Barisal</option>
                                    <option value="bhola" {{ session('form.step_4.passport_issue_place') == 'bhola' ? 'selected' : '' }}>Bhola</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="validity_year" class="font-weight-bold text-dark" style="font-size: 14px;">Validity Year</label>
                                <select id="validity_year" name="validity_year" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="5" {{ session('form.step_4.validity_year') == '5' ? 'selected' : '' }}>5 Years</option>
                                    <option value="10" {{ session('form.step_4.validity_year') == '10' ? 'selected' : '' }}>10 Years</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="passport_scan_copy" class="font-weight-bold text-dark" style="font-size: 14px;">Passport Scan Copy</label>
                                <input type="file" id="passport_scan_copy" name="passport_scan_copy" class="form-control" accept="image/*">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="note" class="font-weight-bold text-dark" style="font-size: 14px;">Note</label>
                                <textarea id="note" name="note" class="form-control" placeholder="Note" rows="2">{{ session('form.step_4.note') }}</textarea>
                            </div>
                        </div>
                    @elseif($step == 5)
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="country" class="font-weight-bold text-dark" style="font-size: 14px;">Country</label>
                                <select id="country" name="country" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="afghanistan" {{ session('form.step_5.country') == 'afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                    <option value="albania" {{ session('form.step_5.country') == 'albania' ? 'selected' : '' }}>Albania</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="division" class="font-weight-bold text-dark" style="font-size: 14px;">Division</label>
                                <select id="division" name="division" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="dhaka" {{ session('form.step_5.division') == 'dhaka' ? 'selected' : '' }}>Dhaka</option>
                                    <option value="chittagong" {{ session('form.step_5.division') == 'chittagong' ? 'selected' : '' }}>Chittagong</option>
                                    <option value="rajshahi" {{ session('form.step_5.division') == 'rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="district" class="font-weight-bold text-dark" style="font-size: 14px;">District</label>
                                <select id="district" name="district" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="dhaka" {{ session('form.step_5.district') == 'dhaka' ? 'selected' : '' }}>Dhaka</option>
                                    <option value="gazipur" {{ session('form.step_5.district') == 'gazipur' ? 'selected' : '' }}>Gazipur</option>
                                    <option value="cumilla" {{ session('form.step_5.district') == 'cumilla' ? 'selected' : '' }}>Cumilla</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="thana" class="font-weight-bold text-dark" style="font-size: 14px;">Thana</label>
                                <select id="thana" name="thana" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="uttara" {{ session('form.step_5.thana') == 'uttara' ? 'selected' : '' }}>Uttara</option>
                                    <option value="mirpur" {{ session('form.step_5.thana') == 'mirpur' ? 'selected' : '' }}>Mirpur</option>
                                    <option value="motijheel" {{ session('form.step_5.thana') == 'motijheel' ? 'selected' : '' }}>Motijheel</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="post_office" class="font-weight-bold text-dark" style="font-size: 14px;">Post Office</label>
                                <select id="post_office" name="post_office" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="uttara_po" {{ session('form.step_5.post_office') == 'uttara_po' ? 'selected' : '' }}>Uttara PO</option>
                                    <option value="mirpur_po" {{ session('form.step_5.post_office') == 'mirpur_po' ? 'selected' : '' }}>Mirpur PO</option>
                                    <option value="dhanmondi_po" {{ session('form.step_5.post_office') == 'dhanmondi_po' ? 'selected' : '' }}>Dhanmondi PO</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="state" class="font-weight-bold text-dark" style="font-size: 14px;">State</label>
                                <select id="state" name="state" class="form-control">
                                    <option value="">--Select One--</option>
                                    <option value="bangladesh" {{ session('form.step_5.state') == 'bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                    <option value="india" {{ session('form.step_5.state') == 'india' ? 'selected' : '' }}>India</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="current_address" class="font-weight-bold text-dark" style="font-size: 14px;">Current Address</label>
                                <textarea id="current_address" name="current_address" class="form-control" placeholder="Current Address" rows="2">{{ session('form.step_5.current_address') }}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="permanent_address" class="font-weight-bold text-dark" style="font-size: 14px;">Permanent Address</label>
                                <textarea id="permanent_address" name="permanent_address" class="form-control" placeholder="Permanent Address" rows="2">{{ session('form.step_5.permanent_address') }}</textarea>
                            </div>
                        </div>
                    @elseif($step == 6)
                        <div class="mb-3">
                            <label>Upload CV (optional)</label>
                            <input type="file" name="cv" class="form-control">
                        </div>
                    @elseif($step == 7)
                        <div class="mb-3">
                            <h5>Review Your Information</h5>
                            <ul class="list-group">
                                @for ($i = 1; $i <= 6; $i++)
                                    @foreach(session("form.step_$i", []) as $key => $value)
                                        <li class="list-group-item">
                                            <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}
                                        </li>
                                    @endforeach
                                @endfor
                            </ul>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        @if($step > 1)
                            <a href="{{ route('admin.candidates.create', ['step' => $step - 1]) }}" class="btn btn-secondary">Previous</a>
                        @else
                            <div></div>
                        @endif

                        <button type="submit" class="btn btn-primary">
                            {{ $step < 7 ? 'Next' : 'Submit' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script></script>
@endsection
