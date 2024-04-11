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
                        <h1>Task</h1>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('create-task') }}" class="mt-2 float-sm-right">Create Task</a>
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
                                            <th>Project</th>
                                            <th>Module</th>
                                            <th>Sub Module</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBodyContents">
                                        @foreach ($tasks as $item)
                                            <tr class="tableRow" data-id="{{ $item->id }}">
                                                <td class="pl-3"><i class="fa fa-sort"></i></td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ optional($item->project)->name }}</td>
                                                <td>{{ optional($item->module)->name }}</td>
                                                <td>{{ optional($item->subModule)->name }}</td>
                                                <td>{{ $item->start_date }}</td>
                                                <td>{{ $item->end_date }}</td>
                                                <td
                                                    style="color: 
                                                    @if ($item->type == 'general') blue; <!-- Change color according to type -->
                                                    @elseif ($item->type == 'development')
                                                        green; <!-- Change color according to type -->
                                                    @elseif ($item->type == 'bug')
                                                        red; <!-- Change color according to type -->
                                                    @elseif ($item->type == 'change_request')
                                                        orange; <!-- Change color according to type --> @endif">
                                                    {{ $item->type }}
                                                </td>

                                                <td
                                                    style="color: 
                                                    @if ($item->status == 'pending') blue; <!-- Change color according to status -->
                                                    @elseif ($item->status == 'todo')
                                                        green; <!-- Change color according to status -->
                                                    @elseif ($item->status == 'running')
                                                        orange; <!-- Change color according to status -->
                                                    @elseif ($item->status == 'complete')
                                                        red; <!-- Change color according to status --> @endif">
                                                    {{ $item->status }}
                                                </td>

                                                <td class="text-center">
                                                    <a
                                                        href="{{ route('task-edit', ['id' => Crypt::encrypt($item->id)]) }}"><i
                                                            class="fas fa-edit text-gray"></i></a>
                                                    <form
                                                        action="{{ route('task-delete', ['id' => Crypt::encrypt($item->id)]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link"><i
                                                                class="fa fa-trash text-danger"
                                                                aria-hidden="true"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Project</th>
                                            <th>Module</th>
                                            <th>Sub Module</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
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
@endsection
@section('footer_script')
    <script>
        $(document).ready(function() {
            $('#empTable').DataTable();
        });
    </script>
@stop
