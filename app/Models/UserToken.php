<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserToken extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($token) {
            $token->access_token = Str::uuid();
            $token->expires_at = now()->addDays(30);
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
