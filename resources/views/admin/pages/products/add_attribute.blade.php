@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Product Attributes</strong>
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
            {{--{{ dd($product_details) }}--}}
            <form class="card" enctype="multipart/form-data" method="post" action="{{ url('/dashboard/add-attribute/'.$product_details->id) }}">
                <h4 class="card-title"><strong>Add Product Attributes</strong>
                  <a href="{{ url('/dashboard/add-image/'.$product_details->id) }}" class="btn btn-sm btn-orange text-white"><i class="fa fa-arrow-left"></i> Product Images </a>
</h4>
                @csrf

                @if (session('status'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ session('status') }}</strong>
                        </span>
                @endif

                <div class="card-body">

                    <input type="hidden" name="product_id" value="{{ $product_details->id }}">

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Name</label>
                        <div class="col-sm-8">
                            <label><strong>{{ $product_details->product_name }}</strong></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Product Code</label>
                        <div class="col-sm-8">
                            <label><strong>{{ $product_details->product_code }}</strong></label>
                        </div>
                    </div>

                    <div class="form-group row field_wrapper">
                            <div class="form-inline">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input class="form-control" name="sku[]" id="sku" type="text" placeholder="SKU" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {{--<input class="form-control" name="size[]" id="size" type="text" placeholder="Size" required>--}}
                                        <select class="form-control" name="size[]" id="size" required>
                                            <option value="0">-- Select Size --</option>
                                            <option value="1">One Size</option>
                                            <option value="s">S</option>
                                            <option value="m">M</option>
                                            <option value="l">L</option>
                                            <option value="xl">XL</option>
                                            <option value="2xl">2XL</option>
                                            <option value="3xl">3XL</option>
                                            <option value="4xl">4XL</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input class="form-control" name="price[]" id="price" type="text" placeholder="Price" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <a href="javascript:void(0)" class="btn btn-success add_field"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                    </div>

                </div>

                <footer class="card-footer text-right">
                  <a href="{{ url('/dashboard/add-image/'.$product_details->id) }}" class="btn btn-sm btn-orange text-white pull-left"><i class="fa fa-arrow-left"></i> Product Images </a>

                    <button class="btn btn-secondary" type="reset">Cancel</button>
                    <button class="btn btn-primary" type="submit">Add Product Attributes</button>
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
                <h4 class="card-title">Product Attributes</h4>

                <div class="card-body">

                    {{-- <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables"> --}}
                        <table class="table table-striped table-bordered" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>SKU</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $sizes = ['1' => 'One Size', 's' => 'Small', 'm' => 'Medium', 'l' => 'Large', 'xl' => 'Extra Large', '2xl' => '2 Extra Large', '3xl' => '3 Extra Large', '4xl' => '4 Extra Large']; @endphp
                        @foreach($product_attributes_details as $attribute)
                            <tr>
                                <td>{{ $attribute->id }}</td>
                                <td>{{ $attribute->sku }}</td>
                                <td>{{ isset( $sizes[$attribute->size] ) ? $sizes[$attribute->size]: '' }}</td>
                                <td>
                                  {{ $attribute->price }}

                                  <a class="btn btn-primary text-white ml-2 btn-sm" onclick="editData('{{ $attribute->id }}')">Update </a>

                                </td>
                                <td>
                                    <a href="{{ url('/dashboard/add-attribute-color-stock/'.$attribute->id) }}" class="btn btn-success btn-sm">Stock</a>

                                    <a href="{{ url('/dashboard/delete-attribute/'.$product_details->id.'/'.$attribute->id) }}" class="btn btn-danger btn-sm">Delete</a>
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

@foreach($product_attributes_details as $key => $data)

    <div id="updateAttributeModal{{$data->id}}" class="modal fade update_dialog" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form action="{{route('update.product.attribute',$data->id)}}" enctype="multipart/form-data"
                      method="post">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;
                        </button>
                        <h4 class="modal-title">Update Product Attribute</h4>
                    </div>
                    <div class="modal-body" style="display: inline-block;">

                      <div class="form-group row field_wrapper">
                              <div class="form-inline">
                                  <div class="col-sm-3">
                                      <div class="form-group">
                                          <label>Sku</label>
                                          <input class="form-control" value="{{ $data->sku }}" name="sku" type="text" placeholder="SKU" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-3">
                                      <div class="form-group">
                                        <label>Size</label>
                                          <select class="form-control" name="size" required>
                                              <option value="0">-- Select Size --</option>
                                              <option value="1" {{ ($data->size == "1")?'selected':'' }} >One Size</option>
                                              <option value="s" {{ ($data->size == "s")?'selected':'' }} >S</option>
                                              <option value="m" {{ ($data->size == "m")?'selected':'' }} >M</option>
                                              <option value="l" {{ ($data->size == "l")?'selected':'' }} >L</option>
                                              <option value="xl" {{ ($data->size == "xl")?'selected':'' }} >XL</option>
                                              <option value="2xl" {{ ($data->size == "2xl")?'selected':'' }} >2XL</option>
                                              <option value="3xl" {{ ($data->size == "3xl")?'selected':'' }} >3XL</option>
                                              <option value="4xl" {{ ($data->size == "4xl")?'selected':'' }} >4XL</option>
                                          </select>

                                      </div>
                                  </div>
                                  <div class="col-sm-3">
                                      <div class="form-group">
                                        <label>Price</label>
                                          <input class="form-control" value="{{ $data->price }}" name="price" type="text" placeholder="Price" required>
                                      </div>
                                  </div>

                              </div>
                      </div>

                  </div>
                    <div class="modal-footer">
                        <a class="btn btn-default pull-left" data-dismiss="modal">Close
                        </a>
                        <button type="submit" class="btn btn-primary text-white pull-right dark">
                            Update
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>


@endforeach
<script>
function editData(id) {

    $('#updateAttributeModal' + id).modal('show');

}
</script>

@include('admin.pages.layouts.footer')
