@extends('cms.parent')
@section('title','Favorite')
@section('main-content')




@section('page_name','Favorite')
@section('main_page','favorite professions')
@section('small_page_name','professions')
@can('Read-FavoriteProfessions')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="card-title">Favorite Professions</h4>
                </div>
                <div class="card-body">



                    <div>
                        <div class="filter-container p-0 row ">
                            @foreach ( $favoriteProfessions as $favoriteProfession )
                            <div id="card{{$favoriteProfession->id}}" class="filtr-item col-6 row"
                                data-sort="white sample">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                        Title
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{$favoriteProfession->profession->title}}</b></h2>
                                                <p class="text-muted text-sm"><b>About:
                                                    </b>{{$favoriteProfession->profession->description}}
                                                </p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-building"></i></span>
                                                        Address:{{$favoriteProfession->profession->location}}</li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-phone"></i></span>
                                                        Phone #: {{$favoriteProfession->profession->mobile}}</li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fa fa-envelope-o"></i></span>
                                                        email:{{$favoriteProfession->profession->email}}</li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fa fa-address-book"></i></span>
                                                        specialize:{{$favoriteProfession->profession->specialization}}
                                                    </li>
                                                    <span
                                                        class="badge @if($favoriteProfession->profession->gender =='M') bg-success @else bg-warning @endif">{{$favoriteProfession->profession->gender_type}}
                                                    </span>
                                                </ul>

                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="{{Storage::url($favoriteProfession->profession->image)}}"
                                                    alt="user-avatar" class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">

                                        <div class="text-left">
                                            <a onclick="confirmDelete('{{$favoriteProfession->id}}',card{{$favoriteProfession->id}})"
                                                class="btn btn-sm bg-red">
                                                <i class="fas fa-remove"></i>
                                            </a>
                                        </div>
                                    </div>
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
@endcan

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

     axios.delete('/cms/admin/favoriteProfessions/'+id)
        .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);
        // $( ".filtr-item" ).remove();
        $( element ).remove();
                 
        })
        .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.message);
        
        });

}

</script>



@endsection