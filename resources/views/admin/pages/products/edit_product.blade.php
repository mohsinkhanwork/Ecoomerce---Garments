@section('style')
<style>
.minicolors {
	float: left;
}
</style>
@endsection

@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')

<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Products</strong>
        </h1>
        <a href="{{ url('/dashboard/manage-product') }}" class="btn btn-float btn-sm btn-primary"><i class="ti-list"></i></a>
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
            <form class="card" enctype="multipart/form-data" method="post" action="{{ url('/dashboard/edit-product/'.$product_details->id) }}">
                <h4 class="card-title"><strong>Edit Product</strong>  <a href="{{ url('/dashboard/add-image/'.$product_details->id) }}" class="btn text-white btn-gray pull-right mr-2 mb-2">Product Images <i class="fa fa-arrow-right"></i> </a>
                <a href="{{ url('/dashboard/manage-product') }}" class="btn text-white btn-orange pull-right mb-2 mr-2"><i class="fa fa-arrow-left"></i> Manage Products</a></h4>
                @csrf

                @if (session('status'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ session('status') }}</strong>
                        </span>
                @endif

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Category</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="category_id" id="category_id">
                                <?php echo $categories_dropdown; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Collection</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="collection_id" id="collection_id">
                                <?php echo $collections_dropdown; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" value="{{ $product_details->product_name }}" name="product_name" id="product_name" type="text" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Code</label>
                        <div class="col-sm-8">
                            <input class="form-control" value="{{ $product_details->product_code }}" name="product_code" id="product_code" type="text" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Alias</label>
                        <div class="col-sm-8">
                            <input class="form-control" value="{{ $product_details->alias }}" name="alias" id="alias" type="text" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="product_description" id="product_description" type="text">{{ $product_details->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Home Page Title of Product</label>
                        <div class="col-sm-8">
                            <input class="form-control" value="{{ $product_details->home_title }}" name="home_title" id="home_title" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Home Page Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="short_description" id="short_description" type="text">{{ $product_details->short_description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Meta Title</label>
                        <div class="col-sm-8">
                            <input class="form-control" value="{{ $product_details->meta_title }}" name="meta_title" id="meta_title" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Meta Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="product_meta_description" id="product_meta_description" type="text">{{ $product_details->meta_description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Meta Keywords</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="product_meta_keywords" id="product_meta_keywords" type="text">{{ $product_details->meta_keywords }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Overlay Button Text</label>
                        <div class="col-sm-8">
                            <input class="form-control" value="{{ $product_details->overlay_button_text }}" name="overlay_button_text" id="overlay_button_text" type="text" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Overlay Proudct Text</label>
                        <div class="col-sm-8">
                            <input class="form-control" value="{{ $product_details->overlay_button_product_text }}" name="overlay_button_product_text" id="overlay_button_product_text" type="text" />
                        </div>
                    </div>


                </div>

                <footer class="card-footer text-right">
                    <a class="btn btn-orange text-white" href="{{ url('dashboard/manage-product') }}" >Cancel</a>
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </footer>
            </form>

        </div>


        <div class="col-lg-6">

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
                <h4 class="card-title">Product Homepage Images <a class="btn btn-primary  text-white ml-2" onclick="addData()">Add Color </a>

                  <a href="{{ url('/dashboard/add-image/'.$product_details->id) }}" class="btn text-white btn-gray pull-right mr-2 mb-2">Product Images <i class="fa fa-arrow-right"></i> </a>
                  <a href="{{ url('/dashboard/manage-product') }}" class="btn text-white btn-orange pull-right mb-2 mr-2"><i class="fa fa-arrow-left"></i> Manage Products</a>

                </h4>

                <div class="card-body">

                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Color</th>
                            <th>Color Name</th>
                            <th >Image</th>
                            <th>Image Alt</th>
                            <th>Show in Options</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php ($i = 1) @endphp
                        @foreach($homepage_images as $image)
                            <tr>
                                <td>{{ $image->id }}</td>
                                <td >
                                  <form id="color_code_{{$image->id}}" class="color_update_form" action="{{route('update.product.homepage.image',$image->id)}}" onsubmit="return updateData(this.id)" enctype="multipart/form-data"
                                        method="post">
                                      {{csrf_field()}}
                                      <input class="mt-2 " name="color_code" type="text" value="{{ $image->color_code }}" data-provide="colorpicker" required>
                                      <button class="btn btn-primary text-white mt-2 btn-sm" type="submit">Update Color</button>
                                  </form>
                                <td >
                                  <form id="color_name_{{$image->id}}" class="color_update_form" action="{{route('update.product.homepage.image',$image->id)}}" onsubmit="return updateData(this.id)" enctype="multipart/form-data"
                                        method="post">
                                      {{csrf_field()}}
                                      <input class="" style="width:100%;" name="color_name" id="color_name" type="text" value="{{ $image->color_name }}" placeholder="Color Name" required>
                                      <button class="btn btn-primary text-white mt-2  btn-sm" type="submit">Update Color Name</button>
                                  </form>



                                </td>
                                <td >
                                    @if(!empty($image->filename))
                                        <img src="{{ asset('img/products/drop/'.$image->filename) }}" id="image-preview{{ $i }}" style="width: 50px;">
                                    @endif

                                    <div class="file-group file-group-inline">
                                        <button class="file-browser btn-update btn btn-primary text-white mt-2 btn-sm" id="btn-update-image" type="button" data-provide="tooltip" title="Update Image">Update Image</button>
                                        <input type="file" class="update-image" id="update-image{{ $i }}" data-pid="{{ $image->product_id }}" data-hid="{{ $image->id }}" data-cim="{{ $image->filename }}">
                                    </div>
                                </td>
                                <td width="30%">
                                    <form id="home_page_img_{{ $image->id }}" class="alt_update_form" action="{{ route('update.product.homepage.image',$image->id) }}" onsubmit="return updateData(this.id)" method="post">
                                      {{csrf_field()}}
                                      <input autocomplete="off" class="w-100 mt-2" name="alt_text" id="alt_text" type="text" value="{{ $image->alt_text }}" placeholder="Alt Text" required="">
                                      <button class="btn btn-primary text-white mt-2 btn-sm" type="submit">Update Alt Text</button>
                                    </form>
                                </td>
                                <td>
                                  <form id="color_show_{{$image->id}}" class="color_update_form" action="{{route('update.product.homepage.image',$image->id)}}" onsubmit="return updateData(this.id)" enctype="multipart/form-data"
                                        method="post">
                                      {{csrf_field()}}
                                      <input class="" onchange="return updateData('color_show_{{$image->id}}')"  name="show_to_option"  type="radio" value="1" {{ ($image->show_to_option == 1)?'checked':'' }}> Yes
                                      <br><input class="" onchange="return updateData('color_show_{{$image->id}}')" name="show_to_option"  type="radio" value="0" {{ ($image->show_to_option == 0)?'checked':'' }}> No
                                  </form>



                                </td>
                                <td>
                                  <!-- <a class="btn btn-primary text-white ml-2 btn-sm" onclick="editData('{{ $image->id }}')">Update </a> -->

                                    <a href="{{ url('/image/delete-homepage-image/'.$image->product_id.'/'.$image->id) }}" onclick="return confirm('Are you sure to delete it?')" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            @php ($i++) @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div><!--/.main-content -->


<div id="addColorModal" class="modal fade update_dialog" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{route('add.product.homepage.image',$product_details->id)}}" enctype="multipart/form-data"
                  method="post">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;
                    </button>
                    <h4 class="modal-title">Add Product Colors</h4>
                </div>
                <div class="modal-body" style="display: inline-block;">

                  <div class="form-group row field_wrapper">
                          <div class="row ml-0 mr-0">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label>Color</label>
                                      <input class="form-control" name="color_code" id="color_code" type="text" value="" data-provide="colorpicker" required>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label>Color Name</label>
                                      <input class="form-control" name="color_name" id="color_name" type="text" value="" placeholder="Color Name" required>
                                  </div>
                              </div>

                              <div class="col-sm-12">
                                  <div class="form-group">
                                    <label>Image</label>
                                    <input class="form-control" name="product_image" id="product_image" type="file" accept="image/*" required>

                                  </div>
                              </div>

                          </div>
                  </div>

              </div>
                <div class="modal-footer">
                    <a class="btn btn-default pull-left" data-dismiss="modal">Close
                    </a>
                    <button type="submit" class="btn btn-primary text-white pull-right dark">
                        Add
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

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



function editData(id) {

    $('#updateColorModal' + id).modal('show');

}
function addData() {

    $('#addColorModal').modal('show');

}
</script>

<script>

    var imageInputLength = $('.btn-update').length;
    var i = 1;
    for(i = 1; i <= imageInputLength; i++) {
        $('#update-image'+i).on('change', function (e) {
            var pid = $(this).data('pid');
            var hid = $(this).data('hid');
            var cim = $(this).data('cim');
            var image = e.target.files[0];
            var form = new FormData();
            form.append('pid', pid);
            form.append('hid', hid);
            form.append('cim', cim);
            form.append('image', image);
            form.append('_token', '{{ csrf_token() }}');
            $.ajax({
                url: '/image/replace-homepage-image',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function(){
                    $('.preloader').css({"display":"flex", "opacity":"0.7"});
                },
                success:function(response) {
                    var image_path = window.location.origin+response.success;
                    var current_id = e.target.id;
                    $('#'+current_id).parents('div').siblings('img').attr('src', image_path);
                },
                complete: function(){
                    $('.preloader').css({"display":"none", "opacity":"0"});
                }
            });

        });
    }

</script>
