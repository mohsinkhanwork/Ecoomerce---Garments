@section('style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
    $( "#valid_from" ).datepicker();
    $( "#valid_to" ).datepicker();
  } );
</script>
@endsection

@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Add Promo Code</strong>
        </h1>
        <a href="{{ route('manage.promo.admin') }}" class="btn btn-float btn-sm btn-primary"><i class="ti-list"></i></a>
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
            <form class="card" enctype="multipart/form-data" method="post" action="{{ route('add.promo.admin') }}">
                <h4 class="card-title"><strong>Add Promo Code</strong></h4>
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
                            <input class="form-control" name="name" id="name" type="text" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Promo Type</label>
                        <div class="col-sm-8">
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="normal" name="type" checked>
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Normal</span>
                            </label>

                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="shipping" name="type">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Shipping</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Promocode Text</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="promo_code" id="promo_code" type="text" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Discount Type</label>
                        <div class="col-sm-8">

                                      <select required name="discount_type" id="discount_type" class="form-control">
                                          <option value="">Select a type</option>
                                          <option value="percentage" >Percentage</option>
                                          <option value="fixed">Fixed</option>
                                      </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Discount Amount</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="discount_amount" id="discount_amount" type="number" step="0.01" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Valid From</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control datepicker" required id="valid_from" name="valid_from" value="" onkeyup="return false;" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Valid To</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control datepicker" required id="valid_to" name="valid_to" value="" onkeyup="return false;" autocomplete="off">
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


                </div>

                <footer class="card-footer text-right">
                    <button class="btn btn-secondary" type="reset">Cancel</button>
                    <button class="btn btn-primary" type="submit">Add Promocode</button>
                </footer>
            </form>

        </div>


    </div>
</div><!--/.main-content -->

@include('admin.pages.layouts.footer')

<script>

</script>
