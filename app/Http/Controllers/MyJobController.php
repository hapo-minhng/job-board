<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Job $job)
    {
        return view(
            'my_job.index',
            [
                'jobs' => auth()->user()->employer
                    ->jobs()
                    ->with(['employer', 'jobApplication', 'jobApplication.user'])
                    ->withTrashed()
                    ->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("my_job.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        auth()->user()->employer->jobs()->create($request->validated());

        return redirect()->route('my-jobs.index')
        ->with('success', 'Job created successfully!');
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
