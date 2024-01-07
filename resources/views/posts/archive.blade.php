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
        <h1>Posts archive:</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">user</th>
                    <th scope="col">title</th>
                    <th scope="col">delete</th>
                    <th scope="col">restore</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>
                        {{$post->id}}
                    </td>
                    <td>
                        {{$post->User->name}}
                    </td>
                    <td>
                        {{$post->title}}
                    </td>
                    <td>
                        <form method="post" action="{{route('posts.destroy',$post->id)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"> delete</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{route('posts.restore',$post->id)}}">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-light">restore</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        @endsection
    </main>
    
</body>
</html>