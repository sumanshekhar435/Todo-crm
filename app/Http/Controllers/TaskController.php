<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Module;
use App\Models\Project;
use App\Models\Employee;
use App\Models\SubModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('pages.task.task-list', compact('tasks'));
    }

    public function create()
    {
        $employees = Employee::orderBy('created_at', 'desc')->get();
        $projects = Project::orderBy('created_at', 'desc')->get();

        return view('pages.task.create-task', compact('projects', 'employees'));
    }

    public function getModule(Request $request)
    {

        $modules = Module::where('project_id', $request->id)->get();

        return response()->json(['status' => 200, 'modules' => $modules]);
    }

    public function getSubModule(Request $request)
    {

        $submodules = SubModule::where('module_id', $request->id)->get();

        return response()->json(['status' => 200, 'submodules' => $submodules]);
    }

    public function store(Request $request)
    {

        $validtor = Validator::make($request->all(), [
            'employee' => 'required',
            'name' => 'required',
            'project' => 'required',
            'module' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);

        if ($validtor->fails()) {
            return redirect()->back()->withErrors($validtor)->withInput();
        }

        Task::create([
            'name' => $request->name,
            'employee_id' => $request->employee,
            'project_id' => $request->project,
            'module_id' => $request->module,
            'sub_module_id' => $request->sub_module,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return redirect()->route('task')->with('success', 'Task created successfully');
    }

    public function edit($id)
    {
        $employees = Employee::orderBy('created_at', 'desc')->get();
        $projects = Project::orderBy('created_at', 'desc')->get();
        $task = Task::findOrFail(Crypt::decrypt($id));
        // dd($task->module);

        return view('pages.task.edit-task', compact('employees', 'projects', 'task'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee' => 'required',
            'name' => 'required',
            'project' => 'required',
            'module' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $task = Task::where('id', $request->task_id);

        if ($task) {
            $task->update([
                'name' => $request->name,
                'employee_id' => $request->employee,
                'project_id' => $request->project,
                'module_id' => $request->module,
                'sub_module_id' => $request->sub_module,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'type' => $request->type,
                'status' => $request->status,
            ]);

            return redirect()->route('task')->with('success', 'Task details update successfully');
        }
    }

    public function destroy($id)
    {
        $project = Task::where('id', Crypt::decrypt($id))->delete();
        return redirect()->route('task')->with('success', 'Task details delete successfully');
    }
}
