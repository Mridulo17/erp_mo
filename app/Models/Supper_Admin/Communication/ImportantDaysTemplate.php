<?php

namespace App\Models\Supper_Admin\Communication;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportantDaysTemplate extends Model
{
    use HasFactory;

    protected $table = 'important_days_template';

    protected $fillable = [
        'important_days_id',
        'message_template',
        'attachment',
        'status',
        'user_id',
    ];

    public function importantDay()
    {
        return $this->belongsTo(ImportantDays::class, 'important_days_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
