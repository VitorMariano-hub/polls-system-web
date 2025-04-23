<?php

namespace App\Http\Controllers;

use App\Models\PollVote;
use App\Models\PollAnswer;
use Illuminate\Http\Request;

class PollVoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'poll_id' => 'required|exists:polls,id',
            'answer_id' => 'required|exists:poll_answers,id',
        ]);

        $identifier = auth()->check() ? auth()->id() : $request->ip();

        $alreadyVoted = PollVote::verifyAlreadyVoted($identifier, $request->poll_id);
        
        if ($alreadyVoted) {
            return back()->with('error', 'Você já votou nesta enquete.');
        }

        PollVote::create([
            'poll_id' => $request->poll_id,
            'answer_id' => $request->answer_id,
            'user_identifier' => $identifier,
        ]);

        PollAnswer::where('id', $request->answer_id)->increment('votes');

        return back()->with('success', 'Voto registrado com sucesso!');
    }
}
