@extends('cms.parent')
@section('title','User')
@section('main-content')

@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection


@section('page_name','Create')
@section('main_page','user')
@section('small_page_name','create')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{'Create User'}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" name="name_user" class="form-control" id="name" placeholder="name"
                        value="{{old('name_user')}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="user_email" class="form-control" id="email" placeholder="email"
                        value="{{old('user_email')}}">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="mobile"
                        value="{{old('mobile')}}">
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

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
    <!-- /.card -->


</div>


@endsection

@section('scripts')

<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    $(function () {bsCustomFileInput.init();});
</script>


<!-- Select2 -->
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Toastr -->
<script>
    function performStore(){

        let formData=new FormData();
        formData.append('name',document.getElementById('name').value);
        formData.append('email',document.getElementById('email').value);
        formData.append('mobile',document.getElementById('mobile').value);
        formData.append('image',document.getElementById('image_file').files[0]);


            axios.post('/cms/admin/users',formData)
            .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);

            window.location.href='/cms/admin/users'
            })
            .catch(function (error) {
            console.log(error);
            toastr.error(error.response.data.message);
            
            });


        }

</script>











@endsection