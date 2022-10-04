@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   <h1>Edit Album</h1></div>
                   @if ($errors->any())
                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                       <ul>
                           @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                           @endforeach
                       </ul>
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
               @endif

                <div class="card-body">
                    <form  id="create_form" method="POST" action="{{ route("album.update",$album->id) }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name"  name="name" value="{{ $album->name }}" aria-describedby="emailHelp" placeholder="Enter Album Name" required>
                          <input type="file" name="photos[]" accept="image/*" multiple>

                        </div>
                          <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                    @if($album->Attachments->count()>0)
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Operations</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($album->Attachments as $index=> $attachment )
                                <tr>
                                        <td scope="row" >{{ $index+1 }}</td>
                                        <td>{{ $attachment->name }}</td>
                                        <td><img src="{{ URL::to('images/Albums/'.$album->id.'/'.$attachment->name) }}" width=100% height=100% alt="my photo"></td>
                                        <td>
                                           <button id="{{ $album->id }}" class="delete_button btn btn-danger"> <a  href ="{{ route('attach.delete',$attachment->id) }}" class="btn btn-danger">Delete</a></button>
                                        </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                      </table>

               </div>
            </div>
        </div>
    </div>
</div>
@endsection
