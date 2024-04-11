@extends('layout.app')
{{-- @section('employees', 'active') --}}
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Update Task</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('task-update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="project">Employee</label>
                                        <div class="select2-purple">
                                            <select class="select2" name="employee" data-placeholder="Select a Project"
                                                data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                @forelse ($employees as $employee)
                                                    <option value="{{ $employee->id }}"
                                                        {{ $employee->id == $task->employee_id ? 'selected' : '' }}>
                                                        {{ $employee->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        @error('employee')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Task Name</label>
                                        <input type="text" name="name" value="{{ $task->name }}"
                                            class="form-control" id="name" placeholder="Enter Name">
                                        @error('name')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="project">Project</label>
                                        <div class="select2-purple">
                                            <select class="select2 filter-module" name="project"
                                                data-placeholder="Select a Project" data-dropdown-css-class="select2-purple"
                                                style="width: 100%;">
                                                @forelse ($projects as $project)
                                                    <option value="{{ $project->id }}"
                                                        {{ $project->id == $task->project_id ? 'selected' : '' }}>
                                                        {{ $project->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        @error('project')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="module">Module</label>
                                        <div class="select2-purple">
                                            <select class="select2 get-module set-module" name="module"
                                                data-placeholder="Select a Module" data-dropdown-css-class="select2-purple"
                                                style="width: 100%;">
                                                <option value="{{ $task->module->id }}"
                                                    {{ $task->module->id == $task->module_id ? 'selected' : '' }}>
                                                    {{ $task->module->name }}</option>
                                            </select>
                                        </div>
                                        @error('module')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="sub_module">Sub Module</label>
                                        <div class="select2-purple">
                                            <select class="select2 set-sub-module" name="sub_module"
                                                data-placeholder="Select a Sub Module"
                                                data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="{{ $task->subModule->id }}"
                                                    {{ $task->subModule->id == $task->sub_module_id ? 'selected' : '' }}>
                                                    {{ $task->subModule->name }}</option>
                                            </select>
                                        </div>
                                        @error('sub_module')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="start_date">Start Date</label>
                                                <input type="date" name="start_date" id="start_date"
                                                    value="{{ $task->start_date }}" class="form-control" id="start_date">
                                                @error('start_date')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="end_date">End Date</label>
                                                <input type="date" name="end_date" id="end_date"
                                                    value="{{ $task->end_date }}" class="form-control"
                                                    min="{{ $task->start_date }}" id="end_date">
                                                @error('end_date')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="type">Type</label>
                                                <select class="form-control" name="type">
                                                    <option value="general"
                                                        {{ $task->type == 'general' ? 'selected' : '' }}>General</option>
                                                    <option value="development"
                                                        {{ $task->type == 'development' ? 'selected' : '' }}>Development
                                                    </option>
                                                    <option value="bug" {{ $task->type == 'bug' ? 'selected' : '' }}>Bug
                                                    </option>
                                                    <option value="change_request"
                                                        {{ $task->type == 'change_request' ? 'selected' : '' }}>Change
                                                        Request</option>
                                                </select>
                                                @error('type')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="pending"
                                                        {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="todo"
                                                        {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
                                                    <option value="running"
                                                        {{ $task->status == 'running' ? 'selected' : '' }}>Running</option>
                                                    <option value="complete"
                                                        {{ $task->status == 'complete' ? 'selected' : '' }}>Complete
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary ml-4 mb-4">Submit</button>
                        </div>
                        <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('footer_script')
    <script>
        $(document).ready(function() {
            $('.select2').select2()

            $('.filter-module').on('change', function() {
                var selectedProjectId = $(this).val();
                console.log('Selected Project ID:', selectedProjectId);

                $.ajax({
                    type: "get",
                    url: "{{ route('get-module') }}",
                    data: {
                        id: selectedProjectId
                    },
                    success: function(response) {
                        $('.set-module').empty();
                        // Append new options based on the fetched modules
                        $.each(response.modules, function(index, module) {
                            $('.set-module').append('<option value="' + module.id +
                                '">' + module.name + '</option>');
                        });
                        // Refresh the select2 dropdown to reflect the changes
                        $('.set-module').trigger('change');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching modules:', error);
                    }
                });
            });

            $('.get-module').on('change', function() {
                var selectedModuleId = $(this).val();
                console.log('Selected Module ID:', selectedModuleId);

                $.ajax({
                    type: "get",
                    url: "{{ route('get-sub-module') }}",
                    data: {
                        id: selectedModuleId
                    },
                    success: function(response) {
                        $('.set-sub-module').empty();
                        // Append new options based on the fetched modules
                        $.each(response.submodules, function(index, submodules) {
                            $('.set-sub-module').append('<option value="' + submodules
                                .id + '">' + submodules.name + '</option>');
                        });
                        // Refresh the select2 dropdown to reflect the changes
                        $('.set-sub-module').trigger('change');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching modules:', error);
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            // Add event listener to the start date input
            startDateInput.addEventListener('change', function() {
                // Set the min attribute of the end date input to the selected start date
                endDateInput.min = startDateInput.value;

                // If end date is earlier than the start date, reset it to the start date
                if (endDateInput.value < startDateInput.value) {
                    endDateInput.value = startDateInput.value;
                }
            });
        });
    </script>


@stop
