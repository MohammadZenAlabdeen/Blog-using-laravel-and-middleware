<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <head>
        @extends('layout.nav')
    </head>
    @section('content')
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
              
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                  <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <form method="POST" action="{{route('tags.store')}}">
                          @method('post')
                          @csrf
                          <div class="mb-md-5 mt-md-4 pb-5">
                            <h2 class="fw-bold mb-2 text-uppercase">tags</h2>
                        <p class="text-white-50 mb-5">Please enter tag name!</p>
          
                        <div class="form-outline form-white mb-4">
                          <input type="text" id="name" class="form-control form-control-lg" name="name"/>
                          <label class="form-label" for="name">tag name</label>
                        </div>
          
        
          
                        <button class="btn btn-outline-light btn-lg px-5" type="submit">create</button>
                    </form>
          
                      </div>
          
                  </div>
                </div>
              </div>
            </div>
          </section>
  
    @endsection
    
</body>
</html>