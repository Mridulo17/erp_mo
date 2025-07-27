<?php

namespace App\Models\Supper_Admin\Social_Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SocialMediaConfiguration extends Model
{
    use HasFactory;

    protected $table = 'social_media_configuration';

    protected $fillable = [
        'platform',
        'page_name',
        'page_id',
        'app_id',
        'app_secret',
        'access_token',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
