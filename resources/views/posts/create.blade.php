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
        <form class="row g-3" action="{{route('posts.store')}}" method="POST" style="width: 80vw;margin:auto 50px;" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">title</label>
                <input type="text" class="form-control" id="inputEmail4" name="title">
            </div>
            <div class="input-group">
                <span class="input-group-text">description</span>
                <textarea class="form-control" aria-label="With textarea" name="description"></textarea>
                </div>
                <div class="input-group mb-3">
                <input type="file" class="form-control" id="inputGroupFile02" name="img">
                <label class="input-group-text" for="inputGroupFile02">img</label>
                </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">tags</label>
                <select multiple="multiple" id="inputState" class="form-select" name="tag[]" >
                    @foreach ($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
            </select>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">category</label>
                <select id="inputState" class="form-select" name="category">
                    @foreach ($category as $cat)
                        <option>{{$cat->name}}</option>
                    @endforeach
            </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>
        @endsection
    </main>
    
</body>
</html>