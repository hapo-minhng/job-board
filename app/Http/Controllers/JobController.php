<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Job::class);
        $filters = request()->only([
            "search",
            "min_salary",
            "max_salary",
            "experience",
            "category",
        ]);

        return view('job.index', ['jobs' => Job::with('employer')
            ->latest()
            ->filter($filters)
            ->paginate(10)->withQueryString(), "filters" => $filters]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        Gate::authorize('view', $job);
        return view(
            'job.show',
            ['job' => $job->load('employer.jobs')]
        );
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
