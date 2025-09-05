<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBlock extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
