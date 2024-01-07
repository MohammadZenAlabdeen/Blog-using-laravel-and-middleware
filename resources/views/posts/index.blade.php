
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
        <h1>Posts:</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">user</th>
                    <th scope="col">title</th>
                    <th scope="col">archive</th>
                    <th scope="col">show</th>

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
                        <form method="post" action="{{route('posts.archive',$post->id)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"> archive</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{route('posts.show',$post)}}" class="btn btn-info">show</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        @endsection
    </main>
    
</body>
</html>