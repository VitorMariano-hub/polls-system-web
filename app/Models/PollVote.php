<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollVote extends Model
{
    use HasFactory;

    protected $fillable = ['poll_id', 'answer_id', 'user_identifier'];

    public function answer()
    {
        return $this->belongsTo(PollAnswer::class);
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function scopeVerifyAlreadyVoted($query, $user_identifier, $poll_id)
    {
        return $query->where('user_identifier', $user_identifier)
                     ->where('poll_id', $poll_id)
                     ->exists();
    }
}
