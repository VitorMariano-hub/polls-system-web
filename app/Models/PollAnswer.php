<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['answer', 'poll_id', 'votes'];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class, 'answer_id');
    }

    public function calculatePercentage($totalVotes)
    {
        $this->votes_porcent = ($totalVotes > 0 && $this->votes > 0)
            ? ($this->votes / $totalVotes) * 100
            : 0;
    }
}
