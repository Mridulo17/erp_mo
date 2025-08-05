<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket\Ticket;
use App\Models\Admin\Ticket\TicketCandidate;
use App\Models\Supper_Admin\Sponsor\Visa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::get();
        return view('backend.pages.ticket.ticket', compact('tickets'));
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
                'ticket_name'      => 'required',
                'issue_date'      => 'required',
                'source'      => 'required',
                'country_id'      => 'required|integer',
                'ticket_type'      => 'required',
                'candidate_type_id'      => 'required|integer',
                'airline_office_id'      => 'required|integer',
                'pnr_number'      => 'required',
                'flight_date'      => 'required',
                'flight_time'      => 'required',
                'flight_number'      => 'required',
                'attachment' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:10240', // 10MB max
            ]);

            $attachmentPath = null;

            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')->store('tickets', 'public');
            }

            $ticket = Ticket::create([
                'ticket_name'      => $request->input('ticket_name'),
                'issue_date'  => $request->input('issue_date'),
                'source'  => $request->input('source'),
                'country_id'  => $request->input('country_id'),
                'ticket_type'  => $request->input('ticket_type'),
                'candidate_type_id'  => $request->input('candidate_type_id'),
                'airline_office_id'  => $request->input('airline_office_id'),
                'other_office_id'  => $request->input('other_office_id'),
                'is_pre_purchase'  => $request->input('is_pre_purchase') === '1' ? '1' : '0',
                'pnr_number'  => $request->input('pnr_number'),
                'flight_date'  => $request->input('flight_date'),
                'flight_time'  => $request->input('flight_time'),
                'flight_number'  => $request->input('flight_number'),
                'purchase_payment_type'  => $request->input('purchase_payment_type'),
                'purchase_amount'  => $request->input('purchase_amount'),
                'sell_amount_total'  => $request->input('sell_amount_total'),
                'total_candidate'  => $request->input('total_candidate'),
                'per_ticket_amount'  => $request->input('per_ticket_amount'),
                'vat_or_tax_amount'  => $request->input('vat_or_tax_amount'),
                'partial_sell_amount'  => $request->input('partial_sell_amount'),
                'agent_commission'  => $request->input('agent_commission'),
                'is_refundable'  => $request->input('is_refundable') === '1' ? '1' : '0',
                'is_make_flight_complete'  => $request->input('is_make_flight_complete') === '1' ? '1' : '0',
                'payment_type'  => $request->input('payment_type'),
                'payment_method'  => $request->input('payment_method'),
                'ticket_price_payment_method'  => $request->input('ticket_price_payment_method'),
                'attachment'         => $attachmentPath,
                'transaction_note'  => $request->input('transaction_note'),
                'user_id'  => Auth::user()->id,
                'note'  => $request->input('note')
            ]);

            if ($request->only('candidate_id')) {
                $data = [];
                foreach ($request->candidate_id as $key => $row) {
                    $data[] = [
                        'ticket_id' => $ticket->id,
                        'candidate_id' => $request->candidate_id[$key],
                        'created_at' => now(),
                    ];
                }
                TicketCandidate::insert($data);
            }

            return response()->json(['status' => 'success', 'message' => 'Ticket added Successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'fail', 'message' => $e->validator->errors()]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::with(['country', 'candidateType', 'airlineOffice','otherOffice', 'user'])->findOrFail($id);
        return response()->json($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $ticket = Ticket::findOrFail($id);

            if(isset($ticket->ticketCandidates)){
                $ticket->ticketCandidates()->delete();
            }
            $ticket->delete();
            return response()->json(['status' => 'success', 'message' => 'Ticket deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
