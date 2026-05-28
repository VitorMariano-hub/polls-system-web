<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use Illuminate\Http\Request;

class AdminPollController extends Controller
{
    public function dashboard()
    {
        $polls = Poll::with(['user', 'answers'])->latest()->get();
        
        // Calcular votos e porcentagem
        $polls->each->calculateVotes();

        return view('admin.dashboard', compact('polls'));
    }

    public function toggleVerify(Poll $poll)
    {
        $poll->update([
            'is_verified' => !$poll->is_verified
        ]);

        $status = $poll->is_verified ? 'verificada com sucesso! 🌟' : 'desmarcada como verificada. ⚠️';
        return back()->with('success', "A enquete \"{$poll->question}\" foi {$status}");
    }

    public function destroy(Poll $poll)
    {
        $poll->delete();
        return back()->with('success', 'Enquete excluída com sucesso pelo administrador.');
    }
}
