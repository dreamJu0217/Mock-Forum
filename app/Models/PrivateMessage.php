<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'message'];

    // Define the sender relationship
    public function sender()
{
    return $this->belongsTo(User::class, 'sender_id');
}

    public function recipient()
{
    return $this->belongsTo(User::class, 'recipient_id');
}

}