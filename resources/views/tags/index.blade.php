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
        <div class="container text-center">
            <div class="row">
                @foreach ($tags as $tag)
                <div class="col">
                    <div class="card" style="width: 18rem; height:18rem;">
                        <div class="card-body">
                          <h5 class="card-title">{{$tag->name}}</h5>
                          <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-primary">update</a>
                          <form method="POST" action="{{route('tags.destroy',$tag->id)}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">delete</button>

                          </form>
                        </div>
                      </div>
                    </div>
                @endforeach
            </div>
          </div>

        @endsection
    </main>
    
</body>
</html>