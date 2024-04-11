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
                                <h3 class="card-title">Create Employee</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('store-employee') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name"
                                            placeholder="Enter Name">
                                        @error('name')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="test" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter email" autocomplete="email">
                                        @error('email')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                                            placeholder="Enter Phone Number" minlength="10" maxlength="10">
                                        @error('phone')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Password</label>
                                        <input type="password" name="password" value="{{ old('password') }}" id="password" class="form-control"
                                            placeholder="Enter Password">
                                        @error('password')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Confirm Password</label>
                                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" id="password" class="form-control"
                                            placeholder="Enter Password">
                                        @error('password_confirmation')
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
@stop
