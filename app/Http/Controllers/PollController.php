<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::with('answers')->latest()->get();
        
        $polls->each->calculateVotes();

        return view('polls.index', compact('polls'));
    }

    public function create()
    {
        return view('polls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answers' => 'required|array|min:2',
            'answers.*' => 'required|string|max:255',
        ]);

        $poll = Poll::create([
            'question' => $request->question,
            'user_id' => Auth::id(),
        ]);

        foreach ($request->answers as $answer) {
            PollAnswer::create([
                'poll_id' => $poll->id,
                'answer' => $answer,
            ]);
        }

        return redirect()->route('polls.index')->with('success', 'Enquete criada com sucesso!');
    }

    public function show(Poll $poll)
    {
        $poll->load('answers');
        return view('polls.show', compact('poll'));
    }

    public function destroy(Poll $poll)
    {
        $poll->delete();
        return redirect()->route('polls.index')->with('success', 'Enquete excluida com sucesso!');
    }
}
