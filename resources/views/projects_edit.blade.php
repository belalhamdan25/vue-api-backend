@extends('master')

@section('title')
    <title>Worker Admin | Project Edit</title>
@stop

@section('css')
@stop

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Projects Edit</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Project Edit</h6>
            </div>
            <div class="card-body">

                @if(session()->has('successfulEdit'))
                <div class="alert alert-success mt4" role="alert">
               {{ session()->get('successfulEdit') }}
                </div>
                @endif


                <form method="post" action="/project-edit/{{$id->id}}">
                    {{ csrf_field() }}

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" value="{{$id->title}}" name="title" id="title" placeholder="Title">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="budget">Budget</label>
                            <input type="number" class="form-control" value="{{$id->budget}}" name="budget" id="budget" placeholder="Budget">
                        </div>
                        <div class="form-group  col-md-3">
                            <label for="time_line">Time Line</label>
                            <input type="number" class="form-control" value="{{$id->time_line}}" name="time_line" id="time_line" placeholder="Time Line">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="category">Category</label>
                            <input name="category_id" value="{{ $id->category_id }}" type="hidden">
                            <select name="category_id" id="category" class="form-control">
                                <option disabled value="{{ $id->category_id }}" selected>{{ $id->category->desc }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->desc }}</option>
                                @endforeach
                            </select>
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
