<?php

namespace App\Models\Admin\Enquiry;

use App\Models\Admin\Process\CandidateType;
use Illuminate\Database\Eloquent\Model;

class VisitorBook extends Model
{
    protected $fillable = [
        'phone',
        'full_name',
        'address',
        'candidate_type_id',
        'reference_type',
        'note',
        'entry_time',
        'how_find_us',
    ];

    public function candidateType()
    {
        return $this->belongsTo(CandidateType::class, 'candidate_type_id');
    }
}
