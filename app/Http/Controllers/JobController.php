<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Employer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
           'jobs' => $jobs
        ]);

    }
    public function create()
    {
        return view('jobs.create');

    }
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }
    public function store()
    {
        request()->validate([
            'title' => ['required'],
            'salary' => ['required']
        ]);

         Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
     ]);

     return redirect('/jobs');
    }
    public function edit(Job $job)
    {

        return view('jobs.edit ', ['job' => $job]);
    }
    public function update(Job $job)
    {
        // authorize(on hold)

        // validate
        request()->validate([
            'title' => ['required'],
            'salary' => ['required']
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        // redirect to the job page
        return redirect('/jobs/' .$job->id);
    }
    public function destroy(Job $job)
    {
        // authorize the request(on hold)

        // delete the job
        $job->delete();
        // redirect
        return redirect('/jobs');
    }



}
