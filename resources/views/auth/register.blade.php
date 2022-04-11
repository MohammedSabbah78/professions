<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
  <!-- Tostar style -->
  <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
  <!-- Icon Page -->
  <link rel="icon" type="image/x-icon" href="{{asset('cms\dist\img\AdminLTELogo.png')}}">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a class="h1">Occupational management</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign Up to start your session</p>

        <form>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Name" id="name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" id="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="tel" class="form-control" placeholder="Mobile" id="mobile">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" id="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="image_file">Image</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image_file">
                <label class="custom-file-label" for="image_file">Choose file</label>
              </div>

            </div>
          </div>
        </form>


        <div class="col-12">
          <button type="button" onclick="performRegister()" class="btn btn-primary btn-block">Register</button>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>

  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>

  <script>
    function performRegister(){

let formData=new FormData();
formData.append('mobile',document.getElementById('mobile').value);
formData.append('name',document.getElementById('name').value);
formData.append('email',document.getElementById('email').value);
formData.append('password',document.getElementById('password').value);
formData.append('image',document.getElementById('image_file').files[0]);


            axios.post('/cms/register',formData)
            .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);

            window.location.href='/cms/user/login';

            })
            .catch(function (error) {
            console.log(error);
            toastr.error(error.response.data.message);
            
            });


         }

  </script>


</body>

</html>