@extends('cms.parent')
@section('title','Index')
@section('main-content')




@section('page_name','Professions')
@section('main_page','professions')
@section('small_page_name','index')

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="card-title">Professions Management</h4>
                </div>
                <div class="card-body">

                    <div class="btn-group w-100 mb-2">
                        <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> All Professions
                        </a>
                        @foreach ($categories as $category )
                        <a class="btn btn-info active" href="javascript:void(0)" data-filter="{{$category->id}}">
                            {{$category->title}}
                        </a>
                        @endforeach

                    </div>


                    <div>
                        <div class="filter-container p-0 row ">
                            @foreach ($professions as $profession )
                            <div id="card{{$profession->id}}" class="filtr-item col-6 row"
                                data-category="{{$profession->subCategory->category->id}}" data-sort="white sample">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                        {{$profession->subCategory->category->title}}
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{$profession->subCategory->title}}</b></h2>
                                                <p class="text-muted text-sm"><b>About:
                                                    </b>{{$profession->description}}
                                                </p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-building"></i></span>
                                                        Address:{{$profession->location}}</li>
                                                    <li><br> </li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-phone"></i></span>
                                                        Phone #: {{$profession->mobile}}</li>
                                                    <li><br> </li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fa fa-envelope-o"></i></span>
                                                        email:{{$profession->email}}</li>
                                                    <li><br> </li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fa fa-address-book"></i></span>
                                                        specialize:{{$profession->specialization}}</li>
                                                    <li><br> </li>
                                                    <span
                                                        class="badge @if($profession->gender =='M') bg-success @else bg-warning @endif">{{$profession->gender_type}}
                                                    </span>
                                                </ul>

                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="{{Storage::url($profession->image)}}" alt="user-avatar"
                                                    class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    @canany(['Update-Profession', 'Delete-Profession', 'Create-FavoriteProfession'])
                                    <div class="card-footer">
                                        <div class="text-right">
                                            @can('Delete-Profession')
                                            <a href="#"
                                                onclick="confirmDelete('{{$profession->id}}',card{{$profession->id}})"
                                                class="btn btn-sm bg-red">
                                                <i class="fas fa-remove"></i>
                                            </a>
                                            @endcan
                                            @can('Update-Profession')
                                            <a href="{{route('professions.edit',[$profession->id])}}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-user"></i> Edit
                                            </a>
                                            @endcan
                                        </div>
                                        @can('Create-FavoriteProfession')
                                        <div class="text-left">
                                            <a onclick="performStore('{{$profession->id}}',this)"
                                                class="btn btn-sm btn-primary">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                        </div>
                                        @endcan
                                    </div>
                                    @endcanany

                                </div>
                            </div>
                            @endforeach
                        </div>



                    </div>

                </div>
            </div>
        </div>

    </div>
</section>






@endsection
@section('styles')
@endsection
@section('scripts')
<!-- Filterizr-->
<script src="{{asset('cms/plugins/filterizr/jquery.filterizr.min.js')}}"></script>
<script>
    $(function () {
      $(document).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });

      $('.filter-container').filterizr({ gutterPixels: 3 });
      $('.btn[data-filter]').on('click', function () {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
      });
    })
</script>
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

     axios.delete('/cms/admin/professions/'+id)
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
function performStore(id){

let formData=new FormData();
formData.append('id',id);
axios.post('/cms/admin/favoriteProfessions',formData)
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









{{--

<div class="row">
    @foreach ($professions as $profession )
    <div data-category="{{$profession->subCategory->category->id}}"
        class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                {{$profession->subCategory->title}}

            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-7" data-category="1">
                        <h2 class="lead"><b>{{$profession->name}}</b></h2>
                        <p class="text-muted text-sm"><b>About: </b>{{$profession->description}}
                        </p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                Address:{{$profession->location}}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                Phone #: {{$profession->mobile}}</li>
                            <li class="small"><span class="fa-li"><i class="fa fa-envelope-o"></i></span>
                                email:{{$profession->email}}</li>
                            <li class="small"><span class="fa-li"><i class="fa fa-address-book"></i></span>
                                specialize:{{$profession->specialization}}</li>

                            <span
                                class="badge @if($profession->gender =='M') bg-success @else bg-warning @endif">{{$profession->gender_type}}
                            </span>
                        </ul>

                    </div>
                    <div class="col-5 text-center">
                        <img src="{{Storage::url($profession->image)}}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <a href="#" onclick="confirmDelete('{{$profession->id}}',this)" class="btn btn-sm bg-red">
                        <i class="fas fa-remove"></i>
                    </a>
                    <a href="{{route('professions.edit',[$profession->id])}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-user"></i> Edit
                    </a>

                </div>
                <div class="text-left">
                    <a href="#" class="btn btn-sm btn-primary">
                        <i class="fa fa-heart-o"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div> --}}