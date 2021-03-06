<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Message;
use App\Models\Proposal;
use App\Models\CoverLetter;
use App\Models\Conversation;
use Illuminate\Http\Request;


class ProposalController extends Controller
{
    public function store(Request $request, Job $job)
    {
        $proposal = Proposal::create([
            'job_id' => $job->id,
            'validated' => false
        ]);

        CoverLetter::create([
            'proposal_id' => $proposal->id,
            'content' => $request->input('contebt')
        ]);

        return redirect()->route('jobs.index');
    }

    public function confirm(Request $request)
    {
       $proposal = proposal::findOrFail($request->proposal);
       $proposal->fill([ 'validated' => 1]);

       if($proposal->isDirty)
       {
        $proposal->save();

        $conversation = Conversation::create([
            'from' => auth()->user()->id,
            'to' => $proposal->user->id,
            'job_id' => $proposal->job_id
        ]);

        Message::create([
            'user_id' => auth()->user()->id,
            'conversation_id' => $conversation->id,
            'content' => "Bonjour, j'ai valide votre offre."
        ]);
        return redirect()->route('jobs.index');
       };
    }
}
