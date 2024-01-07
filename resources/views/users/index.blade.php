




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
        <h1>Users:</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    @if (auth()->user()->isAdmin===1)
                    <th scope="col">delete</th>
                    <th scope="col">ban</th>
                    <th scope="col">make admin</th>
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
                      <form action="{{route('users.delete',$user->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">delete</button>
                    </form>
                    </td>
                    <td>
                      <form method="POST" action="{{route('users.ban',$user->id)}}">
                        @csrf
                        @method('put')
                        @if($user->ban===0)
                        <button type="submit" class="btn btn-danger">ban</button>
                        @else
                        <button type="submit" class="btn btn-danger">unban</button>
@endif
                      </form>
                    </td>
                    <td>
                      <form method="POST" action="{{route('users.makeAdmin',$user)}}">
                        @csrf
                        @method('put')
                        @if($user->isAdmin===0)
                        <button type="submit" class="btn btn-danger">make admin</button>
                        @else
                        <button type="submit" class="btn btn-danger">remove admin</button>
@endif
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