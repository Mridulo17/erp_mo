<?php

namespace App\Models\Supper_Admin\Communication;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ImportantDays extends Model
{
    protected $fillable = [
        'name',
        'date',
        'description',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
