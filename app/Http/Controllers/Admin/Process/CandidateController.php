<?php

namespace App\Http\Controllers\Admin\Process;

use App\Traits\FileUpload;
use App\Models\Admin\Gender;
use Illuminate\Http\Request;
use App\Models\Admin\Relation;
use App\Models\Admin\Religion;
use App\Models\Admin\BloodGroup;
use App\Models\Admin\Profession;
use App\Models\Admin\People\Agent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CandidateRequest;
use App\Models\Admin\Process\Candidate;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\CandidateFileRequest;
use App\Models\Admin\Process\CandidateFile;
use App\Models\Admin\Process\CandidateType;
use App\Models\Supper_Admin\Location\State;
use App\Models\Supper_Admin\Location\Thana;
use App\Models\Supper_Admin\Location\Country;
use App\Models\Supper_Admin\Location\District;
use App\Models\Supper_Admin\Location\Division;
use App\Http\Requests\CandidateLocationRequest;
use App\Http\Requests\CandidatePassportRequest;
use App\Models\Admin\Process\CandidateLocation;
use App\Models\Admin\Process\CandidatePassport;
use App\Models\Supper_Admin\Location\PostOffice;
use App\Http\Requests\CandidateExperienceRequest;
use App\Models\Admin\Process\CandidateExperience;
use App\Http\Requests\CandidatePersonalInfoRequest;
use App\Models\Admin\Process\CandidatePersonalInfo;

