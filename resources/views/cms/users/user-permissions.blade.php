@extends('cms.parent')
@section('title',__('cms.permissions'))
@section('main-content')

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

@endsection


@section('page_name','Permission User')
@section('main_page','Permission')
@section('small_page_name','index')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{('Permissions')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>User Type</th>
                                    <th>Assigned</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($permissions as $permission )
                                <tr>
                                    <td>{{$permission->name}}</td>
                                    <td><span class="badge  bg-info  ">{{$permission->guard_name}}</span></td>
                                    <td>
                                        <div class="icheck-success d-inline">
                                            <input type="checkbox" @if ($permission->assigned) checked @endif

                                            onchange="updateUserPermission('{{$permission->id}}')"
                                            id="permission{{$permission->id}}">
                                            <label for="permission{{$permission->id}}">
                                            </label>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->







</section>


@endsection
@section('styles')
@endsection
@section('scripts')
<script>
    function updateUserPermission(permissionId){

     axios.put('/cms/admin/users/{{$users->id}}/permissions',{
            user_id:'{{$users->id}}',
            permission_id:permissionId
 

     })
        .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);

                 
        })
        .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.message);
        
        });

}

</script>



@endsection