<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Site</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</head>
<body>
<h1 class="text-center text-primary">Form Login</h1>
<div class="container d-flex justify-content-center align-center w-100">
    <form action="/afterLogin" method="post" class="d-block w-50">
        @csrf
        <div class="form-group">
            <label for="" class="form-label">Email:</label>
            <input type="email" name="email" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="" class="form-label">Password:</label>
            <input type="password" name="password" id="" class="form-control">
        </div>
        <div class="form-group mt-5">
            <input type="submit" value="Đăng Nhập" class="btn btn-primary">
        </div>
    </form>
</div>
</body>
</html>