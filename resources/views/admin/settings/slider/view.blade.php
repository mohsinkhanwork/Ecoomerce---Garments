@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>{{ $collection->name }}</strong>
        </h1>
    </div>
</header><!--/.header -->

<div class="main-content">
    <div class="row">
        <div class="col-sm-12">
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
            | Zero configuration
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            !-->
            <form action="{{ url('/dashboard/settings/sliders/save') }}" method="post" class="form">
            @csrf
            @if( $collection->products && $collection->products->count() > 0 )
                @foreach ($collection->products as $product)
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">{{ $product->product_name }}</h1>
                        </div>
                        <div class="card-block">
                            <div class="card-title">
                                <h4><strong>Home Page</strong></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h4 class="text-center">Scroll 1</h4>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            @if( $product->color_image->count() > 0 )
                                                @foreach( $product->color_image as $image )
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="HomeSliderImg{{ $image->id }}" class="control-label">
                                                                <img src="{{ '/img/products/drop/'.$image->filename }}" id="HomeSliderImg{{ $image->id }}" alt="{{ $product->name }}">
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control text-right" step="1" min="0" name="homepage_scroll_1[{{$collection->id}}][{{$product->id}}][{{$image->id}}]" value="{{ !empty( $image->slider_scroll_1 ) ? $image->slider_scroll_1 : 0 }}">
                                                                <span class="input-group-addon">seconds</span>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h4 class="text-center">Scroll 2</h4>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            @if( $product->color_image->count() > 0 )
                                                @foreach( $product->color_image as $image )
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="HomeSliderImg{{ $image->id }}" class="control-label">
                                                                <img src="{{ '/img/products/drop/'.$image->filename }}" id="HomeSliderImg{{ $image->id }}" alt="{{ $product->name }}">
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control text-right" step="1" min="0" name="homepage_scroll_2[{{$collection->id}}][{{$product->id}}][{{$image->id}}]" value="{{ !empty( $image->slider_scroll_1 ) ? $image->slider_scroll_2 : 0 }}">
                                                                <span class="input-group-addon">seconds</span>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-block">
                            <div class="card-title">
                                <h4><strong>Description Page</strong></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h4 class="text-center">Scroll 1</h4>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            @if( $product->color_image->count() > 0 )
                                                @php
                                                    $color_ids = $product->color_image->pluck('id')->toArray();
                                                    $description_sliders = App\DescriptionSlider::whereIn('color_id', $color_ids)->orderBy('color_id', 'asc')->get();
                                                @endphp
                                                @if( $description_sliders->count() > 0 )
                                                    @foreach ( $description_sliders as $slide )
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="HomeSliderImg{{ $slide->id }}" class="control-label">
                                                                    <img src="{{ '/img/products/drop/'.$slide->filename }}" id="HomeSliderImg{{ $slide->id }}" alt="{{ $product->name }}">
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control text-right" step="1" min="0" name="description_scroll_1[{{$collection->id}}][{{$product->id}}][{{$image->id}}][{{$slide->id}}]" value="{{ !empty( $slide->slider_scroll_1 ) ? $slide->slider_scroll_1 : 0 }}">
                                                                    <span class="input-group-addon">seconds</span>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <input type="submit" name="submit" value="Save" class="btn btn-success">
                        </div>
                    </div>
                @endforeach
            @endif
            </form>
        </div>
    </div>
</div><!--/.main-content -->

@include('admin.pages.layouts.footer')