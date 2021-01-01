@extends('master')

@section('title')
<title>Worker Admin | Users</title>
@stop

@section('css')
@stop

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">All Users</h1>
                    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                        </div>
                        <div class="card-body">

                            @if(session()->has('adminDelete'))
                            <div class="alert alert-danger mt4" role="alert">
                           {{ session()->get('adminDelete') }}
                            </div>
                            @endif

                            @if(session()->has('successfulReset'))
                            <div class="alert alert-success mt4" role="alert">
                           {{ session()->get('successfulReset') }}
                            </div>
                            @endif

                            @if(session()->has('userDeleted'))
                            <div class="alert alert-success mt4" role="alert">
                           {{ session()->get('userDeleted') }}
                            </div>
                            @endif

                            <form method="post" action="users-search" class="input-group mb-4">
                                {{ csrf_field() }}

                                <input
                                  type="text"
                                  class="form-control"
                                  name="usersSearch"
                                  placeholder="Users Search"
                                  aria-label="Users Search"
                                  aria-describedby="Users Search"
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Category</th>
                                            <th>Role</th>
                                            <th>Country</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Category</th>
                                            <th>Role</th>
                                            <th>Country</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone_number}}</td>
                                            <td>{{$user->category->desc}}</td>
                                            <td>{{$user->role_name}}</td>
                                            <td>{{$user->location}}</td>
                                            <td>
                                                <a href="users-delete/{{$user->id}}" class="btn btn-danger">Delete</a>
                                                <a href="users-reset/{{$user->id}}" class="btn btn-warning">Reset</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $users->links()}}

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

@stop
@section('script')

@stop
