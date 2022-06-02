@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Collections</strong>
        </h1>
        <a href="{{ url('/dashboard/manage-collection') }}" class="btn btn-float btn-sm btn-primary"><i class="ti-list"></i></a>
    </div>
</header><!--/.header -->

<div class="main-content">
    <div class="row">

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

        <!--
          |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
          | Horizontal form
          |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
          !-->
            <form class="card" method="post" action="{{ url('/dashboard/edit-collection/'.$collection_details->id) }}">
                <h4 class="card-title"><strong>Edit Collection</strong></h4>
                @csrf

                @if (session('status'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ session('status') }}</strong>
                        </span>
                @endif

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="name" type="text" value="{{ $collection_details->name }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="description" type="text" value="{{ $collection_details->description }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Collection Order</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="order" id="order">
                                <option value="0">--Select Collection Order--</option>
                                <option value="1" {{ $collection_details->order == 1 ? "selected" : "" }}>1</option>
                                <option value="2" {{ $collection_details->order == 2 ? "selected" : "" }}>2</option>
                                <option value="3" {{ $collection_details->order == 3 ? "selected" : "" }}>3</option>
                                <option value="4" {{ $collection_details->order == 4 ? "selected" : "" }}>4</option>
                                <option value="5" {{ $collection_details->order == 5 ? "selected" : "" }}>5</option>
                                <option value="6" {{ $collection_details->order == 6 ? "selected" : "" }}>6</option>
                                <option value="7" {{ $collection_details->order == 7 ? "selected" : "" }}>7</option>
                                <option value="8" {{ $collection_details->order == 8 ? "selected" : "" }}>8</option>
                                <option value="9" {{ $collection_details->order == 9 ? "selected" : "" }}>9</option>
                                <option value="10" {{ $collection_details->order == 10 ? "selected" : "" }}>10</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="1" name="status" {{ $collection_details->status == 1 ? "checked" : "" }}>
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Active</span>
                            </label>

                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="0" name="status" {{ $collection_details->status == 0 ? "checked" : "" }}>
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Inactive</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Homepage Slider Speed</label>
                        <div class="col-sm-2">
                            <input class="form-control text-center" name="slider_speed" type="number" min="0" step="1" value="{{ $collection_details->slider_speed }}" required>
                            <em class="text-muted">(seconds)</em>
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