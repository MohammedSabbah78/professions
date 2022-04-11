@extends('cms.parent')
@section('title','SubCategories')
@section('main-content')




@section('page_name','Index')
@section('main_page','subCategories')
@section('small_page_name','index')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{'SubCategories'}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Professions</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Update At</th>
                                    @canany(['Update-SubCategory', 'Delete-SubCategory'])
                                    <th>Settings</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($subCategories as $key => $subCategory )
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$subCategory->title}}</td>
                                    <td>{{$subCategory->description}}</td>
                                    <td>


                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success">Professions</button>
                                            <button type="button"
                                                class="btn btn-success dropdown-toggle dropdown-hover dropdown-icon"
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
                    </div>


                    </td>
                    <td> {{$subCategory->category->title}}</td>
                    <td><span
                            class="badge @if($subCategory->status) bg-success @else bg-danger @endif">{{$subCategory->active_status}}</span>
                    </td>

                    <td>{{$subCategory->created_at}}</td>
                    <td>{{$subCategory->updated_at}}</td>
                    @canany(['Update-SubCategory', 'Delete-SubCategory'])
                    <td>
                        <div class="btn-group">
                            @can('Update-SubCategory')
                            <a href="{{route('subCategories.edit',[$subCategory->id])}}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan
                            @can('Delete-SubCategory')
                            <a href="#" onclick="confirmDelete('{{$subCategory->id}}',this)" class="btn btn-danger">
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
            <!-- /.card -->







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

     axios.delete('/cms/admin/subCategories/'+id)
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