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
        <div class="container-md">
            <div class="g-col-12">
                <img src="{{ URL::to('/') }}/images/{{$post->img}}" class="card-img-top" style="width: 100%; height:30rem; object-fit:cover;">
            </div>
            <div class="g-col-12">
              <form action="{{route('posts.archive',$post)}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">archive</button>
            </form>
{{--                 @if (auth()->user()->isAdmin==1)
                <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary">Archive</a>
                @endif --}}

                <p class="h1">{{$post->title}} category:{{$post->Category->name}}<br></p>
                <p class="h2">{{$post->description}}<br></p>
                @foreach ($post->Tag as $tag)
                <span><abbr title="HyperText Markup Language" class="initialism">{{$tag->name}}</abbr></span>
                @endforeach
            </div>
            <div class="g-col-12">
                    @foreach ($comments as $comment)
                    <section style="background-color: #eee;">
                        <div class="container my-5 py-5">
                          <div class="row d-flex justify-content-center">
                            <div class="col-md-12 col-lg-10 col-xl-8">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex flex-start align-items-center">

                                    <img class="rounded-circle shadow-1-strong me-3"
                                      src="{{ URL::to('/') }}/images/{{$comment->User->img}}" alt="avatar" width="60"
                                      height="60" />
                                    <div>
                                      <h6 class="fw-bold text-primary mb-1">{{$comment->User->name}}</h6>
                                    </div>
                                    <div>
                                        @if (auth()->user()->isAdmin===1)
                                        <form method="POST" action="{{route('comment.destroy',$comment->id)}}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-dark">delete</button>
                                        </form>
                                        @endif
                                    </div>
                                  </div>
                      
                                  <p class="mt-3 mb-4 pb-2">
                                        {{$comment->content}}
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                    @endforeach
            </div>      
    </div>
        @endsection
    </main>
</body>
</html>