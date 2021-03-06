@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if(session('response'))
            <div class="alert alert-success">{{session('response')}}</div>
        @endif
            <div class="card text-center">
                <div class="card-header">Post View</div>

                <div class="card-body">
                    <div class="col-md-4">
                    <ul class="list-group">
                        @if(count($categories) > 0)
                            @foreach($categories->all() as $category)
                                <li class="list-group-item"><a href='{{ url("category/{$category->id}") }}'>{{$category->category}}</a></li>
                            @endforeach
                        @else
                            <p>No Category Found!</p>
                        @endif
                        
                    </ul>
                        
                        
                    </div>
                    <div class="col-md-8">
                    @if(count($posts) > 0)
                        @foreach($posts->all() as $post)
                            <h4>{{$post->post_title}}</h4>
                            <img src="{{ $post->post_image }}" alt="">
                            <p>{{ $post->post_body }}</p>

                            <ul class="nav nav-pills">
                                <li role="presentation" style="margin:10px;">
                                    <a href="{{ url("/like/{$post->id}") }}">
                                        <span class="glyphicon glyphicon-thumbs-up"><i class="far fa-thumbs-up"></i>   Like ({{$likeCtr}})    </span>
                                    </a>
                                </li>
                                <li role="presentation" style="margin:10px;">
                                    <a href="{{ url("/dislike/{$post->id}") }}">
                                        <span class="glyphicon glyphicon-thumbs-down"><i class="far fa-thumbs-down"></i>    Dislike ({{$dislikeCtr}})    </span>
                                    </a>
                                </li>
                                <li role="presentation" style="margin:10px;">
                                    <a href="{{ url("/comment/{$post->id}") }}">
                                        <i class="fas fa-comments">  Comments</i>
                                    </a>
                                </li>
                            </ul>

                            <cite style="float:left; margin-bottom: 10px;">Posted on: {{date('M j, Y H:i', strtotime($post->updated_at))}}</cite>

                            
                            
                        @endforeach
                    @else
                        <p>No Post Available!</p>
                    @endif

                    <form method="POST" action='{{ url("/comment/{$post->id}") }}'>
                       {{csrf_field()}}
                        <div class="form-group">
                            <textarea id="comment" rows="6" class="form-control" name="comment" required autofocus></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg"> POST COMMENT </button>
                        </div>
                    </form>

                    <h3>Comments</h3>
                    @if(count($comments) > 0)
                        @foreach($comments->all() as $comment)
                            <p>{{ $comment->comment }}</p>
                            <p>Posted by: {{ $comment->name }}</p>

                            <hr/>

                    @endforeach
                    @else
                        <p>No Post Available!</p>
                    @endif
                    </div>
                   

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
