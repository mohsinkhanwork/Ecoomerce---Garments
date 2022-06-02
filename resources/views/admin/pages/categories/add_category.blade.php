@section('script')
<script>

$('input[name="filter_cat"]').on('change', function() {


  if(this.value == "yes"){

     $('#filter_image').prop('required',true);
     $('#filter_image_selected').prop('required',true);
     $('.filter_images_div').show();


  }else{

    $('#filter_image').prop('required',false);
    $('#filter_image_selected').prop('required',false);
    $('.filter_images_div').hide();


  }

});


</script>
@endsection

@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Categories</strong>
        </h1>
        <a href="{{ url('/dashboard/manage-category') }}" class="btn btn-float btn-sm btn-primary"><i class="ti-list"></i></a>
    </div>
</header><!--/.header -->

<div class="main-content">
    <div class="row">

        <div class="col-lg-8">

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
                <form class="card" method="post" enctype="multipart/form-data" action="{{ url('/dashboard/add-category') }}">
                    <h4 class="card-title"><strong>Add Category</strong></h4>
                    @csrf

                    @if (session('status'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ session('status') }}</strong>
                        </span>
                    @endif

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Category Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="name" type="text" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Main Level (Parent)</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="parent_id" id="parent_id">
                                    <option value="0">Main Category</option>
                                    @foreach($levels as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Is Filterable</label>
                            <div class="col-sm-9">
                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" value="yes" name="filter_cat">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Yes</span>
                                </label>

                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" value="no" name="filter_cat" checked>
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">No</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Display Order</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="display_order" type="number" min="0" value="0">
                            </div>
                        </div>

                        <div class="form-group row filter_images_div" style="display:none;">
                            <label class="col-sm-3 col-form-label">Filter Images</label>
                            <div class="col-sm-4">
                                <strong>Normal Image</strong>
                                <input class="form-control" name="filter_image" id="filter_image" type="file" accept="image/*">
                            </div>
                            <div class="col-sm-4">
                                <strong>Selected Image</strong>
                                <input class="form-control" name="filter_image_selected" id="filter_image_selected" type="file" accept="image/*">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="description" type="text" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Slug (Unique ID)</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="url" type="text" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Materials / Care Instruction</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="6" name="material_care_instruction" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dimensions</label>
                            <div class="col-sm-3 text-center">
                               <label class="control-label">Weight</label>
                               <div class="input-group">
                                    <input type="number" class="form-control text-right" name="weight" id="weight" value="{{ old( 'weight' ) }}" min="0" step="0.01" required placeholder="0.00">
                                    <select name="weight_unit" id="weight_unit" class="form-control input-group-addon">
                                        <option value="lb">lb</option>
                                        <option value="kg">kg</option>
                                    </select>
                                    <input type="number" class="form-control text-right" name="weight2" id="weight2" value="{{ old( 'weight2' ) }}" min="0" step="0.01" required placeholder="0.00">
                                    <span class="input-group-addon"><input type="hidden" name="weight_unit2" id="weight_unit2" value="oz"/>oz</span>
                                </div>
                            </div>
                            <div class="col-sm-2 text-center">
                               <label class="control-label">Length</label>
                               <div class="input-group">
                                    <input type="number" class="form-control text-right" name="length" id="length" value="{{ old( 'length' ) }}" min="0" step="0.01" required placeholder="0.00">
                                    <select name="length_unit" id="length_unit" class="form-control input-group-addon">
                                        <option value="in">in</option>
                                        <option value="ft">ft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 text-center">
                               <label class="control-label">Width</label>
                               <div class="input-group">
                                    <input type="number" class="form-control text-right" name="width" id="width" value="{{ old( 'width' ) }}" min="0" step="0.01" required placeholder="0.00">
                                    <select name="width_unit" id="width_unit" class="form-control input-group-addon">
                                        <option value="in">in</option>
                                        <option value="ft">ft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 text-center">
                               <label class="control-label">Height</label>
                               <div class="input-group">
                                    <input type="number" class="form-control text-right" name="height" id="height" value="{{ old( 'height' ) }}" min="0" step="0.01" required placeholder="0.00">
                                    <select name="height_unit" id="height_unit" class="form-control input-group-addon">
                                        <option value="in">in</option>
                                        <option value="ft">ft</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Size chart available</label>
                            <div class="col-sm-9">
                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" value="1" name="is_sizechart">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Yes</span>
                                </label>

                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" value="0" name="is_sizechart" checked>
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">No</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Size Chart Image</label>
                            <div class="col-sm-4">
                                <strong>Desktop</strong>
                                <input class="form-control" name="size_chart_image_desktop" id="size_chart_image_desktop" type="file" accept="image/*">
                            </div>
                            <div class="col-sm-4">
                                <strong>Mobile</strong>
                                <input class="form-control" name="size_chart_image_mobile" id="size_chart_image_mobile" type="file" accept="image/*">
                            </div>
                        </div>

                    </div>

                    <footer class="card-footer text-right">
                        <button class="btn btn-secondary" type="reset">Cancel</button>
                        <button class="btn btn-primary" type="submit">Add Category</button>
                    </footer>
                </form>

        </div>


        <div class="col-lg-6">

        </div>








    </div>
</div><!--/.main-content -->

@include('admin.pages.layouts.footer')
