@extends('master')

@section('title')
<title>Worker Admin | Skills</title>
@stop

@section('css')
@stop

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">All Skills</h1>
                    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Add Skills</h6>
                                </div>
                                <div class="card-body">

                                    @if(session()->has('successfulSkillAdd'))
                                    <div class="alert alert-success mt4" role="alert">
                                   {{ session()->get('successfulSkillAdd') }}
                                    </div>
                                    @endif


                                    @if(session()->has('TagDeleted'))
                                    <div class="alert alert-success mt4" role="alert">
                                   {{ session()->get('TagDeleted') }}
                                    </div>
                                    @endif

                                    <form method="post" action="/skills-store" class="form-inline">
                                        {{ csrf_field() }}

                                        <div class="form-group mx-sm-3 mb-2">
                                          <label for="skills" class="sr-only">Add Skills</label>
                                          <input name="skill" type="text" class="form-control" id="skills" placeholder="Add Skill">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Add</button>
                                      </form>
                                </div>
                            </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Skills</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($skills as $skill)
                                        <tr>
                                            <td>{{$skill->name}}</td>
                                            <td>
                                                <a href="skills-delete/{{$skill->name}}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $skills->links()}}

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

@stop
@section('script')

@stop
