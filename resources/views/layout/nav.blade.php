<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('style.css')}}"  rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    @section('navbar')
    @show
    
      <div class="wrapper">
        @if (auth()->check())
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Blog Dashboard</h3>
            </div>

            <ul class="list-unstyled components">
              @if (auth()->check())
              <a class="navbar-brand" href="{{route('posts.index')}}">Task04</a>
              @else
              <a class="navbar-brand" href="{{route('user.showlogin')}}">Task04</a>
              @endif
              @if (auth()->check())
                <li class="active">
                    <ul class="list-unstyled" id="homeSubmenu">
                      <li class="nav-item">
                        <a href="{{route('category.index')}}" class="nav-link" type="submit">categories</a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('users.showAll')}}" class="nav-link" type="submit">users</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('posts.index')}}">posts</a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('tags.index')}}" class="nav-link" type="submit">tags</a>
                      </li>
                      @if (auth()->user()->isAdmin===1)
                      <li class="nav-item">
                        <a href="{{route('users.trash')}}" class="nav-link" type="submit">user trash</a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('posts.showArchive')}}" class="nav-link" type="submit">posts archive</a>
                      </li>
                      @endif
                    </ul>
                </li>
                <li>
                    <ul class="list-unstyled" id="pageSubmenu">
                      @if (auth()->user()->isAdmin===1)
                      <li class="nav-item">
                        <a href="{{route('tags.create')}}" class="nav-link active" aria-current="page">Create a tag</a>
                  </li>
                      <li class="nav-item">
                        <a href="{{route('category.create')}}" class="nav-link active" aria-current="page">Create a category</a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('user.showregister')}}" class="nav-link" type="submit">create a user</a>
                  </li>
                  @endif
                    </ul>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
              <form method="post" action="{{route('logout')}}">
                @method('post')
                @csrf
                <li class="nav-item">
                  <button class="nav-link" type="submit">Log out</button>
                </li>
  
              </form>
            </ul>
            @endif

        </nav>
        @endif
        <!-- Page Content  -->
        <div id="content">
@if (auth()->check())
  

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                          @if (auth()->check())
                          <a class="navbar-brand" href="{{route('posts.index')}}">Task04</a>
                          @else
                          <a class="navbar-brand" href="{{route('user.showlogin')}}">Task04</a>
                          @endif
                          <li class="nav-item">
                            <span class="nav-link">
                              {{auth()->user()->name}}
                            </span>
                          </li>
                        </ul>
                    </div>
                </div>
            </nav>
            @endif

    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="{{asset('side.js')}}"></script>
</body>
</html>