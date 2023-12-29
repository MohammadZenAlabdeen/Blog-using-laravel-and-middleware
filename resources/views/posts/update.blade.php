<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        @extends('layout.nav')
    </header>
    <main>
        @section('content')
        <form class="row g-3" action="{{route('posts.update',$post->id)}}" method="POST" style="width: 80vw;margin:auto 50px;" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">title</label>
                <input type="text" class="form-control" id="inputEmail4" name="title" value="{{$post->title}}">
            </div>
            <div class="input-group">
                <span class="input-group-text">description</span>
                <textarea class="form-control" aria-label="With textarea" name="description">{{$post->description}}</textarea>
                </div>
                <div class="input-group mb-3">
                <input type="file" class="form-control" id="inputGroupFile02" name="img">
                <label class="input-group-text" for="inputGroupFile02">img</label>
                </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">tags</label>
                <select multiple="multiple" id="inputState" class="form-select" name="tag[]" >
                    {{$index=0;}}
                    @foreach ($post->Tag as $tag)
                    {{$array[$index]=$tag->id}} {{$index++}}
                    @endforeach
                    @foreach ($post->Tag as $tag)
                        <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                    @endforeach
                    @foreach ($tags as $t)
                    @if (!(in_array($t->id,$array)))
                        <option value="{{$t->id}}">{{$t->name}}</option>
                    @endif
                @endforeach
                    
            </select>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">category</label>
                <select id="inputState" class="form-select" name="category">
                    <option selected>{{$post->Category->name}}</option>
                    @foreach ($category as $cat)
                        <option>{{$cat->name}}</option>
                    @endforeach
            </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
        @endsection
    </main>
    
</body>
</html>