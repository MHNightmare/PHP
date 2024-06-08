<?php

namespace App\Http\Controllers\Projects\JobBoard;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {
        $this->authorize('apply' , $job);
        return view('job_application.create' , ['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Job $job , Request $request)
    {

        $validatedDate= $request->validate([
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048'
        ]);

        $file= $request->file('cv');
        $path= $file->store('cvs', 'private');

        $this->authorize('apply' , $job);
        $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validatedDate['expected_salary'],
            'cv_path' => $path
        ]);

        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job application submitted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