class CandidateController extends Controller
{
    use FileUpload;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Candidate::with(['agent', 'personalInfo', 'personalInfo.gender', 'experiences', 'experiences.workType', 'passport',]);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->personalInfo?->full_name ?? '';
                })
                ->addColumn('agent', function($row) {
                    return $row->agent?->full_name ?? '';
                })
                ->addColumn('age_gender', function ($row) {
                    $age = $row->personalInfo?->age . 'y';
                    $gender = $row->personalInfo?->gender?->name;
                    return $age . ($gender ? " - {$gender}" : '');
                })
                ->addColumn('nid', function ($row) {
                    return $row->personalInfo?->nid_or_birth_certificate ?? '';
                })
                ->addColumn('passport', function ($row) {
                    return $row->passport?->passport_number ?? '';
                })
                ->addColumn('passport_validity', function($row) {
                    return $row->passport?->passportValidity ?? '';
                })
                ->addColumn('interested_country', function ($row) {
                    return $row->country?->name ?? '';
                })
                ->addColumn('interested_profession', function ($row) {
                    return $row->profession?->name ?? '';
                })
                ->addColumn('status', function ($row) {
                    return $row->status === 1
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    return '
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown">
                            <i class="fa fa-bars"></i> Action
                        </button>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item editAgentButton" data-id="' . $row->id . '">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <button class="dropdown-item text-danger deleteagentBtn" data-id="' . $row->id . '">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.pages.process.candidates.index');
    }

    public function activeIndex()
    {
        $candidates = Candidate::whereHas('candidateType', function ($query) {
            $query->select('id', 'name')->where('status', 1);
        })->with([
            'candidateType' => function ($query) {
                $query->select('id', 'name');
            },
            'personalInfo' => function ($query) {
                $query->select('candidate_id', 'first_name', 'last_name');
            }
        ])->get();

        return response()->json($candidates);

    }

    public function create(Request $request, $step = 1)
    {
        $candidateTypes = CandidateType::where('status', 1)->pluck('name', 'id');
        $agents = Agent::where('status', 1)->get()->pluck('full_name', 'id');
        $countries = Country::where('status', 1)->pluck('name', 'id');
        $professions = Profession::where('status', 1)->pluck('name', 'id');

        return view('backend.pages.process.candidates.create', compact('step', 'candidateTypes', 'agents', 'countries', 'professions'));
    }

    public function store(Request $request)
    {
        $step = (int) $request->input('step', 1);
        $isPrev = $request->has('prev');

        // Step-wise validation
        if (!$isPrev) {
            if ($step == 1) {
                app(CandidateRequest::class);
            } elseif ($step == 2) {
                app(CandidatePersonalInfoRequest::class);
            } elseif ($step == 3) {
                app(CandidateExperienceRequest::class);
            } elseif ($step == 4) {
                app(CandidatePassportRequest::class);
            } elseif ($step == 5) {
                app(CandidateLocationRequest::class);
            } elseif ($step == 6) {
                app(CandidateFileRequest::class);
            }
        }

        if ($isPrev) {
            $step = max(1, $step); // Prevent step below 1
        } else {
            $data = $request->except([
                '_token', 'step', 'prev',
                'departure_seal', 'arrival_seal',
                'passport_scan_copy', 'file_path'
            ]);

            if ($step == 3) {
                if ($request->hasFile('departure_seal')) {
                    $data['departure_seal'] = $this->uploadFile('candidate', $request->file('departure_seal'), 'candidate/departure_seal');
                }

                if ($request->hasFile('arrival_seal')) {
                    $data['arrival_seal'] = $this->uploadFile('candidate', $request->file('arrival_seal'), 'candidate/arrival_seal');
                }
            }

            if ($step == 4) {
                if ($request->hasFile('passport_scan_copy')) {
                    $data['passport_scan_copy'] = $this->uploadFile('candidate', $request->file('passport_scan_copy'), 'candidate/passport_scan_copy');
                }
            }

            if ($step == 6) {
                if ($request->hasFile('file_path')) {
                    $data['file_path'] = $this->uploadFile('candidate', $request->file('file_path'), 'candidate/files');
                }
            }

            // Save this step’s data into session
            session()->put("form.step_$step", $data);

            // Final submission
            if ($step == 7) {
                DB::beginTransaction();
                try {
                    $formData = [
                        'step_1' => session('form.step_1', []),
                        'step_2' => session('form.step_2', []),
                        'step_3' => session('form.step_3', []),
                        'step_4' => session('form.step_4', []),
                        'step_5' => session('form.step_5', []),
                        'step_6' => session('form.step_6', []),
                    ];

                    $step1 = $formData['step_1'];
                    $step2 = $formData['step_2'];
                    $step3 = $formData['step_3'];
                    $step4 = $formData['step_4'];
                    $step5 = $formData['step_5'];
                    $step6 = $formData['step_6'];

                    // Step 1 → Create Candidate
                    $candidate = Candidate::create($step1);

                    // Step 2 → Personal Info
                    CandidatePersonalInfo::create(array_merge($step2, [
                        'candidate_id' => $candidate->id,
                    ]));

                    // Step 3 → Experience
                    CandidateExperience::create(array_merge($step3, [
                        'candidate_id' => $candidate->id,
                    ]));

                    // Step 4 → Passport
                    CandidatePassport::create(array_merge($step4, [
                        'candidate_id' => $candidate->id,
                    ]));

                    // Step 5 → Location
                    CandidateLocation::create(array_merge($step5, [
                        'candidate_id' => $candidate->id,
                    ]));

                    // Step 6 → Files
                    CandidateFile::create(array_merge($step6, [
                        'candidate_id' => $candidate->id,
                    ]));

                    DB::commit();

                    // Clear session
                    session()->forget('form');

                    return response()->json([
                        'success' => true,
                        'redirect' => route('admin.candidates.index'),
                    ]);
                } catch (\Exception $e) {
                    DB::rollBack();

                    // Optional: log the error
                    Log::error('Candidate creation failed: ' . $e->getMessage());

                    return response()->json([
                        'success' => false,
                        'message' => 'Something went wrong. Please try again.',
                        'error' => $e->getMessage()
                    ], 500);
                }
            }

            // Go to next step
            $step++;
        }

        // Prepare data for next step view
        $data = ['step' => $step];

        // Add required step-wise select options
        if ($step == 1) {
            $data['candidateTypes'] = CandidateType::where('status', 1)->pluck('name', 'id');
            $data['agents'] = Agent::where('status', 1)->get()->pluck('full_name', 'id');
            $data['countries'] = Country::where('status', 1)->pluck('name', 'id');
            $data['professions'] = Profession::where('status', 1)->pluck('name', 'id');
        } elseif ($step == 2) {
            $data['genders'] = Gender::where('status', 1)->pluck('name', 'id');
            $data['relations'] = Relation::where('status', 1)->pluck('name', 'id');
            $data['religions'] = Religion::where('status', 1)->pluck('name', 'id');
            $data['bloodGroups'] = BloodGroup::where('status', 1)->pluck('name', 'id');
        } elseif ($step == 3) {
            $data['workTypes'] = Profession::where('status', 1)->pluck('name', 'id');
            $data['travelledCountries'] = Country::where('status', 1)->pluck('name', 'id');
        } elseif ($step == 4) {
            $data['passportIssuePlaces'] = District::where('status', 1)->pluck('name', 'id');
        } elseif ($step == 5) {
            $data['countries'] = Country::where('status', 1)->pluck('name', 'id');
            $data['divisions'] = Division::where('status', 1)->pluck('name', 'id');
            $data['districts'] = District::where('status', 1)->pluck('name', 'id');
            $data['thanas'] = Thana::where('status', 1)->pluck('name', 'id');
            $data['postOffices'] = PostOffice::where('status', 1)->pluck('name', 'id');
            $data['states'] = State::where('status', 1)->pluck('name', 'id');
        }

        // Render next form step
        $html = view('backend.pages.process.candidates.partials.form', $data)->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'step' => $step
        ]);
    }

    public function show(Candidate $candidate)
    {
        //
    }

    public function edit(Candidate $candidate)
    {
        //
    }

    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    public function destroy(Candidate $candidate)
    {
        //
    }
}
