<?php

namespace App\Models\Admin\Ticket;

use App\Models\Admin\Process\Candidate;
use Illuminate\Database\Eloquent\Model;

class AssignTicketCandidate extends Model
{
    protected $fillable =
        [
            'assign_ticket_id',
            'candidate_id'
        ];

    public function assignTicket()
    {
        return $this->belongsTo(AssignTicket::class);
    }
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
