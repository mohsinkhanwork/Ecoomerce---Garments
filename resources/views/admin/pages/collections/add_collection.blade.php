@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Collections</strong>
        </h1>
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
                <form class="card" method="post" action="{{ url('/dashboard/add-collection') }}">
                    <h4 class="card-title"><strong>Add Collection</strong>
                      <a href="{{ url('/dashboard/manage-collection') }}" class="btn btn-orange text-white pull-right"><i class="fa fa-arrow-left"></i> Back</a>
                    </h4>

                    @csrf

                    @if (session('status'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ session('status') }}</strong>
                        </span>
                    @endif

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Collection Name</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="name" type="text" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="description" type="text" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Collection Order</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="order" id="order">
                                    <option value="0" selected>--Select Collection Order--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" value="1" name="status" checked>
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Active</span>
                                </label>

                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" value="0" name="status">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Inactive</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Homepage Slider Speed</label>
                            <div class="col-sm-2">
                                <input class="form-control text-center" name="slider_speed" type="number" min="0" step="1" value="{{ old('slider_speed', '7' ) }}" required>
                                <em class="text-muted">(seconds)</em>
                            </div>
                        </div>

                    </div>

                    <footer class="card-footer text-right">
                        <button class="btn btn-secondary" type="reset">Cancel</button>
                        <button class="btn btn-primary" type="submit">Add Collection</button>
                    </footer>
                </form>

        </div>


        <div class="col-lg-6">

        </div>








    </div>
</div><!--/.main-content -->

@include('admin.pages.layouts.footer')
