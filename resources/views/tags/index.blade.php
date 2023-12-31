

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
        <h1>Tags:</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">delete</th>
                    <th scope="col">update</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td>
                        {{$tag->id}}
                    </td>
                    <td>
                        {{$tag->name}}
                    </td>
                    <td>
                      <form method="POST" action="{{route('tags.destroy',$tag->id)}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">delete</button>

                      </form>
                    </td>
                    <td>
                      <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-danger">update</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        @endsection
    </main>
    
</body>
</html>