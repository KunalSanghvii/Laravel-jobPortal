<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function ()  {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
       'jobs' => $jobs
       ]);
});

Route::get('/jobs/create', function(){
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id){

    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

Route::post('/jobs', function(){
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
});

Route::get('/jobs/{id}/edit', function ($id){

    $job = Job::find($id);

    return view('jobs.edit ', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id){
    // validate
    request()->validate([
        'title' => ['required'],
        'salary' => ['required']
    ]);

    // authorize(on hold)


    // update the job
    $job =Job::findOrFail ($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);

    // redirect to the job page
    return redirect('/jobs/' .$job->id);
});

//delete
Route::delete('/jobs/{id}', function ($id){
    // authorize the request(on hold)

    // delete the job
    Job::findOrFail ($id)->delete();
    // redirect
    return redirect('/jobs');


});


Route::get('/contact', function () {
    return view('contact');
});
