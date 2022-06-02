@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Products</strong>
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
            <form class="card" enctype="multipart/form-data" method="post" action="{{ url('/dashboard/add-product') }}">
                <h4 class="card-title"><strong>Add Product</strong>
                  <a href="{{ url('/dashboard/manage-product') }}" class="btn text-white btn-orange pull-right"><i class="fa fa-arrow-left"></i> Back</a>
                </h4>

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
                            <input class="form-control" name="product_name" id="product_name" type="text" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Code</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="product_code" id="product_code" type="text" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="product_description" id="product_description" type="text"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Meta Title</label>
                        <div class="col-sm-8">
                            <input class="form-control" value="" name="meta_title" id="meta_title" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Meta Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="product_meta_description" id="product_meta_description" type="text" rows=2></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Meta Keywords</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="product_meta_keywords" id="product_meta_keywords" type="text" rows=2></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Overlay Button Text</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="overlay_button_text" id="overlay_button_text" type="text" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Overlay Product Text</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="overlay_button_product_text" id="overlay_button_product_text" type="text" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Colors / Images (HomePage)</label>
                        <div class="col-sm-8">
                            <!-- input class="form-control" name="product_image" id="product_image" type="file" required -->
                            <!-- input class="form-control" type="file" name="product_image[]" id="product_image" accept="image/*" multiple -->

                        </div>
                    </div>

                    <div class="form-group row image_field_wrapper">
                        <div class="form-inline">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <input class="form-control" name="color_code[]" id="color_code" type="text" value="#33cabb" data-provide="colorpicker" required>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <input class="form-control" name="color_name[]" id="color_name" type="text" placeholder="Color Name" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input class="form-control" name="product_image[]" id="product_image" type="file" accept="image/*" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <small style="position: absolute;top: -20px;">Show in Options</small>
                                  <select class="form-control" name="show_to_option[]">
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                  </select>


                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <a href="javascript:void(0)" class="btn btn-success add_image_field"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <footer class="card-footer text-right">
                  <a href="{{ url('/dashboard/manage-product') }}" class="btn text-white btn-orange pull-left"><i class="fa fa-arrow-left"></i> Back</a>
                    <button class="btn btn-secondary" type="reset">Cancel</button>
                    <button class="btn btn-primary" type="submit">Add Product</button>
                </footer>
            </form>

        </div>


        <div class="col-lg-4">

            {{--<form method="post" action="{{ url('image/upload/store') }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                @csrf
                <input name="color_code" id="color_code" type="text" value="#33cabb" data-provide="colorpicker" required>
                <input name="color_name" id="color_name" type="text" required>
            </form>--}}

        </div>


    </div>
</div><!--/.main-content -->

@include('admin.pages.layouts.footer')

<script>

    /*******************    Dynamic Product Images Upload Here   *************************/

    /*Dropzone.options.dropzone =
        {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            //autoProcessQueue: false,
            //autoDiscover: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            timeout: 50000,
            removedfile: function(file)
            {
                var name = file.upload.filename;
                var token = $('[name="_token"]').val();
                $.ajax({

                    type: 'POST',
                    url: '{{ url("/image/delete") }}',
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
        };*/


    /*******************    ./Dynamic Product Images Upload Here   *************************/
</script>
