<?php

namespace App\Models\Admin\Enquiry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewedCandidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'full_name',
        'date_of_birth',
        'note',
    ];
} 