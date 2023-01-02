@extends("layouts.app")
@section("content")
<div class="container">
    @if(session("info"))
    <div class="alert alert-info">
        {{session("info")}}
    </div>
    @endif
    <div class="card mb-2 border-black">
        <div class="card-body">
            <h3 class="card-title">{{$article->title}}</h3>
        <div>
            <small class="text-muted">
                Comments: ({{count($article->comments)}}),
                Category: <b>{{$article->category->name}}</b>,
                {{$article->created_at}}
            </small>
    </div>
    <div>{{$article->body}}</div>
    @can('article-delete',$article)
    <div class="my-2">
        <a href="{{url("/articles/delete/$article->id")}}" class="btn btn-danger">Delete</a>
        <a href="{{url("/articles/edit/$article->id")}}" class="card-link btn btn-primary text-white">Edit</a>
    </div>
    @endcan
</div>
</div>
<hr>

<ul class="list-group">
    <li class="list-group-item bg-primary text-white">
        <b>Comments ({{count($article->comments)}})</b>
    </li>
    @foreach ($article->comments as $comment)
        <li class="list-group-item">
            @auth
            @can('comment-delete',$comment)
            <a href="{{url("/comments/delete/$comment->id")}}" class="btn-close float-end"></a>
            @endcan

            @endauth

            <b class="text-success">
                {{$comment->user->name}}
            </b>
            {{$comment->content}}
        </li>


    @endforeach
</ul>
{{-- @if (session("info"))
<div class="alert alert-success">
    {{session("info")}}
</div>
@endif --}}

@auth
<form action="{{url("/comments/add")}}" method="post" class="mt-2">
@csrf
<input type="hidden" name="article_id" value="{{$article->id}}">
<textarea name="content" class="mb-2 form-control"></textarea>
<button class="btn btn-secondary">Add Comment</button>
</form>
@endauth

</div>
@endsection
