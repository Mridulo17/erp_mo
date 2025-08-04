<?php

namespace App\Models\Admin\Ticket;

use App\Models\Admin\Process\Candidate;
use Illuminate\Database\Eloquent\Model;

class TicketCandidate extends Model
{
    protected $fillable =
        [
            'ticket_id',
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
