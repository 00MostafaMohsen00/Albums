@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   <h1>Add Album</h1></div>
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
                    <form  id="create_form" method="POST" action="{{ route("album.save") }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name"  name="name" aria-describedby="emailHelp" placeholder="Enter Album Name" required>
                          <input type="file" name="photos[]" accept="image/*" multiple>

                        </div>
                          <button type="submit" class="btn btn-primary">Save</button>
                    </form>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
