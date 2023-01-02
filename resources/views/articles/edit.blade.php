@extends("layouts.app")
@section('content')
<div class="container">

    <form action="" method="post">
        @csrf
        <div class="mb-2">
            <label for="">Title</label>
            <input type="text" name="title" class="form-control" value="{{$article->title}}">
        </div>

        <div class="mb-2">
            <label for="">Body</label>
            <textarea name="body"  class="form-control">{{$article->body}}</textarea>
        </div>

        <div class="mb-2">
            <label for="">Category</label>
            <select name="category_id" id="" class="form-select">
                @foreach ($category as $cat )
                <option value="{{$cat->id}}"{{$article->category_id == $cat->id ? 'selected' : ''}}>{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="Update Article"></input>
    </form>
</div>
@endsection
