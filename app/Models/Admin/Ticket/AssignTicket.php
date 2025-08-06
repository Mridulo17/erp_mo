<?php

namespace App\Models\Admin\Ticket;

use App\Models\Admin\Process\Candidate;
use Illuminate\Database\Eloquent\Model;

class AssignTicket extends Model
{
    protected $fillable =
        [
            'ticket_id',
            'ticket_type',
            'pnr_number',
            'total_candidate',
            'note'
        ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function assignTicketCandidates()
    {
        return $this->hasMany(AssignTicketCandidate::class);
    }
}
