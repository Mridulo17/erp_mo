<?php

namespace App\Models\Admin\Enquiry;

use App\Models\Admin\Process\CandidateType;
use App\Models\Supper_Admin\Location\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneCall extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'full_name',
        'email',
        'country_id',
        'candidate_type_id',
        'note',
        'followup_date',
        'how_find_us',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function candidateType()
    {
        return $this->belongsTo(CandidateType::class);
    }
}
