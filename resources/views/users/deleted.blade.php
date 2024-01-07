
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
        <h1>Deleted Users:</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    @if (auth()->user()->isAdmin===1)
                    <th scope="col">delete</th>
                    <th scope="col">restore</th>
                    @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>
                        {{$user->id}}
                    </td>
                    <td>
                        {{$user->name}}
                    </td>
                    @if(auth()->user()->isAdmin===1)
                    <td>
                      <form action="{{route('users.destroy',$user->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">force delete</button>
                    </form>
                    </td>
                    <td>
                      <form action="{{route('users.restore',$user->id)}}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-danger">restore</button>
                    </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            </table>
        @endsection
    </main>
    
</body>
</html>