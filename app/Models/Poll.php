<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'user_id'];

    public function answers()
    {
        return $this->hasMany(PollAnswer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->hasManyThrough(
            PollVote::class,     
            PollAnswer::class,
            'poll_id',
            'answer_id',
            'id',                
            'id'                
        );
    }

    public function calculateVotes()
    {
        $this->answers_count = $this->answers->sum('votes');

        foreach ($this->answers as $answer) {
            $answer->calculatePercentage($this->answers_count);
        }

        return $this;
    }

}
