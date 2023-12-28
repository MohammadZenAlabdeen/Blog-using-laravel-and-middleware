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
                @if (auth()->user()->id===$post->user_id||auth()->user()->isAdmin===1)
                <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">delete</button>
                </form>
                @endif
                @if (auth()->user()->id===$post->user_id)
                <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary">update</a>
                @endif

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
                                        @if ($comment->User->id===auth()->User()->id)
                                        <a type="button" class="btn btn-info" href="{{route('comment.edit',$comment->id)}}">update</a>
                                        @endif
                                        @if ($comment->User->id===auth()->User()->id||$post->user_id===auth()->user()||auth()->user()->isAdmin===1)
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
            <form method="POST" action="{{route('comment.store',$post->id)}}">
                @csrf
                <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                    <div class="d-flex flex-start w-100">
                      <img class="rounded-circle shadow-1-strong me-3"
                        src="{{ URL::to('/') }}/images/{{auth()->User()->img}}" alt="avatar" width="40"
                        height="40" />
                      <div class="form-outline w-100">
                        <textarea class="form-control" id="textAreaExample" rows="4"
                          style="background: #fff;" name="content"></textarea>
                        <label class="form-label" for="textAreaExample">Message</label>
                      </div>
                    </div>
                    <div class="float-end mt-2 pt-1">
                      <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
                    </div>
                </div>
            </form>
      
    </div>
        @endsection
    </main>
</body>
</html>