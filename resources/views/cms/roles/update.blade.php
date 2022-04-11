@extends('cms.parent')
@section('title','Role')
@section('main-content')

@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"> --}}
@endsection


@section('page_name','Update')
@section('main_page','roles')
@section('small_page_name','update')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{'Update Roles'}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf
            <div class="card-body">




                <div class="form-group">
                    <label>User Type</label>
                    <select class="form-control user_type " style="width: 100%;" id="guard_name">
                        <option value="admin" @if ($role->guard_name =='admin')
                            selected
                            @endif>Admin</option>
                        <option value="user" @if ($role->guard_name =='user')
                            selected
                            @endif>User</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Roles</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="{{__('cms.roles')}}"
                        value="{{$role->name}}">
                </div>






            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performUpdate()" class="btn btn-primary">Save</button>
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


    function performUpdate() {
        axios.put('/cms/admin/roles/{{$role->id}}', {
                name: document.getElementById('name').value,
                guard_name: document.getElementById('guard_name').value,

            })
            .then(function(response) {
                console.log(response);
                toastr.success(response.data.message);
                window.location.href='/cms/admin/roles';


            })
            .catch(function(error) {
                console.log(error);
                toastr.error(error.response.data.message);

            });


    }
</script>

@endsection