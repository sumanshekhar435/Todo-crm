@extends('layout.app')
@section('project', 'active')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project</h1>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('create-project') }}" class="mt-2 float-sm-right">Create Project</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="empTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Member</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBodyContents">
                                        @foreach ($projects as $item)
                                            <tr class="tableRow" data-id="{{ $item->id }}">
                                                <td class="pl-3"><i class="fa fa-sort"></i></td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    @foreach ($item->employee_names as $index => $employeeName)
                                                        {{ $employeeName }}
                                                        @if ($index < count($item->employee_names) - 1)
                                                            |
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $item->type }}</td>
                                                <td>
                                                    <a href="{{route('project-edit', ['id' => Crypt::encrypt($item->id)])}}"><i
                                                        class="fas fa-edit text-gray"></i></a>
                                                    <a href="{{route('project-delete', ['id' => Crypt::encrypt($item->id)])}}">
                                                        <i
                                                        class="fa fa-trash text-danger ml-3" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Member</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    {{-- Delete Modal --}}

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Delete Employees</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete Employees data ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" id="employees_delete" class="btn bg-danger btn-sm">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- loader start --}}
    <div class="loader-container spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    {{-- loader end --}}
@endsection
@section('footer_script')
    <script>
        $(document).ready(function() {
            $('#empTable').DataTable();
        });
    </script>
@stop
