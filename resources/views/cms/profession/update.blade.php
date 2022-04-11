@extends('cms.parent')
@section('title','Update')
@section('main-content')

@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection


@section('page_name','Professions')
@section('main_page','profession')
@section('small_page_name','update')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{'Update Profession'}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
            @csrf

            <div class="card-body">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" value="{{$professions->name}}" name="name" class="form-control" id="name"
                        placeholder="name">
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control gender " style="width: 100%;" id="gender">
                        <option value="M" @if ($professions->gender =='M')
                            selected
                            @endif>Male</option>
                        <option value="F" @if ($professions->gender =='F')
                            selected
                            @endif>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="tel" name="mobile" value="{{$professions->mobile}}" class=" form-control" id="mobile"
                        placeholder="mobile">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{$professions->email}}" class=" form-control" id="email"
                        placeholder="email">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" value="{{$professions->location}}"
                        id="location" placeholder="location">
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" name="age" class="form-control" value="{{$professions->age}}" id="age"
                        placeholder="age">
                </div>
                <div class="form-group">
                    <label for="descreiption">Descreiption</label>
                    <input type="text" name="description" class="form-control" value="{{$professions->description}}"
                        id="description" placeholder="description">
                </div>
                <div class="form-group">
                    <label for="specialization">Specialization</label>
                    <input type="text" name="specialization" class="form-control" id="specialization"
                        placeholder="specialization" value="{{$professions->specialization}}">
                </div>

                <div class="form-group">
                    <label>SubCategory</label>
                    <select class="form-control category_id " style="width: 100%;" id="subCategory_id">

                        @foreach ($subCategories as $subCategory )
                        <option value="{{$subCategory->id}}" @if ($professions->sub_category_id ==$subCategory->id)
                            selected
                            @endif
                            >{{$subCategory->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" @if ($professions->status) checked @endif
                        name="status" id="status">
                        <label class="custom-control-label" for="status">Active</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image_file">Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image_file">
                            <label class="custom-file-label" value="{{$professions->image}}" for="image_file">Choose
                                Image only (1920 x 1200)</label>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="button" onclick="updateStore()" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
    <!-- /.card -->


</div>


@endsection

@section('scripts')

<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    $(function () {bsCustomFileInput.init();});
</script>


<!-- Select2 -->
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Toastr -->
<script>
    $('.category_id').select2({
    theme: 'bootstrap4'
    });
    
    $('.gender').select2({
    theme: 'bootstrap4'
    });
    function updateStore(){

let formData=new FormData();
formData.append('_method','PUT');
        formData.append('name',document.getElementById('name').value);
        formData.append('gender',document.getElementById('gender').value);
        formData.append('mobile',document.getElementById('mobile').value);
        formData.append('email',document.getElementById('email').value);
        formData.append('location',document.getElementById('location').value);
        formData.append('age',document.getElementById('age').value);
        formData.append('description',document.getElementById('description').value);
        formData.append('specialization',document.getElementById('specialization').value);
        formData.append('subCategory_id',document.getElementById('subCategory_id').value);
        formData.append('status',document.getElementById('status').checked ? 1 : 0);
        formData.append('image',document.getElementById('image_file').files[0]);


    axios.post('/cms/admin/professions/{{$professions->id}}', formData)
    .then(function (response) {
    console.log(response);
    toastr.success(response.data.message);


    window.location.href='/cms/admin/professions'
    })
    .catch(function (error) {
    console.log(error);
    toastr.error(error.response.data.message);

    });


}

</script>











@endsection