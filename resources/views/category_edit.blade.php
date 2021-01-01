@extends('master')

@section('title')
    <title>Worker Admin | Category Edit</title>
@stop

@section('css')
@stop

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Category Edit</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Category Edit</h6>
            </div>
            <div class="card-body">

                @if(session()->has('successfulEdit'))
                <div class="alert alert-success mt4" role="alert">
               {{ session()->get('successfulEdit') }}
                </div>
                @endif


                <form method="post" action="/category-edit/{{$id->id}}">
                    {{ csrf_field() }}


                    <div class="form-group">
                        <label for="category">Name</label>
                        <input type="text" class="form-control" value="{{$id->desc}}" name="category" id="category" placeholder="Category">
                    </div>


                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@stop
@section('script')

@stop
