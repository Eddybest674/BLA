@extends('layouts.app')

@section('content')
     <a href="/post"class="btn btn-sm btn-secondary">Go Back</a>
     <h3>Edit Post</h3> 

     <form action="{{url('post/'. $posts->id)}}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @method('PATCH')
        <label for="title">Title:</label>
        <input  class="form-control" type="text"  value="{{$posts->title}}" name="title" id="name" width="45px" >
        <br>
        <label for="body">Body:</label>
        
        <textarea type="text"  class="form-control"  name="body"  rows="10" cols="10">{{$posts->body}}</textarea>

        <label class="form-label" width:90px;>Article's Image</label><br>
        <input class="form-group" type="file"   aria-describedby="emailHelp" name="cover_image">
    

        
        <br>
        <input class="btn btn-sm btn-primary" type="submit" value="Update">
    </form>
    
     
@endsection




