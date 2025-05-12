<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Proposal;
use App\Notifications\NewProposalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalsController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        $proposals = $user
            ->proposals()
            //eager loading
            ->with('project')
            //to get proposals from newest to oldest
            ->latest()
            ->paginate();
        return view('freelancer.proposals.index', [
            'proposals' => $proposals]);
    }

    public function create(Project $project)
    {
        return view('freelancer.proposals.create', [
            'project' => $project,
            'proposal' => new Proposal(),
            'units' => [
                'day' => 'Day',
                'week' => 'Week',
                'month' => 'Month',
                'year' => 'Year',
            ],
        ]);
    }

    public function store(Request $request, $project_id)
    {
        $project = Project::query()->findOrFail($project_id);
        if ($project->status !== 'open') {
            return redirect()->back()->with('error', 'You can not submit propsal to this project');
        }
        $request->validate([
            'description' => ['required', 'string'],
            'cost' => ['required', 'numeric', 'min:1'],
            'duration' => ['required', 'int', 'min:1'],
            'duration_unit' => ['required', 'in:day,week,year'],
        ]);
        $request->merge([
            'project_id' => $project_id
        ]);
        $user = Auth::guard('web')->user();
        $proposal = $user->proposals()->create($request->all());

        //Notifications
        $project->user->notify(new NewProposalNotification($proposal, $user));
//        dd('sending email...');

        return redirect()->back()->with('success', 'Your proposal has been submitted');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
