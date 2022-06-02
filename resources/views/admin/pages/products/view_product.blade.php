@section('script')

<script>

$(document).ready(function () {


        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))
         {
            $(".sub_chk").prop('checked', true);
         } else {
            $(".sub_chk").prop('checked',false);
         }


        });


    });

function deleteMultiple(){

  var checkedVals = $('.sub_chk:checkbox:checked').map(function() {
return this.value;
}).get();
alert(checkedVals.join(","));

}

</script>

@endsection

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

            <div class="col-lg-6">
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
            </div>
            <div class="col-lg-6"></div>


            <!--
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            | Zero configuration
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            !-->
            <div class="card">
                <h4 class="card-title">Manage Products
                  <a href="javascript:;" class="text-white btn btn-danger multi-delete-product"><i class="fa fa-trash"></i> Delete Selected</a>
                  <a href="{{ url('/dashboard/add-product') }}" class="btn btn-primary text-white"><i class="ti-plus"></i> add product</a>

                </h4>

                <div class="card-body">

                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                            <th width="50px"><input autocomplete="off" type="checkbox" id="master"></th>
                            <th>Product Id</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Category Name</th>
                            <th>Collection Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><input type="checkbox" autocomplete="off" class="sub_chk" value="{{$product->id}}" name="delete_ids[]"></td>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->product_code }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->collection_name }}</td>
                                <td style="max-width: 500px;">
                                    <div style="max-width: 100%;overflow: scroll;max-height: 130px;">
                                    {!! $product->description !!}
                                    </div>
                                    
                                </td>
                                <td>
                                    @php $color_image = $images->where('product_id', $product->id)->first() @endphp
                                        {{--@dd($color_image)--}}
                                        @if(!empty($color_image->filename))
                                            <img src="{{ asset('img/products/drop/'.$color_image->filename) }}" style="width: 50px;">
                                        @endif

                                </td>
                                <td>
                                    <a href="{{ url('/dashboard/add-image/'.$product->id) }}" class="btn btn-warning btn-sm">Images</a>
                                    <a href="{{ url('/dashboard/add-attribute/'.$product->id) }}" class="btn btn-success btn-sm">Attributes</a>
                                    <a href="{{ url('/dashboard/edit-product/'.$product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="javascript:;" class="btn btn-danger btn-sm delete-product" data-pid="{{ $product->id }}">Delete</a>
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
