<div class="row">
    <div class="col-md-3">
        <div class="image_area">
            <form method="post">
                <label for="upload_image">
                    <img 
                        src="http://erp.mahfuza-overseas.com/mahfuza_v2/assets/uploads/documents/candidate/2025_07_19_05_00_17_pm__32db70e1de36463cf18592626fc89311.png" 
                        id="uploaded_image" 
                        class="img-responsive img-circle"
                    >
                    <div class="overlay">
                        <div class="text">Click to Change Profile Picture</div>
                    </div>
                    <input 
                        type="file" 
                        name="image" 
                        class="image" 
                        id="upload_image" 
                        accept="image/*" 
                        style="display:none"
                    >
                </label>
            </form>
        </div>
    </div>

    <div class="col-md-9">
        <b><u>Personal Information:</u></b>
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td style="width: 180px;">First name</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->first_name ?? '' }}</b></td>

                    <td style="width: 180px;">Last name</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->last_name ?? '' }}</b></td>
                </tr>
                <tr>
                    <td style="width: 180px;">Gender</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->gender?->name ?? '' }}</b></td>

                    <td style="width: 180px;">Date of birth</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;">
                        <b>
                            {{ $candidate->personalInfo?->date_of_birth 
                                ? \Carbon\Carbon::parse($candidate->personalInfo->date_of_birth)->format('d-m-Y') 
                                : '' 
                            }}
                        </b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;">Email</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->email ?? '' }}</b></td>

                    <td style="width: 180px;">Phone number</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->phone_number ?? '' }}</b></td>
                </tr>
                <tr>
                    <td style="width: 180px;">Contact person number</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->contact_person_number ?? '' }}</b></td>

                    <td style="width: 180px;">NID / Birth certificate</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->nid_or_birth_certificate ?? '' }}</b></td>
                </tr>
                <tr>
                    <td style="width: 180px;">Father name</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->father_name ?? '' }}</b></td>

                    <td style="width: 180px;">Mother name</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->mother_name ?? '' }}</b></td>
                </tr>
                <tr>
                    <td style="width: 180px;">Marital status</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->marital_status ?? '' }}</b></td>

                    <td style="width: 180px;">Spouse name</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->spouse_name ?? '' }}</b></td>
                </tr>
                <tr>
                    <td style="width: 180px;">Nominee name</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->nominee_name ?? '' }}</b></td>

                    <td style="width: 180px;">Relation with nominee</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->nomineeRelation?->name ?? '' }}</b></td>
                </tr>
                <tr>
                    <td style="width: 180px;">Religion</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->religion?->name ?? '' }}</b></td>

                    <td style="width: 180px;">Blood group</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->personalInfo?->bloodGroup?->name ?? '' }}</b></td>
                </tr>
                <tr>
                    <td style="width: 180px;">Note</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="4">
                        <b>{{ $candidate->personalInfo?->note ?? '' }}</b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <b><u>Basic Information:</u></b>
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td style="width: 180px;">Candidate Type</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="4"><b>{{ $candidate->candidateType?->name ?? '' }}</b></td>									
                </tr>

                <tr>									
                    <td style="width: 180px;">Interested Country</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->country?->name ?? '' }}</b></td>

                    <td style="width: 180px;">Interested Job</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->profession?->name ?? '' }}</b></td>
                </tr>

                <tr>									
                    <td style="width: 180px;">Process Country</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->processCountry?->name ?? 'N/A' }}</b></td>

                    <td style="width: 180px;">Process Job</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->processProfession?->name ?? 'N/A' }}</b></td>
                </tr>

                <tr>
                    <td style="width: 180px;">Referral Agent</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->agent?->full_name ?? '' }}</b></td>

                    <td style="width: 180px;">Nationality</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->nationality ?? '' }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <b><u>Experience Information:</u></b>
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td style="width: 180px;">Experience Type</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="4"><b>{{ $candidate->experiences?->experience_type ?? '' }}</b></td>									
                </tr>

                <tr>									
                    <td style="width: 180px;">Company Name</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->experiences?->company_name ?? '' }}</b></td>

                    <td style="width: 180px;">Work Type</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>{{ $candidate->experiences?->workType?->name ?? '' }}</b></td>
                </tr>

                <tr>									
                    <td style="width: 180px;">Departure Date</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;">
                        <b>
                            {{ $candidate->experiences?->departure_date 
                                ? \Carbon\Carbon::parse($candidate->experiences->departure_date)->format('d-m-Y') 
                                : '' 
                            }}
                        </b>
                    </td>

                    <td style="width: 180px;">Arrival Date</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;">
                        <b>
                            {{ $candidate->experiences?->arrival_date 
                                ? \Carbon\Carbon::parse($candidate->experiences->arrival_date)->format('d-m-Y') 
                                : '' 
                            }}
                        </b>
                    </td>
                </tr>

                <tr>
                    <td style="width: 180px;">Departure Seal</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;">
                        <b>
                            <a href="{{ asset($candidate->experiences->departure_seal) }}" target="_blank" title="Click to view files">
                                <i class="fa fa-eye"></i>
                            </a>
                        </b>
                    </td>

                    <td style="width: 180px;">Arrival Seal</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;">
                        <b>
                            <a href="{{ asset($candidate->experiences->arrival_seal) }}" target="_blank" title="Click to view files">
                                <i class="fa fa-eye"></i>
                            </a>
                        </b>
                    </td>
                </tr>

                <tr>
                    <td style="width: 180px;">Old Company Address</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="4"><b>{{ $candidate->experiences?->old_company_address ?? '' }}</b></td>									
                </tr>

                <tr>
                    <td style="width: 180px;">Travelled Country</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="4"><b>{{ $candidate->experiences?->travelled_country_id ?? '' }}</b></td>									
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <b><u>Passport Information:</u></b>
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td style="width: 180px;">Passport Number</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>A17326489</b></td>
                    
                    <td style="width: 180px;">Passport Issue Date</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>2024-12-26</b></td>
                </tr>
                <tr>
                    <td style="width: 180px;">Passport Issue Place</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>Bangladesh - Dhaka - Dhaka</b></td>

                    <td style="width: 180px;">Validity Year</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>10 Years</b></td>
                </tr>
                <tr>
                    <td style="width: 180px;">Passport Scan Copy</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;">
                        <b>
                            <a href="http://erp.mahfuza-overseas.com/mahfuza_v2/assets/uploads/documents/candidate/files_2025_05_20_2304860949747314357.jpg"
                               target="_blank"
                               title="Click to view files">
                                <i class="fa fa-eye"></i>
                            </a>
                        </b>
                    </td>

                    <td style="width: 180px;">Note</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>NA</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <b class="d-block mb-2"><u>Location Information:</u></b>
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td style="width: 180px;">Country</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>Bangladesh</b></td>
                    <td style="width: 180px;">Division</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>Dhaka</b></td>
                </tr>
                <tr>
                    <td style="width: 180px;">District</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>Narsingdi</b></td>
                    <td style="width: 180px;">Thana</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>Shibpur</b></td>
                </tr>
                <tr>
                    <td style="width: 180px;">Post Office</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>Joynagar</b></td>
                    <td style="width: 180px;">State</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b></b></td>
                </tr>
                <tr>
                    <td style="width: 180px;">Current Address</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="4"><b>Joynagar, Shibpur, Joynagar-1630, Narsingdi</b></td>
                </tr>
                <tr>
                    <td style="width: 180px;">Permanent Address</td>
                    <td style="width: 10px;">:</td>
                    <td colspan="4"><b>Same as current address</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <b><u>Candidate Related All Files</u></b>
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td style="width: 180px;">Candidate Photo</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;">
                        <a href="http://erp.mahfuza-overseas.com/mahfuza_v2/assets/uploads/documents/candidate/2025_07_19_05_00_17_pm__32db70e1de36463cf18592626fc89311.png" target="_blank">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;">Departure Seal</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;">
                        <a href="http://erp.mahfuza-overseas.com/mahfuza_v2/assets/uploads/documents/candidate/files_2025_07_19_614565171593462580.png" target="_blank">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;">Arrival Seal</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;">
                        <a href="http://erp.mahfuza-overseas.com/mahfuza_v2/assets/uploads/documents/candidate/files_2025_07_19_683312559148126165.png" target="_blank">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="width: 180px;">Passport Scan Copy</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;">
                        <a href="http://erp.mahfuza-overseas.com/mahfuza_v2/assets/uploads/documents/candidate/files_2025_05_20_2304860949747314357.jpg" target="_blank">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-md-6">
        <b><u>Document Information:</u></b>
        <table class="table table-sm">
            <tbody>
                <tr>									
                    <td style="width: 180px;">Candidate Photo</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;">
                        <b>
                            <a href="#" title="Click to view file" target="_blank" class="mr-5">
                                <i class="fa fa-file"></i>
                            </a>
                        </b>
                    </td>									
                </tr>
                <tr>									
                    <td style="width: 180px;">Police Verification</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>N/A</b></td>									
                </tr>
                <tr>
                    <td style="width: 180px;">Other Certification</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>N/A</b></td>									
                </tr>
                <tr>
                    <td style="width: 180px;">Optional File/Files</td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 250px;"><b>N/A</b></td>									
                </tr>								
            </tbody>
        </table>
    </div>
</div>
