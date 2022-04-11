@extends('cms.parent')
@section('title','Admins')
@section('main-content')




@section('page_name','Index')
@section('main_page','admin')
@section('small_page_name','index')

<section class="content">
    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                @foreach ($admins as $admin )
                <!-- /.col -->
                <div class="col-md-6">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header text-white"
                            style="background: url('../dist/img/photo1.png') center center;">
                            <h3 style="color: rgb(255, 255, 255)" class="widget-user-username text-right">
                                {{$admin->name}}</h3>
                            <h5 class="widget-user-desc text-right">{{$admin->email}}</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">Mobile</h5>
                                        <span class="description-text">{{$admin->mobile}}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-2 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">Verify</h5>
                                        <span
                                            class="badge @if($admin->email_verified_at ==null) bg-danger @else bg-success @endif">{{$admin->email_verified}}
                                        </span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>

                                <!-- /.col -->
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">Role</h5>
                                        <span class="description-text">{{$admin->roles[0]->name}}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                @canany(['Update-Admin', 'Delete-Admin'])
                                <div class="col-sm-3">
                                    <div class="description-block">
                                        <h5 class="description-header">Settings</h5>
                                        <span class="description-text">

                                            <div class="btn-group">
                                                @can('Update-Admin')
                                                <a href="{{route('admins.edit',[$admin->id])}}" class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can('Delete-Admin')
                                                @if (auth('admin')->user()->id != $admin->id)
                                                <a href="#" onclick="confirmDelete('{{$admin->id}}',this)"
                                                    class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                @endif
                                                @endcan




                                            </div>

                                        </span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                @endcanany

                                {{-- <div class="btn-group">
                                    @can('Update-Admin')
                                    <a href="{{route('admins.edit',[$admin->id])}}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('Delete-Admin')
                                    @if (auth('admin')->user()->id != $admin->id)
                                    <a href="#" onclick="confirmDelete('{{$admin->id}}',this)" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    @endif
                                    @endcan




                                </div> --}}
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
                <!-- /.col -->
                @endforeach
            </div>
            <!-- /.row -->


            {{-- <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{'Admins'}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Role</th>
                                            <th>Created At</th>
                                            <th>Update At</th>
                                            @canany(['Update-Admin', 'Delete-Admin'])
                                            <th>Settings</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($admins as $admin )
                                        <tr>
                                            <td>{{$admin->id}}</td>
                                            <td><img width="60" height="60" src="{{Storage::url($admin->image)}}">
                                            </td>
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->email}}</td>
                                            <td>{{$admin->mobile}}</td>
                                            <td>{{$admin->roles[0]->name}}</td>
                                            <td>{{$admin->created_at}}</td>
                                            <td>{{$admin->updated_at}}</td>

                                            @canany(['Update-Admin', 'Delete-Admin'])
                                            <td>
                                                <div class="btn-group">
                                                    @can('Update-Admin')
                                                    <a href="{{route('admins.edit',[$admin->id])}}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @endcan
                                                    @can('Delete-Admin')
                                                    @if (auth('admin')->user()->id != $admin->id)
                                                    <a href="#" onclick="confirmDelete('{{$admin->id}}',this)"
                                                        class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    @endif
                                                    @endcan




                                                </div>

                                            </td>
                                            @endcanany

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->


                            <!-- /.card --> --}}

                        </div>
                    </div>
                </div>




</section>


@endsection
@section('styles')
@endsection
@section('scripts')
<script>
    function confirmDelete(id,element){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            performDelete(id,element);

        }
        })

    }


function performDelete(id,element){

     axios.delete('/cms/admin/admins/'+id)
        .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);
        element.closest('tr').remove();

                 
        })
        .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.message);
        
        });

}

</script>



@endsection