@extends('layouts.app')

@section('content')
     <a href="/post"class="btn btn-sm btn-secondary">Go Back</a><br><br>
     <h2>{{$posts->title}}</h2>
     <img style="width:20%" src='../storage/cover_images/{{$posts->cover_image}}'>
     <br>
     <br>
     <br>
     <div class="container">
        <p>{{$posts->body}}</p>    
     </div>
     <hr>
     <h6><small>written on {{$posts->created_at}} by {{$posts->user->name}}</small></h6>
     
     
     <hr>
     @if (!Auth::guest())
     @if (Auth::user()->id == $posts->user_id)
     <a href="/post/{{$posts->id}}/edit" class="btn btn-sm btn-primary">Edit</a>
     <form method="POST" action="{{ url('/post' . '/' . $posts->id) }}" accept-charset="UTF-8" style="display:inline">
      {{ method_field('DELETE') }}
      {{ csrf_field() }} 
      <button type="submit" class="btn btn-sm btn-danger" title="Delete Post" onclick="return confirm(&quot;Confirm delete ?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
  </form>
     @endif 
     
      
    
     @endif
       
@endsection


