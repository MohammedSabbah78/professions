@extends('cms.parent')
@section('title','Roles')
@section('main-content')

@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"> --}}
@endsection


@section('page_name','Create')
@section('main_page','roles')
@section('small_page_name','create')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{'Create Role'}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
            @csrf
            <div class="card-body">




                <div class="form-group">
                    <label>User Type</label>
                    <select class="form-control guard_name " style="width: 100%;" id="guard_name">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Roles</label>
                    <input type="text" name="name_role" class="form-control" id="name" placeholder="Roles"
                        value="{{old('name_role')}}">
                </div>






            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
    <!-- /.card -->


</div>


@endsection

@section('scripts')
<!-- Select2 -->
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Toastr -->
<script>
    //Initialize Select2 Elements
    // $('.select2').select2()
    
    //Initialize Select2 Elements
$('.guard_name').select2({
    theme: 'bootstrap4'
    });


        function performStore(){
            axios.post('/cms/admin/roles', {
               name: document.getElementById('name').value,
               guard_name: document.getElementById('guard_name').value,

            })
            .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);

            window.location.href='/cms/admin/roles'
            })
            .catch(function (error) {
            console.log(error);
            toastr.error(error.response.data.message);
            
            });


        }

</script>

@endsection