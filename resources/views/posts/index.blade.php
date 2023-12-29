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
                @foreach ($posts as $post)
                <div class="col">
                    <div class="card" style="width: 18rem; height:18rem;">
                        <img src="images\{{$post->img}}" class="card-img-top" style="width: 100%; height:100%; object-fit:cover;">
                        <div class="card-body">
                          <h5 class="card-title">{{$post->title}}</h5>
                          <p class="card-text">category:{{$post->Category->name}}</p>

                          <a href="{{route('posts.show',$post->id)}}" class="btn btn-primary">View</a>
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