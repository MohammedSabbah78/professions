@extends('cms.parent')
@section('title','Create')
@section('main-content')

@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

@endsection


@section('page_name','Profession')
@section('main_page','profession')
@section('small_page_name','create')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{'Create Profession'}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="name"
                        value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control gender " style="width: 100%;" id="gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="tel" name="mobile" class="form-control" id="mobile" placeholder="mobile"
                        value="{{old('mobile')}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="email"
                        value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" id="location" placeholder="location"
                        value="{{old('location')}}">
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" name="age" class="form-control" id="age" placeholder="age"
                        value="{{old('age')}}">
                </div>
                <div class="form-group">
                    <label for="descreiption">Descreiption</label>
                    <input type="text" name="description" class="form-control" id="description"
                        placeholder="description" value="{{old('description')}}">
                </div>
                <div class="form-group">
                    <label for="specialization">Specialization</label>
                    <input type="text" name="specialization" class="form-control" id="specialization"
                        placeholder="specialization" value="{{old('specialization')}}">
                </div>

                <div class="form-group">
                    <label>SubCategory</label>
                    <select class="form-control category_id " style="width: 100%;" id="subCategory_id">

                        @foreach ($subCategories as $subCategory )
                        <option value="{{$subCategory->id}}">{{$subCategory->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="status" id="status">
                        <label class="custom-control-label" for="status">Active</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image_file">Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image_file">
                            <label class="custom-file-label" for="image_file">Choose Image only (1920 x 1200)</label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
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

    function performStore(){

        let formData=new FormData();
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
            axios.post('/cms/admin/professions',formData)
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