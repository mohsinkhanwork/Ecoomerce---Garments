@section('style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('script')
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
    $( "#free_shipping_from" ).datepicker();
    $( "#free_shipping_to" ).datepicker();
  } );
</script>
@endsection

@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>General Settings</strong>
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

                @if (session('errors'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    @foreach ( session('errors') as $error )
                        {{ $error }}<br/>
                    @endforeach
                    </div>
                @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!--
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            | Zero configuration
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            !-->
            <form action="{{ url('/dashboard/settings/general') }}" method="post" class="form">
            @csrf
                <div class="card">
                    <div class="card-header" style="justify-content: end;">
                        {{-- <h1 class="card-title">General Settings</h1> --}}
                        <input type="submit" name="submit" value="Save" class="btn btn-success">
                    </div>
                    <div class="card-block">
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <h6> Debug Mode </h6>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label for="env_debug_mode_enable" class="control-label">
                                                <input type="radio" name="env_debug_mode" id="env_debug_mode_enable" value="1" {{ env('APP_DEBUG') === true ? 'checked=""checked' : '' }}>
                                                <span> &nbsp; Enable</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="env_debug_mode_disable" class="control-label">
                                                <input type="radio" name="env_debug_mode" id="env_debug_mode_disable" value="0" {{ env('APP_DEBUG') === false ? 'checked=""checked' : '' }}>
                                                <span> &nbsp; Disable</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <h6> Maintenance Mode </h6>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label for="env_maintenance_mode_enable" class="control-label">
                                                <input type="radio" name="env_maintenance_mode" id="env_maintenance_mode_enable" value="1" {{ env('COMING_SOON') === true ? 'checked=""checked' : '' }}>
                                                <span> &nbsp; Enable</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="env_maintenance_mode_disable" class="control-label">
                                                <input type="radio" name="env_maintenance_mode" id="env_maintenance_mode_disable" value="0" {{ env('COMING_SOON') === false ? 'checked=""checked' : '' }}>
                                                <span> &nbsp; Disable</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <h6> Shippo Mode </h6>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label for="env_shippo_mode_live" class="control-label">
                                                <input type="radio" name="env_shippo_mode" id="env_shippo_mode_live" value="live" {{ env('SHIPPO_MODE') == 'live' ? 'checked=""checked' : '' }}>
                                                <span> &nbsp; Live</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="env_shippo_mode_test" class="control-label">
                                                <input type="radio" name="env_shippo_mode" id="env_shippo_mode_test" value="test" {{ env('SHIPPO_MODE') == 'test' ? 'checked=""checked' : '' }}>
                                                <span> &nbsp; Test</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr>
                            <h2>Shipping Settings</h2>

                            <div class="row form-group">

                                <div class="col-sm-12">
                                  <h6> Enable Free Shipping</h6>
                                    <div class="form-inline">

                                        <div class="form-group">
                                            <label for="enable_free_shipping" class="control-label">
                                                <input type="radio" name="enable_free_shipping" value="yes" {{ $data['enable_free_shipping']->value == 'yes' ? 'checked' : '' }}>
                                                <span> &nbsp; yes</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="enable_free_shipping" class="control-label">
                                              <input type="radio" name="enable_free_shipping" value="no" {{ $data['enable_free_shipping']->value == 'no' ? 'checked' : '' }}>
                                                <span> &nbsp; No</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr>

                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="form-group">
                                              <h6> Free Shipping From </h6>
                                            <input type="text" id="free_shipping_from" onkeyup="return false;" class="form-control datepicker" required name="free_shipping_from" value="{{ \Carbon\Carbon::parse($data['free_shipping_from']->value)->format('m/d/Y') }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="form-group">
                                              <h6> Free Shipping To </h6>
                                            <input type="text" id="free_shipping_to" onkeyup="return false;" class="form-control datepicker" required name="free_shipping_to" value="{{ \Carbon\Carbon::parse($data['free_shipping_to']->value)->format('m/d/Y') }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="form-group">
                                              <h6 style="text-transform:capitalize;"> Free Shipping Cart Amount  </h6>
                                            <input type="text" value="{{ $data['free_shipping_cart_amount']->value }}" name="free_shipping_cart_amount" class="form-control" required  >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2>Shipping From Address</h2>
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="form-group">
                                              <h6 style="text-transform:capitalize;"> name </h6>
                                            <input type="text" value="{{ $data['shipping_from_name']->value }}" name="shipping_from_name" class="form-control" required  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="form-group">
                                              <h6 style="text-transform:capitalize;"> company </h6>
                                            <input type="text" value="{{ $data['shipping_from_company']->value }}" name="shipping_from_company" class="form-control" required  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="form-group">
                                              <h6 style="text-transform:capitalize;"> street1 </h6>
                                            <input type="text" value="{{ $data['shipping_from_street1']->value }}" name="shipping_from_street1" class="form-control" required  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="form-group">
                                              <h6 style="text-transform:capitalize;"> city </h6>
                                            <input type="text" value="{{ $data['shipping_from_city']->value }}" name="shipping_from_city" class="form-control" required  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="form-group">
                                              <h6 style="text-transform:capitalize;"> state </h6>
                                            <input type="text" value="{{ $data['shipping_from_state']->value }}" name="shipping_from_state" class="form-control" required  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="form-group">
                                              <h6 style="text-transform:capitalize;"> zip </h6>
                                            <input type="text" value="{{ $data['shipping_from_zip']->value }}" name="shipping_from_zip" class="form-control" required  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="form-group">
                                              <h6 style="text-transform:capitalize;"> country </h6>
                                            <input type="text" value="{{ $data['shipping_from_country']->value }}" name="shipping_from_country" class="form-control" required  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="form-group">
                                              <h6 style="text-transform:capitalize;"> phone </h6>
                                            <input type="text" value="{{ $data['shipping_from_phone']->value }}" name="shipping_from_phone" class="form-control" required  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="form-group">
                                              <h6 style="text-transform:capitalize;"> email </h6>
                                            <input type="text" value="{{ $data['shipping_from_email']->value }}" name="shipping_from_email" class="form-control" required  >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-footer text-right">
                        <input type="submit" name="submit" value="Save" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!--/.main-content -->

@include('admin.pages.layouts.footer')
