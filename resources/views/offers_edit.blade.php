@extends('master')

@section('title')
    <title>Worker Admin | Offer Edit</title>
@stop

@section('css')
@stop

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Offers Edit</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Offer Edit</h6>
            </div>
            <div class="card-body">

                @if(session()->has('successfulEdit'))
                <div class="alert alert-success mt4" role="alert">
               {{ session()->get('successfulEdit') }}
                </div>
                @endif


                <form method="post" action="/offer-edit/{{$id->id}}">
                    {{ csrf_field() }}

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="timeline">Timeline</label>
                            <input type="number" class="form-control" value="{{$id->timeline}}" name="timeline" id="timeline" placeholder="Timeline">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Coast">Coast</label>
                            <input type="number" class="form-control" value="{{$id->coast}}" name="coast" id="coast" placeholder="Coast">
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="profit">Profit</label>
                            <input type="number" class="form-control" value="{{$id->profit}}" name="profit" id="profit" placeholder="Profit">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="desc">Desc</label>
                        <textarea class="form-control" id="desc" name="desc" rows="10">{{$id->desc}}</textarea>
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
