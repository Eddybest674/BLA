@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                   <p> <ul class="btn btn-sm btn-warning">
                        <li><a href="/post/create">Create Post</a></li> 
                    
                    </ul></p>

                    <p><h3>Your Blog posts</h3></p>
                    <table class="table table-striped">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($posts as $post)
                        
                        <tr>
                            <td>{{$post->title}}</td>
                            <td><a href="/post/{{$post->id}}/edit" class="btn btn-sm btn-primary">Edit</a></td>
                            <td><form method="POST" action="{{ url('/post' . '/' . $post->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Post" onclick="return confirm(&quot;Confirm delete ?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                               </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
