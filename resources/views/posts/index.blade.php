@extends('layouts.app')

@section('content')


     <h2>Blog Posts</h2><br>
@foreach ($posts as $post)     
<div  class="container" >

  <div  class="row align-items-stretch justify-content-start card-deck" style="display:grid;">
    <div class="card" >
      <img src="storage/cover_images/{{$post->cover_image}}"/>
      <div class="card-body">
        <h5 class="card-title"><a href="/post/{{$post->id}}">{{$post->title}}</a></h5>
        <p class="card-text">written on {{$post->created_at}} by {{$post->user->name}}</p>
      </div>
    </div>
  </div><br> <br>
</div>
@endforeach 

 
     
     {{$posts->links()}}
     
@endsection

