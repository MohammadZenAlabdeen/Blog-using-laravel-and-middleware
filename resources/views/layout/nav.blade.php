<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    @section('navbar')
    @show
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          @if (auth()->check())
          <a class="navbar-brand" href="{{route('posts.index')}}">Task03</a>
          @else
          <a class="navbar-brand" href="{{route('user.showlogin')}}">Task03</a>
          @endif

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

            @if (auth()->check())
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{route('posts.index')}}">Home</a>
            </li>
            <form method="post" action="{{route('logout')}}">
              @method('post')
              @csrf
              <li class="nav-item">
                <button class="nav-link" type="submit">Log out</button>
              </li>
            </form>
            <li class="nav-item">
              <a href="{{route('category.index')}}" class="nav-link" type="submit">categories</a>
            </li>
            <li class="nav-item">
              <a href="{{route('tags.index')}}" class="nav-link" type="submit">tags</a>
            </li>
            <li class="nav-item" style="width: 50px; height:50px;border:none;border-radius:50%;">
              <img src="/images/{{auth()->user()->img}}" style="width:100%;height:100%; border-radius:50%;">
            </li>
            <li class="nav-item" style="display: flex; justify-content:center;align-items:center; text-align:center; margin-left:15px;">
              <span>{{auth()->user()->name}}</span>
            </li>
            <li class="nav-item">
                  <a href="{{route('posts.create')}}" class="nav-link active" aria-current="page">Create a post</a>
            </li>
            @if (auth()->user()->isAdmin===1)
            <li class="nav-item">
              <a href="{{route('tags.create')}}" class="nav-link active" aria-current="page">Create a tag</a>
        </li>
            <li class="nav-item">
              <a href="{{route('category.create')}}" class="nav-link active" aria-current="page">Create a category</a>
        </li>
            @endif


              
            @endif
              
            

            </ul>
          </div>
        </div>
      </nav>

    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>