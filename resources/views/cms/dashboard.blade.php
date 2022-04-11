@extends('cms.parent')
@section('title','Main')
@section('main-content')
@section('styles')
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection



@section('page_name','DashBoard')
@section('main_page','dashborad')
@section('small_page_name','main')



<!-- Main content -->
@hasrole('Super-Admin')

<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$categoriesCount}}</h3>

                        <p> <strong>All Categories</strong></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('categories.index')}}" class="small-box-footer">See All <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$subCategoriesCount}}</h3>

                        <p> <strong>All SubCategories</strong></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('subCategories.index')}}" class="small-box-footer">See All<i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$professionsCount}}<sup style="font-size: 20px"></sup></h3>

                        <p><strong>All Professions</strong></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('professions.index')}}" class="small-box-footer">See All<i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$userCount}}</h3>

                        <p> <strong>User Registrations</strong></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('users.index')}}" class="small-box-footer">See All <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                ID
                            </th>
                            <th style="width: 20%">
                                User Name
                            </th>
                            <th style="width: 30%">
                                User Email
                            </th>
                            <th style="width: 10%">
                                User Mobile
                            </th>
                            <th style="width: 10%" class="text-center">
                                Email Verify </th>
                            <th style="width: 20%" class="text-center">
                                Created At </th>
                            <th style="width: 20%" class="text-center">
                                Updated At </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>

                            <td>
                                {{++$key}}
                            </td>
                            <td>
                                <a>
                                    {{$user->name}}
                                </a>

                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            <td class="project_progress">
                                {{$user->mobile}}
                            </td>
                            <td class="project-state">
                                <span
                                    class="badge @if($user->email_verified_at ==null) bg-danger @else bg-success @endif">{{$user->email_verified}}
                                </span>
                            </td>
                            <td class="project-state">

                                <h6>{{$user->date}}</h6>
                            </td>
                            <td class="project-state">

                                <h6>{{$user->updated_at->diffForHumans()}}</h6>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admins</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>Admin Name</th>
                                <th>Email</th>
                                <th>Email Verify</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $key =>$admin )
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->email}}</td>
                                <td><span
                                        class="badge @if($admin->email_verified_at ==null) bg-danger @else bg-success @endif">{{$admin->email_verified}}
                                    </span></td>
                                <td>
                                    <h6>{{$admin->date}}</h6>
                                </td>
                                <td>
                                    <h6>{{$admin->updated_at->diffForHumans()}}</h6>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Categories</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">ID</th>
                                            <th>Title</th>
                                            <th>SubCategories</th>
                                            <th>Status</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $key =>$category )
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$category->title}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-warning">SubCategories</button>
                                                    <button type="button"
                                                        class="btn btn-warning dropdown-toggle dropdown-hover dropdown-icon"
                                                        data-toggle="dropdown">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        @foreach ($category->subCategories as $subCategory)
                                                        <a class="dropdown-item"
                                                            href="{{route('subCategories.index')}}">{{$subCategory->title}}</a>
                                                        @endforeach


                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Count
                                                            is:<strong> {{$category->sub_categories_count}}</strong></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge @if($category->status) bg-success @else bg-danger @endif">{{$category->active_status}}</span>
                                            </td>
                                            <td>
                                                <h6>{{$category->updated_at->diffForHumans()}}</h6>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->


                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">SubCategories</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">Id</th>
                                            <th>Title</th>
                                            <th>Professions</th>
                                            <th>Status</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subCategories as $key => $subCategory )
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$subCategory->title}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Professions</button>
                                                    <button type="button"
                                                        class="btn btn-info dropdown-toggle dropdown-hover dropdown-icon"
                                                        data-toggle="dropdown">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        @foreach ($subCategory->professions as $profession)
                                                        <a class="dropdown-item"
                                                            href="{{route('professions.index')}}">{{$profession->name}}</a>
                                                        @endforeach


                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Count
                                                            is:<strong> {{$subCategory->professions_count}}</strong></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge @if($subCategory->status) bg-success @else bg-danger @endif">{{$subCategory->active_status}}</span>
                                            </td>
                                            <td>
                                                <h6>{{$category->updated_at->diffForHumans()}}</h6>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->


                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <div class="col-md-12">
            <div class="card table-responsive p-0">
                <div class="card-header">
                    <h3 class="card-title">Professions</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Category</th>
                                <th>SubCategory</th>
                                <th>Specialization</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($professions as $key =>$profession )
                            <tr>

                                <td>{{++$key}}</td>
                                <td>{{$profession->name}}</td>
                                <td>
                                    {{$profession->mobile}}
                                </td>

                                <td>{{$profession->email}}</td>
                                <td><span
                                        class="badge @if($profession->gender =='M') bg-success @else bg-warning @endif">{{$profession->gender_type}}
                                    </span></td>
                                <td>{{$profession->subCategory->title}}</td>
                                <td>{{$profession->subCategory->category->title}}</td>
                                <td>{{$profession->specialization}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
<!-- /.content -->

@endhasrole


@endsection
@section('styles')
@endsection
@section('scripts')




@endsection