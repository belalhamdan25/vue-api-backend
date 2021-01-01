
@extends('master')

@section('title')
<title>Worker Admin | Offers</title>
@stop

@section('css')
@stop

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Search Offers Results</h1>
                    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Offers</h6>
                        </div>
                        <div class="card-body">

                            <form method="post" action="offer-search" class="input-group mb-4">
                                {{ csrf_field() }}

                                <input
                                  type="text"
                                  class="form-control"
                                  name="offerSearch"
                                  placeholder="Offers Search"
                                  aria-label="Offers Search"
                                  aria-describedby="Offers Search"
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
                                            <th>Timeline</th>
                                            <th>Coast</th>
                                            <th>Profit</th>
                                            <th>Desc</th>
                                            <th>Status</th>
                                            <th>User</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Timeline</th>
                                            <th>Coast</th>
                                            <th>Profit</th>
                                            <th>Desc</th>
                                            <th>Status</th>
                                            <th>User</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($offerSearch as $offer)
                                        <tr>
                                            <td>{{$offer->timeline}}</td>
                                            <td>{{$offer->coast}}</td>
                                            <td>{{$offer->profit}}</td>
                                            <td>{{$offer->desc}}</td>
                                            <td>{{$offer->status}}</td>
                                            <td>
                                                @if(!empty($offer->user))
                                                {{$offer->user->first_name}}
                                                {{$offer->user->last_name}}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="offer-delete/{{$offer->id}}" class="btn btn-danger">Delete</a>
                                                <a href="offer-edit/{{ $offer->id }}" class="btn btn-warning">Edit</a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $offerSearch->links()}}

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

@stop


@section('script')
@stop
