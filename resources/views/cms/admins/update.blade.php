@extends('cms.parent')
@section('title','Admins')
@section('main-content')

@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection


@section('page_name','Update')
@section('main_page','admin')
@section('small_page_name','update')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{'Update Admin'}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="name">admin Name</label>
                    <input type="text" name="name_admin" class="form-control" id="name" placeholder="name"
                        value="{{$admin->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="admin_email" class="form-control" id="email" placeholder="email"
                        value="{{$admin->email}}">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="mobile"
                        value="{{$admin->mobile}}">
                </div>

                <div class="form-group">
                    <label>Roles</label>
                    <select class="form-control roles " style="width: 100%;" id="role_id">

                        @foreach ($roles as $role )
                        <option value="{{$role->id}}" @if ($adminRoles->id==$role->id)
                            selected
                            @endif >{{$role->name}}</option>
                        @endforeach
                    </select>
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
                <button type="button" onclick="updateStore()" class="btn btn-primary">Save</button>
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
    function updateStore(){

let formData=new FormData();
formData.append('_method','PUT');
formData.append('name',document.getElementById('name').value);
formData.append('email',document.getElementById('email').value);
formData.append('role_id',document.getElementById('role_id').value);
formData.append('mobile',document.getElementById('mobile').value);
formData.append('image',document.getElementById('image_file').files[0]);




axios.post('/cms/admin/admins/{{$admin->id}}', formData)
.then(function (response) {
console.log(response);
toastr.success(response.data.message);


window.location.href='/cms/admin/admins'
})
.catch(function (error) {
console.log(error);
toastr.error(error.response.data.message);

});


}

</script>











@endsection