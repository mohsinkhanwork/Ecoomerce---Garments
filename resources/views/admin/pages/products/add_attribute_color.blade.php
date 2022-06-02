@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Attribute Colors Stock</strong>
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
            <form class="card" enctype="multipart/form-data" method="post" action="{{ url('/dashboard/add-attribute-color-stock/'.$attribute_details->id) }}">
                <h4 class="card-title">
                  <strong>Add Attribute Colors Stock</strong>
                  <a href="{{ url('/dashboard/add-attribute/'.$attribute_details->product_id) }}" class="btn text-white btn-orange"><i class="fa fa-arrow-left"></i> Attribute List</a>
                </h4>
                @csrf

                @if (session('status'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ session('status') }}</strong>
                        </span>
                @endif

                <div class="card-body">

                    <input type="hidden" name="attribute_id" value="{{ $attribute_details->id }}">

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Name</label>
                        <div class="col-sm-8">
                            <label><strong>{{ $product_name->product_name }}</strong></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Code</label>
                        <div class="col-sm-8">
                            <label><strong>{{ $product_name->product_code }}</strong></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product SKU</label>
                        <div class="col-sm-8">
                            <label><strong>{{ $attribute_details->sku }}</strong></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Size</label>
                        <div class="col-sm-8">
                            <label><strong><td>{{ (($attribute_details->size == 's') ? 'Small' : (($attribute_details->size == 'm') ? 'Medium' : (($attribute_details->size == 'l') ? 'Large' : (($attribute_details->size == 'xl') ? 'Extra Large' : (($attribute_details->size == '2xl') ? '2 Extra Large' : (($attribute_details->size == '3xl') ? '3 Extra Large' : (($attribute_details->size == '4xl') ? '4 Extra Large' : ''))))))) }}</td></strong></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Stock</label>
                        <div class="col-sm-8">
                            <label><strong>{{ $attribute_details->stock }}</strong></label>
                        </div>
                    </div>


                    @foreach($product_colors_data as $colors_data)
                    <div class="form-group row color_field_wrapper">

                        <input type="hidden" name="color_id[]" value="{{ $colors_data->id}}">
                        <input type="hidden" name="color_code[]" value="{{ $colors_data->color_code}}">
                        <input type="hidden" name="color_name[]" value="{{ $colors_data->color_name}}">

                        <div class="form-inline">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    {{--<input class="form-control" name="color_code[]" id="color_code" type="text" value="#33cabb" data-provide="colorpicker" required>--}}
                                    <span style="height: 25px; width: 25px; background-color:{{ $colors_data->color_code }}; border-radius: 50%; display: inline-block;"></span>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    {{--<input class="form-control" name="color_name[]" id="color_name" type="text" placeholder="Color Name" required>--}}
                                    <label><strong>{{ $colors_data->color_name }}</strong></label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                {{--<a href="javascript:void(0)" class="btn btn-success add_color_field"><i class="fa fa-plus"></i></a>--}}
                                <input class="form-control color-stock" name="color_stock[]" id="color_stock" type="text" placeholder="Enter Color-Wise Stock" required>
                            </div>
                        </div>

                    </div>
                    @endforeach

                </div>

                <footer class="card-footer text-right">
                  <a href="{{ url('/dashboard/add-attribute/'.$attribute_details->product_id) }}" class="btn text-white pull-left btn-primary"><i class="fa fa-arrow-left"></i> Attribute List</a>

                    <button class="btn btn-secondary" type="reset">Cancel</button>
                    <button class="btn btn-primary" type="submit">Add Attribute Colors</button>
                </footer>
            </form>

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
                <h4 class="card-title">Attribute Colors Stock</h4>

                <div class="card-body">

                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Attribute Id</th>
                            <th>Color Id</th>
                            <th>Color Preview</th>
                            <th>Color Name</th>
                            <th>Color Stock</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($attribute_colors_data as $colors)
                            <tr>
                                <td>{{ $colors->id }}</td>
                                <td>{{ $colors->attribute_id }}</td>
                                <td>{{ $colors->color_id }}</td>
                                <td><span style="height: 25px; width: 25px; background-color:{{$colors->color_code}}; border-radius: 50%; display: inline-block;"></span></td>
                                <td>{{ $colors->color_name }}</td>
                                <td>{{ $colors->color_stock }}</td>
                                <td>
                                    <input type="number" name="quantity" value="{{ $colors->color_stock }}" step="1" min="0" max="500" maxlength="3" autocomplete="off">
                                    <a href="javascript:;" class="btn btn-warning btn-sm attribute-color-stock-update" data-acid="{{ $colors->id }}">Update Stock</a>

                                    <p style="margin: 10px 0px 0;">Cart Maximum Qty</p>
                                    <input type="number" id="max_cart_qty_{{ $colors->id }}" name="max_cart_qty" value="{{ $colors->max_cart_qty }}" step="1" min="0" max="500" maxlength="3" autocomplete="off">
                                    <a href="javascript:;" class="btn btn-warning btn-sm attribute-color-max-qty-update" data-acid="{{ $colors->id }}">Update</a>
                                    {{--<a href="{{ url('/dashboard/delete-attribute-color/'.$attribute_details->id.'/'.$colors->id) }}" class="btn btn-danger btn-sm">Delete</a>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!--/.main-content -->

@include('admin.pages.layouts.footer')
