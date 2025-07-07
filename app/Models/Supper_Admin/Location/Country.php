<?php

namespace App\Models\Supper_Admin\Location;

use App\Models\User;
use App\Models\Admin\Process\Candidate;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Process\CandidateLocation;
use App\Models\Admin\Process\CandidateExperience;

class Country extends Model
{
    protected $fillable =
    [
        'name', 
        'country_code', 
        'phone_code', 
        'status',
        'continent_id',
        'user_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function continent()
    {
        return $this->belongsTo(Continent::class, 'continent_id');
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function travelledCandidateExperiences()
    {
        return $this->hasMany(CandidateExperience::class, 'travelled_country_id');
    }

    public function candidateLocations()
    {
        return $this->hasMany(CandidateLocation::class);
    }

}
