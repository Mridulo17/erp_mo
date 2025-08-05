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

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
