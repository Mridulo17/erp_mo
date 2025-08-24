<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket\AssignTicket;
use App\Models\Admin\Ticket\AssignTicketCandidate;
use App\Models\Admin\Ticket\Ticket;
use App\Models\Admin\Ticket\TicketCandidate;
use Illuminate\Http\Request;

class AssignTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = AssignTicket::get();
        return view('backend.pages.ticket.assign_ticket', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'ticket_id'      => 'required|integer'
                ]);

            $ticket = Ticket::where('id', $request->ticket_id)->first();

            $assignTicket = AssignTicket::create([
                'ticket_id'      => $request->input('ticket_id'),
                'ticket_type'  => $ticket->ticket_type,
                'pnr_number'  => $ticket->pnr_number,
                'total_candidate'  => $ticket->total_candidate,
                'note'  => $request->input('note')
            ]);

            if ($request->only('candidate_id')) {
                $data = [];
                foreach ($request->candidate_id as $key => $row) {
                    $data[] = [
                        'assign_ticket_id' => $assignTicket->id,
                        'candidate_id' => $request->candidate_id[$key],
                        'created_at' => now(),
                    ];
                }
                AssignTicketCandidate::insert($data);
            }
            if ($request->is_complete_assigned == '1') {
                $ticket->update(['is_assigned' => '1']);
            }

            return response()->json(['status' => 'success', 'message' => 'Ticket assigned Successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'fail', 'message' => $e->validator->errors()]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignTicket $assignTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $assignTicket = AssignTicket::with(['ticket','ticket.country', 'assignTicketCandidates' , 'assignTicketCandidates.candidate.personalInfo', 'assignTicketCandidates.candidate.candidateType'])->findOrFail($id);
        return response()->json($assignTicket);
    }

    public function candidateInfoByID(string $id)
    {
        $assignTicketCandidate = AssignTicketCandidate::with(['assignTicket.ticket','assignTicket.ticket.country','assignTicket.ticket.airlineOffice','assignTicket.ticket.user', 'candidate' , 'candidate.personalInfo', 'candidate.personalInfo.gender','candidate.personalInfo.religion', 'candidate.personalInfo.bloodGroup', 'candidate.personalInfo.nomineeRelation',  'candidate.candidateType','candidate.country',  'candidate.experiences', 'candidate.experiences.workType', 'candidate.experiences.travelledCountry', 'candidate.passport', 'candidate.passport.issuePlace', 'candidate.location','candidate.location.country','candidate.location.division','candidate.location.district','candidate.location.thana', 'candidate.location.postOffice', 'candidate.location.state', 'candidate.profession','candidate.files', 'candidate.agent'])->findOrFail($id);
        return response()->json($assignTicketCandidate);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssignTicket $assignTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignTicket $assignTicket)
    {
        //
    }
}
