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
                                <h3 class="card-title">Update Module</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('module-update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="module_id" value="{{$module->id}}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Module Name</label>
                                        <input type="text" name="name" value="{{ $module->name }}"
                                            class="form-control" id="name" placeholder="Enter Name">
                                        @error('name')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="project">Project Name</label>
                                        <div class="select2-purple">
                                            <select class="select2" name="project"
                                                data-placeholder="Select a project" data-dropdown-css-class="select2-purple"
                                                style="width: 100%;">
                                                @forelse ($projects as $project)
                                                    <option value="{{ $project->id }}" {{ $project->id == $module->project_id ? 'selected' : '' }}>
                                                        {{ $project->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        @error('project')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
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
        });
    </script>
@stop
