<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::orderBy('created_at', 'desc')->get();
        return view('pages.module.module-list', compact('modules'));
    }

    public function create()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('pages.module.create-module', compact('projects'));
    }

    public function store(Request $request)
    {
        $validtor = Validator::make($request->all(), [
            'name' => 'required',
            'project_id' => 'required'
        ]);

        if ($validtor->fails()) {
            return redirect()->back()->withErrors($validtor)->withInput();
        }

        Module::create([
            'project_id' => $request->project_id,
            'name' => $request->name
        ]);

        return redirect()->route('module')->with('success', 'Module created successfully');
    }

    public function edit($id)
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        $module = Module::findOrFail(Crypt::decrypt($id));

        return view('pages.module.edit-module', compact('module', 'projects'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'project' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $project = Module::where('id', $request->module_id);

        if ($project) {
            $project->update([
                'name' => $request->name,
                'project_id' => $request->project,
            ]);

            return redirect()->route('module')->with('success', 'Module details update successfully');
        }
    }

    public function destroy($id)
    {
        $project = Module::where('id', Crypt::decrypt($id))->delete();
        return redirect()->route('module')->with('success', 'Module details delete successfully');
    }
}
