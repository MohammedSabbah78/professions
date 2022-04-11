@extends('cms.parent')
@section('title','Users')
@section('main-content')




@section('page_name','index')
@section('main_page','users')
@section('small_page_name','index')

{{-- <section class="content"> --}}








    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row">
                    @foreach ($users as $user )
                    <div id="card{{$user->id}}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                <strong style="color: rgb(0, 0, 117)"> {{$user->name}}</strong>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>User Id is {{$user->id}}</b></h2>
                                        <p class="text-muted text-sm"><b>Created: </b>{{$user->created_at}} </p>
                                        <p class="text-muted text-sm"><b>Updated: </b>{{$user->updated_at}} </p>
                                        <p class="text-muted text-sm"><b>Verify Email: </b>
                                            <span
                                                class="badge @if($user->email_verified_at ==null) bg-danger @else bg-success @endif">{{$user->email_verified}}
                                            </span>

                                        </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fa fa-envelope-o"></i></span> {{$user->email}}</li>
                                            <li><br> </li>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-phone"></i></span> Phone #:{{$user->mobile}}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="{{Storage::url($user->image)}}" alt="user-avatar"
                                            class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer row">
                                <div class="text-left">
                                    <a href="#" onclick="confirmDelete('{{$user->id}}',card{{$user->id}})"
                                        class="btn btn-sm bg-red">
                                        <i class="fas fa-remove"></i>
                                    </a>
                                    <a href="{{route('users.edit',[$user->id])}}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i> Edit
                                    </a>
                                    <a></a>

                                    <a class="btn btn-app bg-info" href="{{route('user.edit-permissions',$user->id)}}">
                                        <span class="badge bg-green">{{$user->permissions_count}}</span>
                                        <i class="fas fa-users"></i> Permissions
                                    </a>
                                </div>
                                < </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->

    </section>





    {{-- <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
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
                                    <th>Permissions</th>
                                    <th>Created At</th>
                                    <th>Update At</th>
                                    @canany(['Update-User', 'Delete-User'])
                                    <th>Settings</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user )
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td><img width="60" height="60" src="{{Storage::url($user->image)}}"></td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->mobile}}</td>

                                    <td>
                                        <a class="btn btn-app bg-info"
                                            href="{{route('user.edit-permissions',$user->id)}}">
                                            <span class="badge bg-green">{{$user->permissions_count}}</span>
                                            <i class="fas fa-users"></i> Permissions
                                        </a>
                                    </td>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->updated_at}}</td>
                                    @canany(['Update-User', 'Delete-User'])
                                    <td>
                                        <div class="btn-group">
                                            @can('Update-User')
                                            <a href="{{route('users.edit',[$user->id])}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('Delete-User')
                                            <a href="#" onclick="confirmDelete('{{$user->id}}',this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
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

                </div>
                <!-- /.card --> --}}







                {{--
</section> --}}


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

     axios.delete('/cms/admin/users/'+id)
        .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);
        $( element ).remove();
                 
        })
        .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.message);
        
        });

}

</script>



@endsection