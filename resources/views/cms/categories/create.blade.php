@extends('cms.parent')
@section('title','Categories')
@section('main-content')

@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection


@section('page_name','Create')
@section('main_page','categories')
@section('small_page_name','Create')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{'Create Category'}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="title"
                        value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label for="email">Descreiption</label>
                    <input type="text" name="description" class="form-control" id="description"
                        placeholder="description" value="{{old('description')}}">
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
                            <label class="custom-file-label" for="image_file">Choose file</label>
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
    function performStore(){

        let formData=new FormData();
        formData.append('title',document.getElementById('title').value);
        formData.append('description',document.getElementById('description').value);
        formData.append('status',document.getElementById('status').checked ? 1 : 0);
        formData.append('image',document.getElementById('image_file').files[0]);
            axios.post('/cms/admin/categories',formData)
            .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);

            window.location.href='/cms/admin/categories';

            })
            .catch(function (error) {
            console.log(error);
            toastr.error(error.response.data.message);
            
            });


        }

</script>











@endsection