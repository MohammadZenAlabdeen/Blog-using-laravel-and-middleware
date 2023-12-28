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
                <div class="container-md">
                    <div class="g-col-12">
                        <img src="{{ URL::to('/') }}/images/{{$category->img}}" class="card-img-top" style="width: 100%; height:30rem; object-fit:cover;">
                    </div>
                    <div class="g-col-12">
                        @if (auth()->user()->isAdmin===1)
                        <form action="{{route('category.destroy',$category->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">delete</button>
                        </form>
                        @endif
                        @if (auth()->user()->isAdmin===1)
                        <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary">update</a>
                        @endif
        
                        <p class="h1">{{$category->name}}</p>
                    </div>
            </div>
          </div>

        @endsection
    </main>
    
</body>
</html>