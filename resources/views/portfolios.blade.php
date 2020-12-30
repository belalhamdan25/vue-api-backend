@extends('master')

@section('title')
<title>Worker Admin | Portfolios</title>
@stop

@section('css')
@stop

@section('content')

 <!-- Begin Page Content -->
 <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">All Portfolios</h1>
    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Portfolios</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Desc</th>
                            <th>Link</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Desc</th>
                            <th>Link</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Category</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($portfolios as $portfolio)
                        <tr>
                            <td>{{$portfolio->title}}</td>
                            <td>{{$portfolio->desc}}</td>
                            <td>{{$portfolio->link}}</td>
                            <td>{{$portfolio->date}}</td>
                            <td>
                                @if(!empty($portfolio->user))
                                {{$portfolio->user->first_name}}
                                {{$portfolio->user->last_name}}
                                @endif
                            </td>
                            <td>{{$portfolio->category->desc}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $portfolios->links()}}

        </div>
    </div>
</div>
<!-- /.container-fluid -->

@stop
@section('script')

@stop
