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
        @section('content')
    <form method="POST" action="{{route('comment.update',$comment->id)}}">
        @csrf
        @method('put')
        <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
            <div class="d-flex flex-start w-100">
              <div class="form-outline w-100">
                <textarea class="form-control" id="textAreaExample" rows="4"
                  style="background: #fff;" name="content">{{$comment->content}}</textarea>
                <label class="form-label" for="textAreaExample">Message</label>
              </div>
            </div>
            <div class="float-end mt-2 pt-1">
              <button type="submit" class="btn btn-primary btn-sm">update comment</button>
            </div>
        </div>
    </form>
    @endsection
</body>
</html>