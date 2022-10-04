@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route("album.create") }}" class="btn btn-success">Create</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Operations</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if($albums->count()>0)
                            @foreach ($albums as $index=> $album )
                                <tr>
                                        <td scope="row" >{{ $index+1 }}</td>
                                        <td>{{ $album->name }}</td>
                                        <td>
                                            <a href="{{ route('album.edit',$album->id) }}" class="btn btn-primary">Update</a>
                                           <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                           data-target="#delete{{ $album->id }}"
                                           title="delete">Delete</button>
                                        </td>
                                </tr>
                                <div class="modal fade" id="delete{{$album->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    Are you Sure you want to delete this Album??

                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if($album->Attachments->count()>0)
                                               <h1> Album Has photos:</h1><br>
                                               <form  id="move_form" method="POST" action="{{ route("move.delete.album",$album->id) }}">
                                                @csrf
                                                <select class="custom-select mr-sm-2" name="album_id">
                                                    <option  disable selectedd>choose Album</option>

                                                    @foreach($albums as $al)
                                                    @if($al->id!=$album->id)
                                                        <option  value="{{ $al->id }}">{{ $al->name }}</option>
                                                    @endif
                                                    @endforeach


                                                </select>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Move & Delete</button>
                                            </form>

                                                <button id="{{ $album->id }}" class="delete_button btn btn-danger"> <a  href ="{{ route('album.delete',$album->id) }}" class="btn btn-danger">Delete Any way</a></button>
                                                @else
                                                <button id="{{ $album->id }}" class="delete_button btn btn-danger"> <a  href ="{{ route('album.delete',$album->id) }}" class="btn btn-danger">Delete</a></button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3">
                                No Albums try to add some ...
                                <td>
                            </tr>
                            @endif
                        </tbody>



                      </table>

               </div>
            </div>
        </div>
    </div>
</div>
@endsection
