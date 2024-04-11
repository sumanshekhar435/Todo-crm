<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve projects with their associated employees
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('pages.project.project-list', compact('projects'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Employee::orderBy('name', 'asc')->get();
        return view('pages.project.add-project', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'member' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $project = Project::create([
                'name' => $request->name,
                'member' => json_encode($request->member),
                'type' => $request->type,
            ]);

            // Redirect back with success message
            return redirect()->route('project')->with('success', 'Project created successfully');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'Oops! Something went wrong while creating project...');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, $id)
    {
        $members = Employee::orderBy('name', 'asc')->get();
        $project = $project->find(Crypt::decrypt($id));
        return view('pages.project.edit-project', compact('project', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'member' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $project = Project::where('id', $request->project_id);

        if ($project) {
            $project->update([
                'name' => $request->name,
                'member' => json_encode($request->member),
                'type' => $request->type,
            ]);

            return redirect()->route('project')->with('success', 'Project details update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, $id)
    {
        $project = Project::where('id', Crypt::decrypt($id))->delete();
        return redirect()->route('project')->with('success', 'Project details delete successfully');
    }
}
