@section('script')

@if($category_details->filter_image !== null && $category_details->filter_image_selected !== null)
<script>

$('input[name="filter_cat"]').on('change', function() {

  if(this.value == "yes"){
     $('.filter_images_div').show();
  }else{
    $('.filter_images_div').hide();
  }

});

</script>
@else
<script>
$(document).ready(function() {
  $("input[value='no'][name='filter_cat']").prop("checked", true).trigger("change");
});


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
@endif

@if($category_details->filter_cat == "yes")
<script>
$(document).ready(function() {
  $("input[value='yes'][name='filter_cat']").prop("checked", true).trigger("change");
});
</script>
@else
<script>
$(document).ready(function() {
  $("input[value='no'][name='filter_cat']").prop("checked", true).trigger("change");
});
</script>
@endif

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
            <form class="card" method="post" enctype="multipart/form-data" action="{{ url('/dashboard/edit-category/'.$category_details->id) }}">
                <h4 class="card-title"><strong>Edit Category</strong></h4>
                @csrf

                @if (session('status'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ session('status') }}</strong>
                        </span>
                @endif

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="name" type="text" value="{{ $category_details->name }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Is Filterable</label>
                        <div class="col-sm-9">
                            <label class="custom-control custom-radio">
                                <input type="radio" {{ $category_details->filter_cat == "yes" ? "checked" : "" }} class="custom-control-input" value="yes" name="filter_cat">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Yes</span>
                            </label>

                            <label class="custom-control custom-radio">
                                <input type="radio"  class="custom-control-input" value="no" name="filter_cat">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">No</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Display Order</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="display_order" type="number" min="0" value="{{ $category_details->display_order }}">
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
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-4">
                            @if($category_details->filter_image !== null)
                                <img src="{{ asset('frontend/assets/images/'.$category_details->filter_image) }}" style="max-width: 100px;">
                            @endif

                        </div>
                        <div class="col-sm-4">
                            @if($category_details->filter_image_selected !== null)
                                <img src="{{ asset('frontend/assets/images/'.$category_details->filter_image_selected) }}" style="max-width: 100px;">
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Main Level (Parent)</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="parent_id" id="parent_id">
                                <option value="0">Main Category</option>
                                @foreach($levels as $val)
                                    <option value="{{ $val->id }}" @if($val->id == $category_details->parent_id) selected @endif>{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="description" type="text" value="{{ $category_details->description }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Slug (Unique ID)</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="url" type="text" value="{{ $category_details->url }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Materials / Care Instruction</label>
                        <div class="col-sm-9">
                            {{--<input class="form-control" name="material_care_instruction" type="text" value="{{ $category_details->material_care_instruction }}" required>--}}
                            <textarea class="form-control" rows="6" name="material_care_instruction">{!! $category_details->material_care_instruction !!}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dimensions</label>
                            <div class="col-sm-3 text-center">
                               <label class="control-label">Weight</label>
                               <div class="input-group">
                                    @php
                                        $weight = 0;
                                        $weight2 = 0;
                                        $weight_unit = 'oz';
                                        $weight_unit2 = 'oz';
                                        if( str_replace('\'', '', $category_details->weight ) != '' ):
                                            list( $weight, $weight_unit, $weight2, $weight_unit2 ) = explode( '_', $category_details->weight );
                                        endif;
                                    @endphp
                                        <input type="number" class="form-control text-right" name="weight" id="weight" value="{{ old( 'weight',  $weight ) }}" min="0" step="0.01" required placeholder="0.00">
                                        <select name="weight_unit" id="weight_unit" class="form-control input-group-addon">
                                            <option value="lb" {{ $weight_unit == 'lb' ? 'selected="selected"' : '' }}>lb</option>
                                            <option value="kg" {{ $weight_unit == 'kg' ? 'selected="selected"' : '' }}>kg</option>
                                        </select>
                                        <input type="number" class="form-control text-right" name="weight2" id="weight2" value="{{ old( 'weight2',  $weight2 ) }}" min="0" step="0.01" required placeholder="0.00">
                                        <span class="input-group-addon"><input type="hidden" name="weight_unit2" id="weight_unit2" value="{{ $weight_unit2 }}"/>oz</span>
                                </div>
                            </div>
                            <div class="col-sm-2 text-center">
                               <label class="control-label">Length</label>
                               <div class="input-group">
                                    @php
                                        $length = 0;
                                        $length_unit = '';
                                        if( str_replace('\'', '', $category_details->length ) != '' ):
                                            list( $length, $length_unit ) = explode( '_', $category_details->length );
                                        endif;
                                    @endphp
                                    <input type="number" class="form-control text-right" name="length" id="length" value="{{ old( 'length',  $length ) }}" min="0" step="0.01" required placeholder="0.00">
                                    <select name="length_unit" id="length_unit" class="form-control input-group-addon">
                                        <option value="in" {{ $length_unit == 'in' ? 'selected="selected"' : '' }}>in</option>
                                        <option value="ft" {{ $length_unit == 'ft' ? 'selected="selected"' : '' }}>ft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 text-center">
                               <label class="control-label">Width</label>
                               <div class="input-group">
                                   @php
                                        $width = 0;
                                        $width_unit = '';
                                        if( str_replace('\'', '', $category_details->width ) != '' ):
                                            list( $width, $width_unit ) = explode( '_', $category_details->width );
                                        endif;
                                    @endphp
                                    <input type="number" class="form-control text-right" name="width" id="width" value="{{ old( 'width', $width ) }}" min="0" step="0.01" required placeholder="0.00">
                                    <select name="width_unit" id="width_unit" class="form-control input-group-addon">
                                        <option value="in" {{ $width_unit == 'in' ? 'selected="selected"' : '' }}>in</option>
                                        <option value="ft" {{ $width_unit == 'ft' ? 'selected="selected"' : '' }}>ft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 text-center">
                               <label class="control-label">Height</label>
                               <div class="input-group">
                                   @php
                                        $height = 0;
                                        $height_unit = '';
                                        if( str_replace('\'', '', $category_details->height ) != '' ):
                                            list( $height, $height_unit) = explode( '_', $category_details->height );
                                        endif;
                                    @endphp
                                    <input type="number" class="form-control text-right" name="height" id="height" value="{{ old( 'height',  $height ) }}" min="0" step="0.01" required placeholder="0.00">
                                    <select name="height_unit" id="height_unit" class="form-control input-group-addon">
                                        <option value="in" {{ $height_unit == 'in' ? 'selected="selected"' : '' }}>in</option>
                                        <option value="ft" {{ $height_unit == 'ft' ? 'selected="selected"' : '' }}>ft</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Size chart available</label>
                        <div class="col-sm-9">
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="1" name="is_sizechart" {{ $category_details->is_sizechart == 1 ? "checked" : "" }}>
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Yes</span>
                            </label>

                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="0" name="is_sizechart" {{ $category_details->is_sizechart == 0 ? "checked" : "" }}>
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
                    @php
                        $desktopImageName = $mobileImageName = '';
                        if( !empty( $category_details->size_chart_image ) ) {
                            $size_chart_images = @unserialize($category_details->size_chart_image);
                            if( $size_chart_images !== false && is_array( $size_chart_images  ) ) {
                                $desktopImageName = isset( $size_chart_images['desktop'] ) && !empty( $size_chart_images['desktop'] ) ? $size_chart_images['desktop'] : '';
                                $mobileImageName = isset( $size_chart_images['mobile'] ) && !empty( $size_chart_images['mobile'] ) ? $size_chart_images['mobile'] : '';
                            }
                        }
                    @endphp
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Size Chart Preview</label>
                        <div class="col-sm-4">
                            @if(!empty($desktopImageName))
                                <img src="{{ asset('img/products/drop/'.$size_chart_images['desktop']) }}" style="width: 100%;">
                            @else
                                <p>No desktop size chart image</p>
                            @endif
                        </div>
                        <div class="col-sm-4">
                            @if(!empty($mobileImageName))
                                <img src="{{ asset('img/products/drop/'.$size_chart_images['mobile']) }}" style="width: 100%;">
                            @else
                                <p>No mobile size chart image</p>
                            @endif
                        </div>
                    </div>


                </div>

                <footer class="card-footer text-right">
                    <button class="btn btn-secondary" type="reset">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </footer>
            </form>

        </div>


        <div class="col-lg-6">

        </div>








    </div>
</div><!--/.main-content -->

@include('admin.pages.layouts.footer')
