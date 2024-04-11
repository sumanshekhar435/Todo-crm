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
                                <h3 class="card-title">Create Project</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('store-project') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control" id="name" placeholder="Enter Name">
                                        @error('name')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="member">Member</label>
                                        <div class="select2-purple">
                                            <select class="select2" name="member[]" multiple="multiple"
                                                data-placeholder="Select a Member" data-dropdown-css-class="select2-purple"
                                                style="width: 100%;">
                                                @forelse ($members as $member)
                                                    <option value="{{ $member->id }}"
                                                        @if (is_array(old('member')) && in_array($member->id, old('member'))) selected @endif>
                                                        {{ $member->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        @error('member')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Project Type</label>
                                        <div class="select2-purple">
                                            <select class="select2" name="type" multiple="multiple"
                                                data-placeholder="Select a Project Type"
                                                data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="project" @if (old('type') == 'project') selected @endif>
                                                    Project</option>
                                                <option value="crm" @if (old('type') == 'crm') selected @endif>Crm
                                                </option>
                                            </select>
                                        </div>
                                        @error('type')
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
