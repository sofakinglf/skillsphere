<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedWork extends Model
{
    use HasFactory;
    protected $table = 'applied_user';
    protected $guarded = [];
    protected $with = ['user'];
    public function user()
    {
        return $this->belongsTo(UserDetails::class, 'applied_id', 'user_id');
    }
}
