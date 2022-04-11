@extends('cms.parent')
@section('title','Categories')
@section('main-content')




@section('page_name','Index')
@section('main_page','categories')
@section('small_page_name','index')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{'Categories'}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>SubCategories</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Update At</th>
                                    @canany(['Update-Category', 'Delete-Category'])
                                    <th>Settings</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $key => $category )
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$category->title}}</td>
                                    <td>{{$category->description}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success">SubCategories</button>
                                            <button type="button"
                                                class="btn btn-success dropdown-toggle dropdown-hover dropdown-icon"
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
                                    <td><span
                                            class="badge @if($category->status) bg-success @else bg-danger @endif">{{$category->active_status}}</span>
                                    </td>

                                    <td>{{$category->created_at}}</td>
                                    <td>{{$category->updated_at}}</td>
                                    @canany(['Update-Category', 'Delete-Category'])
                                    <td>
                                        <div class="btn-group">
                                            @can('Update-Category')
                                            <a href="{{route('categories.edit',[$category->id])}}"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('Delete-Category')
                                            <a href="#" onclick="confirmDelete('{{$category->id}}',this)"
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

     axios.delete('/cms/admin/categories/'+id)
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