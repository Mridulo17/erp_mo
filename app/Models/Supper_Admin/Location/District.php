<?php

namespace App\Models\Supper_Admin\Location;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Process\CandidateLocation;
use App\Models\Admin\Process\CandidatePassport;

class District extends Model
{
    protected $fillable =
    [
        'name', 
        'code', 
        'status',
        'division_id',
        'user_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function issuedPassports()
    {
        return $this->hasMany(CandidatePassport::class, 'passport_issue_place_id');
    }

    public function candidateLocations()
    {
        return $this->hasMany(CandidateLocation::class);
    }

}
