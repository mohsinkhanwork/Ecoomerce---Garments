@section('style')
<style>
    .alt_update_form {
	display: inline-block;
}
</style>
@endsection
@section('script')

<script>

$(document).ready(function () {


        $('#master_des').on('click', function(e) {
         if($(this).is(':checked',true))
         {
            $(".sub_chk_des").prop('checked', true);
         } else {
            $(".sub_chk_des").prop('checked',false);
         }


        });

        $('#master_cat').on('click', function(e) {
         if($(this).is(':checked',true))
         {
            $(".sub_chk_cat").prop('checked', true);
         } else {
            $(".sub_chk_cat").prop('checked',false);
         }


        });

        $('#master_ccat').on('click', function(e) {
         if($(this).is(':checked',true))
         {
            $(".sub_chk_ccat").prop('checked', true);
         } else {
            $(".sub_chk_ccat").prop('checked',false);
         }


        });


    });


    // multi Delete Product
    $(document).on('click', '.multi-delete-data-des', function () {


      var checkedVals = $('.sub_chk_des:checkbox:checked').map(function() {
    return this.value;
    }).get();

        var ids = checkedVals.join(",");
        var token = $('meta[name="csrf-token"]').attr('content');

        if(ids == ''){
          swal({
              title: "Error!",
              text: "Please Select the data rows!",
              type: "warning"
          });
          return false;
        }


        swal({
            title: 'Are you sure?',
            text: "It will permanently delete the selected images ["+ids+"] with all its data.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {

                return new Promise(function (resolve) {
                    $.ajax({
                        url: '/image/delete-multi-description-images',
                        type:"POST",
                        dataType:"json",
                        data: { '_method': 'POST', '_token': token, 'ids': ids },
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },

                        success: function (response) {

                            //console.log(response);

                                if (response.code == '200') {
                                    swal({
                                        title: "Deleted!",
                                        text: "Data has been deleted successfully!",
                                        type: "success",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                } else if (response.code == '400') {
                                    swal({
                                        title: "Failed!",
                                        text: "Data has not been deleted successfully!",
                                        type: "warning",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: "Error!",
                                        text: "Bad request!",
                                        type: "warning",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                }

                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                });
            }

        }).catch(swal.noop);

    });
    /************ ./multi Delete description images **************/

    // multi Delete category images
    $(document).on('click', '.multi-delete-data-cat', function () {


      var checkedVals = $('.sub_chk_cat:checkbox:checked').map(function() {
    return this.value;
    }).get();

        var ids = checkedVals.join(",");
        var token = $('meta[name="csrf-token"]').attr('content');

        if(ids == ''){
          swal({
              title: "Error!",
              text: "Please Select the data rows!",
              type: "warning"
          });
          return false;
        }


        swal({
            title: 'Are you sure?',
            text: "It will permanently delete the selected images ["+ids+"] with all its data.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {

                return new Promise(function (resolve) {
                    $.ajax({
                        url: '/image/delete-multi-category-images',
                        type:"POST",
                        dataType:"json",
                        data: { '_method': 'POST', '_token': token, 'ids': ids },
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },

                        success: function (response) {

                            //console.log(response);

                                if (response.code == '200') {
                                    swal({
                                        title: "Deleted!",
                                        text: "Data has been deleted successfully!",
                                        type: "success",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                } else if (response.code == '400') {
                                    swal({
                                        title: "Failed!",
                                        text: "Data has not been deleted successfully!",
                                        type: "warning",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: "Error!",
                                        text: "Bad request!",
                                        type: "warning",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                }

                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                });
            }

        }).catch(swal.noop);

    });
    /************ ./multi Delete Product **************/
    // multi Delete category images color wise
    $(document).on('click', '.multi-delete-data-ccat', function () {


      var checkedVals = $('.sub_chk_ccat:checkbox:checked').map(function() {
    return this.value;
    }).get();

        var ids = checkedVals.join(",");
        var token = $('meta[name="csrf-token"]').attr('content');

        if(ids == ''){
          swal({
              title: "Error!",
              text: "Please Select the data rows!",
              type: "warning"
          });
          return false;
        }


        swal({
            title: 'Are you sure?',
            text: "It will permanently delete the selected images ["+ids+"] with all its data.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {

                return new Promise(function (resolve) {
                    $.ajax({
                        url: '/image/colorwise-delete-multi-category-images',
                        type:"POST",
                        dataType:"json",
                        data: { '_method': 'POST', '_token': token, 'ids': ids },
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },

                        success: function (response) {

                            //console.log(response);

                                if (response.code == '200') {
                                    swal({
                                        title: "Deleted!",
                                        text: "Data has been deleted successfully!",
                                        type: "success",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                } else if (response.code == '400') {
                                    swal({
                                        title: "Failed!",
                                        text: "Data has not been deleted successfully!",
                                        type: "warning",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: "Error!",
                                        text: "Bad request!",
                                        type: "warning",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                }

                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                });
            }

        }).catch(swal.noop);

    });
    /************ ./multi Delete  **************/

</script>
@endsection



@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Product Images</strong>
        </h1>
    </div>
</header><!--/.header -->

<div class="main-content">
    <div class="row">

        <div class="col-lg-12">

            <!--
          |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
          | Dismissible
          |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
          !-->
            @if (session('status'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('status') }}
                </div>
        @endif

        <!--
          |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
          | Horizontal form
          |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
          !-->
            {{--<form class="card" enctype="multipart/form-data" method="post" action="{{ url('/dashboard/add-image/'.$colors_data[0]->id) }}">--}}
            <div class="card">
                <h4 class="card-title"><strong>Add Product Images (Color-Wise)</strong></h4>
                {{--@csrf--}}
                @if (session('status'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ session('status') }}</strong>
                        </span>
                @endif

                <div class="card-body">

                    <input type="hidden" name="product_id" value="{{ $products_data[0]->id }}">

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Name</label>
                        <div class="col-sm-8">
                            <label><strong>{{ $products_data[0]->product_name }}</strong></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Code</label>
                        <div class="col-sm-8">
                            <label><strong>{{ $products_data[0]->product_code }}</strong></label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                      <a href="{{ url('/dashboard/add-attribute/'.$products_data[0]->id) }}" class="btn text-white btn-gray pull-right mr-2 mb-2">Attributes <i class="fa fa-arrow-right"></i> </a>
                      <a href="{{ url('/dashboard/manage-product') }}" class="btn text-white btn-orange pull-right mb-2 mr-2"><i class="fa fa-arrow-left"></i> Product List</a>


                    </div>
                    <div class="divider"></div>

                    <div class="form-group row">
                        <h6 class="col-sm-3 col-form-label text-center"><strong>Product Colors</strong></h6>
                        <h6 class="col-sm-3 col-form-label text-center"><strong>PRODUCT PAGE IMAGES</strong></h6>
                        <h6 class="col-sm-3 col-form-label text-center"><strong>COLLECTIONS PAGE IMAGES</strong></h6>
                        <h6 class="col-sm-3 col-form-label text-center"><strong>GALLERY IMAGES (Collection Page)</strong></h6>
                    </div>

                    <div class="divider"></div>

                    @foreach($colors_data as $color)

                        <div class="form-group row">
                            <div class="col-sm-1">
                                <span style="height: 25px; width: 25px; background-color:{{$color->color_code}}; border-radius: 50%; display: inline-block;"></span>
                            </div>
                            <div class="col-sm-2">
                                <label><strong>{{ $color->color_name }}</strong></label>
                            </div>
                            <div class="col-sm-3">
                                <form method="post" action="{{ url('image/upload/description-slider-image') }}" enctype="multipart/form-data" class="dropzone" id="dropzone-description">
                                    @csrf
                                    <input name="product_id" id="product_id" value="{{ $color->product_id }}" type="hidden">
                                    <input name="color_id" id="color_id" value="{{ $color->id }}" type="hidden">
                                </form>
                            </div>
                            <div class="col-sm-3">
                                <form method="post" action="{{ url('image/upload/category-slider-image') }}" enctype="multipart/form-data" class="dropzone" id="dropzone-category">
                                    @csrf
                                    <input name="product_id" id="product_id" value="{{ $color->product_id }}" type="hidden">
                                    <input name="color_id" id="color_id" value="{{ $color->id }}" type="hidden">
                                </form>
                            </div>
                            <div class="col-sm-3">
                                <form method="post" action="{{ url('image/upload/colorwise-category-slider-image') }}" enctype="multipart/form-data" class="dropzone" id="dropzone-category-colorwise">
                                    @csrf
                                    <input name="product_id" id="product_id" value="{{ $color->product_id }}" type="hidden">
                                    <input name="color_id" id="color_id" value="{{ $color->id }}" type="hidden">
                                </form>
                            </div>
                        </div>

                    @endforeach

                    {{--<div class="form-group row field_wrapper">
                        <div class="form-inline">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <input class="form-control" name="sku[]" id="sku" type="text" placeholder="SKU" required>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <input class="form-control" name="size[]" id="size" type="text" placeholder="Size" required>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <input class="form-control" name="price[]" id="price" type="text" placeholder="Price" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input class="form-control" name="stock[]" id="stock" type="text" placeholder="Stock" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <a href="javascript:void(0)" class="btn btn-success add_field"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>--}}

                </div>

                <footer class="card-footer text-right">
                  <a href="{{ url('/dashboard/manage-product') }}" class="btn text-white btn-orange pull-left "><i class="fa fa-arrow-left"></i> Product List</a>

                    <button class="btn btn-secondary" type="button" id="image-page-refresh"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-secondary" type="reset">Cancel</button>
                    <button class="btn btn-primary" type="button" id="upload-images">Add Product Images</button>
                    <a href="{{ url('/dashboard/add-attribute/'.$products_data[0]->id) }}" class="btn text-white btn-gray pull-right ml-2">Attributes <i class="fa fa-arrow-right"></i> </a>
                </footer>
            {{--</form>--}}
            </div>

        </div>


    </div>

    <div class="row">
        <div class="col-lg-12">
            <!--
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            | Zero configuration
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            !-->
            <div class="card">
                <h4 class="card-title">
                  PRODUCT PAGE IMAGES (Transparent)
                  <a href="javascript:;" class="text-white btn btn-danger pull-right multi-delete-data-des"><i class="fa fa-trash"></i> Delete Selected</a>
                </h4>

                <div class="card-body">

                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th >Color</th>
                            <th>Color Name</th>
                            <th >Image</th>
                            <th >Alt Text</th>
                            <th ><input autocomplete="off" type="checkbox" id="master_des"></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($description_data as $description)
                            <tr>
                                <td width="8%">{{ $description->id }}</td>
                                <td width="8%"><span style="height: 25px; width: 25px; background-color:{{$description->color_code}}; border-radius: 50%; display: inline-block;"></span></td>
                                <td width="10%">{{ $description->color_name }}</td>
                                <td width="10%">
                                    @if(!empty($description->filename))
                                        <img src="{{ asset('img/products/drop/'.$description->filename) }}" style="width: 50px;">
                                    @endif
                                </td>
                                <td > 
                                    <form id="description_img_{{ $description->id }}" class="alt_update_form w-100" action="{{ route('update.description.image',$description->id) }}" onsubmit="return updateData(this.id)" method="post">
                                      {{csrf_field()}}
                                      <input autocomplete="off" class="w-100" name="alt_text" id="alt_text" type="text" value="{{ $description->alt_text }}" placeholder="Alt Text" required="">
                                      <button class="btn btn-primary text-white mt-2 btn-sm" type="submit">Update Alt Text</button>
                                    </form>
                                </td>
                                <td width="50px">
                                    <input autocomplete="off" type="checkbox" class="sub_chk_des" value="{{$description->id}}" name="delete_ids_des[]">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="col-lg-12 mt-3">
                      <a href="{{ url('/dashboard/add-attribute/'.$products_data[0]->id) }}" class="btn text-white btn-gray pull-right mr-2 mb-2">Attributes <i class="fa fa-arrow-right"></i> </a>
                      <a href="{{ url('/dashboard/manage-product') }}" class="btn text-white btn-orange pull-right mb-2 mr-2"><i class="fa fa-arrow-left"></i> Product List</a>


                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!--
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            | Zero configuration
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            !-->
            <div class="card">
                <h4 class="card-title">COLLECTIONS PAGE IMAGES
                  <a href="javascript:;" class="text-white btn btn-danger pull-right multi-delete-data-cat"><i class="fa fa-trash"></i> Delete Selected</a>
                </h4>

                <div class="card-body">

                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Color</th>
                            <th>Color Name</th>
                            <th>Image</th>
                            <th >Alt Text</th>
                            <th width="50px"><input autocomplete="off" type="checkbox" id="master_cat"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category_data as $category)
                            <tr>
                                <td width="8%">{{ $category->id }}</td>
                                <td width="8%"><span style="height: 25px; width: 25px; background-color:{{$category->color_code}}; border-radius: 50%; display: inline-block;"></span></td>
                                <td width="10%">{{ $category->color_name }}</td>
                                <td width="10%">
                                    @if(!empty($category->filename))
                                        <img src="{{ asset('img/products/drop/'.$category->filename) }}" style="width: 50px;">
                                    @endif
                                </td>
                                <td>
                                    <form id="category_img_{{ $category->id }}" class="alt_update_form w-100" action="{{ route('update.category.image',$category->id) }}" onsubmit="return updateData(this.id)" method="post">
                                      {{csrf_field()}}
                                      <input autocomplete="off" class="w-100" name="alt_text" id="alt_text" type="text" value="{{ $category->alt_text }}" placeholder="Alt Text" required="">
                                      <button class="btn btn-primary text-white mt-2 btn-sm" type="submit">Update Alt Text</button>
                                    </form>
                                </td>
                                <td width="35px">
                                    <input autocomplete="off" type="checkbox" class="sub_chk_cat" value="{{$category->id}}" name="delete_ids_cat[]">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-lg-12 mt-3">
                      <a href="{{ url('/dashboard/add-attribute/'.$products_data[0]->id) }}" class="btn text-white btn-gray pull-right mr-2 mb-2">Attributes <i class="fa fa-arrow-right"></i> </a>
                      <a href="{{ url('/dashboard/manage-product') }}" class="btn text-white btn-orange pull-right mb-2 mr-2"><i class="fa fa-arrow-left"></i> Product List</a>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!--
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            | Zero configuration
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            !-->
            <div class="card">
                <h4 class="card-title">
                  GALLERY IMAGES (Collection Page)
                  <a href="javascript:;" class="text-white btn btn-danger pull-right multi-delete-data-ccat"><i class="fa fa-trash"></i> Delete Selected</a>
                </h4>

                <div class="card-body">

                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Color</th>
                            <th>Color Name</th>
                            <th>Image</th>
                            <th>Alt Text</th>
                            <th ><input autocomplete="off" type="checkbox" id="master_ccat"></th>                        </tr>
                        </thead>
                        <tbody>
                        @foreach($colorwise_category_data as $colorwise_category)
                            <tr>
                                <td width="8%">{{ $colorwise_category->id }}</td>
                                <td width="8%"><span style="height: 25px; width: 25px; background-color:{{$colorwise_category->color_code}}; border-radius: 50%; display: inline-block;"></span></td>
                                <td width="10%">{{ $colorwise_category->color_name }}</td>
                                <td style="width:10%">
                                    @if(!empty($colorwise_category->filename))
                                        <img src="{{ asset('img/products/drop/'.$colorwise_category->filename) }}" style="width: 50px;">
                                    @endif
                                </td>
                                <td>
                                    <form id="colorwise_category_img_{{ $colorwise_category->id }}" class="alt_update_form w-100" action="{{ route('update.color.category.image',$colorwise_category->id) }}" onsubmit="return updateData(this.id)" method="post">
                                      {{csrf_field()}}
                                      <input autocomplete="off" class="w-100" name="alt_text" id="alt_text" type="text" value="{{ $colorwise_category->alt_text }}" placeholder="Alt Text" required="">
                                      <button class="btn btn-primary text-white mt-2 btn-sm" type="submit">Update Alt Text</button>
                                    </form>
                                </td>
                                <td width="50px">
                                    <input autocomplete="off" type="checkbox" class="sub_chk_ccat" value="{{$colorwise_category->id}}" name="delete_ids_ccat[]">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="col-lg-12 mt-3">
                      <a href="{{ url('/dashboard/add-attribute/'.$products_data[0]->id) }}" class="btn text-white btn-gray pull-right mr-2 mb-2">Attributes <i class="fa fa-arrow-right"></i> </a>
                      <a href="{{ url('/dashboard/manage-product') }}" class="btn text-white btn-orange pull-right mb-2 mr-2"><i class="fa fa-arrow-left"></i> Product List</a>


                    </div>

                </div>
            </div>
        </div>
    </div>

</div><!--/.main-content -->

@include('admin.pages.layouts.footer')


<script>
    function updateData(id){
   var frm = $('#'+id);
      $.ajax({
          type: frm.attr('method'),
          url: frm.attr('action'),
          data: frm.serialize(),
          success: function (data) {
              swal("Success!!", data, "success");
          }
      });
      return false;
}
    /*******************    Dynamic Product Images Upload Here   *************************/

    // Description Slider Image Uploader
    Dropzone.options.dropzoneDescription =
        {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            autoProcessQueue: false,
            //autoDiscover: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 10,
            timeout: 50000,
            init: function() {
                var submitButton = document.querySelector("#upload-images")
                var myDropzone = this;
                submitButton.addEventListener("click", function() {
                    myDropzone.processQueue();
                });
            },
            removedfile: function(file)
            {
                var name = file.upload.filename;
                var token = $('[name="_token"]').val();
                $.ajax({

                    type: 'POST',
                    url: '{{ url("/image/delete/description-slider-image") }}',
                    data: {filename: name, _token: token},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },

            success: function(file, response)
            {
                console.log(response);
            },
            error: function(file, response)
            {
                return false;
            }
        };

    /**********************************/

    // Category Slider Image Uploader
    Dropzone.options.dropzoneCategory =
        {
            maxFilesize: 2,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            autoProcessQueue: false,
            //autoDiscover: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 2,
            timeout: 50000,
            init: function() {
                var submitButton = document.querySelector("#upload-images")
                var myDropzone = this;
                submitButton.addEventListener("click", function() {
                    myDropzone.processQueue();
                });
            },
            removedfile: function(file)
            {
                var name = file.upload.filename;
                var token = $('[name="_token"]').val();
                $.ajax({

                    type: 'POST',
                    url: '{{ url("/image/delete/category-slider-image") }}',
                    data: {filename: name, _token: token},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },

            success: function(file, response)
            {
                console.log(response);
            },
            error: function(file, response)
            {
                return false;
            }
        };

    // ColorWise Category Slider Image Uploader
    Dropzone.options.dropzoneCategoryColorwise =
        {
            maxFilesize: 20,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            autoProcessQueue: false,
            //autoDiscover: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 20,
            timeout: 50000,
            init: function() {
                var submitButton = document.querySelector("#upload-images")
                var myDropzone = this;
                submitButton.addEventListener("click", function() {
                    myDropzone.processQueue();
                });
            },
            removedfile: function(file)
            {
                var name = file.upload.filename;
                var token = $('[name="_token"]').val();
                $.ajax({

                    type: 'POST',
                    url: '{{ url("/image/delete/colorwise-category-slider-image") }}',
                    data: {filename: name, _token: token},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },

            success: function(file, response)
            {
                console.log(response);
            },
            error: function(file, response)
            {
                return false;
            }
        };

    /*******************    ./Dynamic Product Images Upload Here   *************************/

    $('#image-page-refresh').on('click', function () {
        location.reload();
    });


</script>
