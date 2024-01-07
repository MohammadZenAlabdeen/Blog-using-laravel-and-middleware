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
    <section class="vh-100 gradient-custom">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
    
                <div class="mb-md-5 mt-md-4 pb-5">
                <form method="POST" action="{{route('user.register')}}" enctype="multipart/form-data">
                    @csrf
                    <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                    <p class="text-white-50 mb-5">Please enter your data</p>
      
                    <div class="form-outline form-white mb-4">
                      <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email"/>
                      <label class="form-label" for="typeEmailX">Email</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                      <input type="text" class="form-control form-control-lg" name="name"/>
                      <label class="form-label" for="typeEmailX">username</label>
                    </div>
      
                    <div class="form-outline form-white mb-4">
                      <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" />
                      <label class="form-label" for="typePasswordX">Password</label>
                    </div>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="inputGroupFile02" name="img">
                      <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
    
      
                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Register</button>
    
      
                </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
</main>


</body>
</html>