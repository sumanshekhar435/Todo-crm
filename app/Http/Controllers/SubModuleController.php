<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Project;
use App\Models\SubModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class SubModuleController extends Controller
{
    public function index()
    {
        $sub_modules = SubModule::orderBy('created_at', 'desc')->get();
        return view('pages.sub-module.sub-module-list', compact('sub_modules'));
    }

    public function create()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        $modules = Module::orderBy('created_at', 'desc')->get();
        return view('pages.sub-module.create-sub-module', compact('projects', 'modules'));
    }

    public function store(Request $request)
    {
        $validtor = Validator::make($request->all(), [
            'name' => 'required',
            'project' => 'required',
            'module' => 'required'
        ]);

        if ($validtor->fails()) {
            return redirect()->back()->withErrors($validtor)->withInput();
        }

        SubModule::create([
            'name' => $request->name,
            'project_id' => $request->project,
            'module_id' => $request->module,
        ]);

        return redirect()->route('sub-module')->with('success', 'Sub Module created successfully');
    }

    public function edit($id)
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        $modules = Module::orderBy('created_at', 'desc')->get();
        $sub_module = SubModule::findOrFail(Crypt::decrypt($id));

        return view('pages.sub-module.edit-sub-module', compact('modules', 'projects', 'sub_module'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'project' => 'required',
            'module' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $project = SubModule::where('id', $request->sub_module_id);

        if ($project) {
            $project->update([
                'name' => $request->name,
                'project_id' => $request->project,
                'module_id' => $request->module,
            ]);

            return redirect()->route('sub-module')->with('success', 'Sub Module details update successfully');
        }
    }

    public function destroy($id)
    {
        $project = SubModule::where('id', Crypt::decrypt($id))->delete();
        return redirect()->route('sub-module')->with('success', 'Sub Module details delete successfully');
    }
}
