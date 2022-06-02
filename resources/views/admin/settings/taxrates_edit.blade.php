@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Edit Tax Rate</strong>
        </h1>
        <a href="{{ url('/dashboard/settings/taxrates') }}" class="btn btn-float btn-sm btn-primary"><i class="ti-list"></i></a>
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
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <!--
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            | Zero configuration
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            !-->
            <form class="card" method="post" action="{{ url( '/dashboard/settings/taxrates/update/' . $taxrate->id ) }}">
                @csrf
                <h4 class="card-title">Edit Tax Rate</h4>

                <div class="card-body">

                    <div class="form-group row">
                        <label for="taxrate_country" class="control-label col-sm-2 text-right bold">Country:</label>
                        <div class="col-sm-6">
                            <select type="text" class="form-control" id="taxrate_country" name="country_id" required>
                                <option value=""> &mdash; Select Country &mdash; </option>
                                @if( $countries )
                                    @foreach ( $countries as  $country )
                                        <option value="{{ $country->id }}" {{ $country->id == $taxrate->country_id ? 'selected="selected"' : ''}}> {{ $country->name }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="taxrate_state" class="control-label col-sm-2 text-right bold">State:</label>
                        <div class="col-sm-6">
                            <select type="text" class="form-control" id="taxrate_state" name="state_id" required>
                                <option value=""> &mdash; Select State &mdash; </option>
                                @if( $states )
                                    @foreach ( $states as  $state )
                                        <option value="{{ $state->id }}" {{ $state->id == $taxrate->state_id ? 'selected="selected"' : ''}}> {{ $state->name }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="taxrate_rate" class="control-lable col-sm-2 text-right bold">Rate:</label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <input type="number" name="rate" id="taxrate_rate" class="form-control text-right" min="0" step="0.01" value="{{ old( 'rate', $taxrate->rate ) }}" required>
                                <span class="input-group-addon"><strong>%</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="taxrate_status" class="control-lable col-sm-2 text-right bold">Status:</label>
                        <div class="col-sm-6">
                            <label for="taxrate_status_active" style="margin-right: 20px;">
                                <input type="radio" name="status" id="taxrate_status_active" value="1" {{ $taxrate->status == 1 ? 'checked="checked"' : ''}}>
                                <span style="margin-left: 5px;">Active</span>
                            </label>
                            <label for="taxrate_status_inactive">
                                <input type="radio" name="status" id="taxrate_status_inactive" value="0" {{ $taxrate->status == 0 ? 'checked="checked"' : ''}}>
                                <span style="margin-left: 5px;">Inactive</span>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="card-footer text-right">
                    <a href="{{ url('/dashboard/settings/taxrates') }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Update Rate">
                </div>
            </form>
        </div>
    </div>
</div><!--/.main-content -->

@include('admin.pages.layouts.footer')
<script type="text/javascript">
;(function($){
    $(window).on('load', function(){
        var token = $('meta[name="csrf-token"]').attr('content');

        $('#taxrate_country').on('change', function(){
            $.ajax({
                type: "GET",
                url: "/dashboard/settings/taxrates/get_states",
                data: {
                    '_method': 'GET', '_token': token, 'country_id': $(this).val()
                },
                dataType: "json",
                beforeSend: function(){
                    $('#taxrate_state').val('');
                    $('#taxrate_state').attr('disabled');
                    $('#taxrate_state').html('<option value=""> &mdash; Select State &mdash; </option>');
                },
                success: function (options) {
                    if( options ){
                        // options = $.parseJSON( options );
                        $(options).each(function(idx, opt){
                            var selected = '';
                            if( opt.id == 231 ) { //Pre-select United States
                                selected = 'selected="selected"';
                            }
                            $('#taxrate_state').append('<option value="'+opt.id+'" '+selected+'>'+opt.name+'</option>');
                        });
                        $('#taxrate_state').removeAttr('disabled');
                    }
                }
            });
        });
    });
})(jQuery);
</script>