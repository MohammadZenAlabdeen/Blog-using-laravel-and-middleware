


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
        <h1>Categories:</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">delete</th>
                    <th scope="col">update</th>
                    <th scope="col">show</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($category as $cat)
                <tr>
                    <td>
                        {{$cat->id}}
                    </td>
                    <td>
                        {{$cat->name}}
                    </td>
                    <td>
                      <form method="POST" action="{{route('category.destroy',$cat->id)}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">delete</button>

                      </form>
                    </td>
                    <td>
                      <a href="{{route('category.edit',$cat->id)}}" class="btn btn-danger">update</a>
                    </td>
                    <td>
                      <a href="{{route('category.show',$cat->id)}}" class="btn btn-danger">show</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        @endsection
    </main>
    
</body>
</html>