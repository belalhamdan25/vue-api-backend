@extends('master')

@section('title')
<title>Worker Admin | Projects</title>
@stop

@section('css')
@stop

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Search Projects Results</h1>
                    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                        </div>
                        <div class="card-body">


                            <form method="post" action="project-search" class="input-group mb-4">
                                {{ csrf_field() }}

                                <input
                                  type="text"
                                  class="form-control"
                                  name="projectSearch"
                                  placeholder="Projects Search"
                                  aria-label="Projects Search"
                                  aria-describedby="Projects Search"
                                />
                                <div class="input-group-append">
                                  <button
                                    class="btn btn-primary"
                                    type="submit"
                                  >
                                    <i class="fas fa-search"></i>
                                  </button>
                                </div>
                              </form>


                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Desc</th>
                                            <th>Budget</th>
                                            <th>Time Line</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>User</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Title</th>
                                            <th>Desc</th>
                                            <th>Budget</th>
                                            <th>Time Line</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>User</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($projectSearch as $project)
                                        <tr>
                                            <td>{{$project->title}}</td>
                                            <td>{{$project->desc}}</td>
                                            <td>{{$project->budget}}</td>
                                            <td>{{$project->time_line}}</td>
                                            <td>{{$project->status}}</td>
                                            <td>{{$project->category->desc}}</td>
                                            <td>
                                                @if(!empty($project->user))
                                                {{$project->user->first_name}}
                                                {{$project->user->last_name}}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="project-delete/{{$project->id}}" class="btn btn-danger">Delete</a>
                                                <a href="project-edit/{{ $project->id }}" class="btn btn-warning">Edit</a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $projectSearch->links()}}

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

@stop
@section('script')

@stop
