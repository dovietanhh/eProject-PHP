<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login for User</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
</head>
<body>
<div class="login1">
<h1 class="text-center">Sign in</h1>
<div class="row w-50 m-auto">
    <div class="col-md-12">
        <form action="/Customer/SignIn" method="post">
            @csrf
            <div class="form-group">
                <label for="" class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" id="">
            </div>
            <div class="form-group mt-3">
                <label for="" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" id="">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Login</button>
        </form>
    </div>
</div>
@if(count($errors) > 0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{ $error }}</div>
@endforeach
@endif
</div>
</body>
</html>