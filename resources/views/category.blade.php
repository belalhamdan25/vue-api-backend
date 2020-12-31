@extends('master')

@section('title')
<title>Worker Admin | Category</title>
@stop

@section('css')
@stop

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">All categories</h1>
                    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Add category</h6>
                                </div>
                                <div class="card-body">

                                    @if(session()->has('successfulcategoriesAdd'))
                                    <div class="alert alert-success mt4" role="alert">
                                   {{ session()->get('successfulcategoriesAdd') }}
                                    </div>
                                    @endif

                                    <form method="post" action="/category-store" class="form-inline">
                                        {{ csrf_field() }}

                                        <div class="form-group mx-sm-3 mb-2">
                                          <label for="skills" class="sr-only">Add Category</label>
                                          <input name="category" type="text" class="form-control" id="category" placeholder="Add Category">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Add</button>
                                      </form>
                                </div>
                            </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td>{{$category->desc}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $categories->links()}}

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

@stop
@section('script')

@stop
