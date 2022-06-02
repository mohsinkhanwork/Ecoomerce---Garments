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


    // multi Delete Product
    $(document).on('click', '.multi-delete-data', function () {


      var checkedVals = $('.sub_chk:checkbox:checked').map(function() {
    return this.value;
    }).get();

        var ids = checkedVals.join(",");
        var token = $('meta[name="csrf-token"]').attr('content');

        if(ids == ''){
          swal({
              title: "Error!",
              text: "Please Select the data rows!",
              type: "warning"
          });
          return false;
        }


        swal({
            title: 'Are you sure?',
            text: "It will permanently delete the selected rows ["+ids+"] with all its data.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {

                return new Promise(function (resolve) {
                    $.ajax({
                        url: '/dashboard/settings/taxrates/delete-multi-taxrate',
                        type:"POST",
                        dataType:"json",
                        data: { '_method': 'POST', '_token': token, 'ids': ids },
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },

                        success: function (response) {

                            //console.log(response);

                                if (response.code == '200') {
                                    swal({
                                        title: "Deleted!",
                                        text: "Data has been deleted successfully!",
                                        type: "success",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                } else if (response.code == '400') {
                                    swal({
                                        title: "Failed!",
                                        text: "Data has not been deleted successfully!",
                                        type: "warning",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: "Error!",
                                        text: "Bad request!",
                                        type: "warning",
                                        showConfirmButton: true

                                    }).then(function () {
                                        location.reload();
                                    });
                                }

                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                });
            }

        }).catch(swal.noop);

    });
    /************ ./multi Delete Product **************/

</script>
@endsection

@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Tax Rates</strong>
        </h1>
        <a href="{{ url('/dashboard/settings/taxrates/create') }}" class="btn btn-float btn-sm btn-primary"><i class="ti-plus"></i></a>
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
            <div class="card">
                <h4 class="card-title">Manage Tax Rates
                  <a href="javascript:;" class="text-white btn btn-danger multi-delete-data"><i class="fa fa-trash"></i> Delete Selected</a>
                </h4>

                <div class="card-body">

                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                          <th width="50px"><input autocomplete="off" type="checkbox" id="master"></th>
                            <th class="text-center">Id</th>
                            <th>Country</th>
                            <th class="text-center">State</th>
                            <th class="text-center">Tax Rate</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($taxrates as $taxrate)
                            @php
                                $cname = $taxrate->country_id ? $taxrate->country->name : '';
                                $sname = $taxrate->state_id ? $taxrate->state->name : '';
                            @endphp
                        <tr id="taxrate{{$taxrate->id}}">
                          <td><input autocomplete="off" type="checkbox" class="sub_chk" value="{{$taxrate->id}}" name="delete_ids[]"></td>
                            <td style="vertical-align: middle;" class="text-center">{{ $taxrate->id }}</td>
                            <td style="vertical-align: middle;" id="taxrate_country_{{$taxrate->id}}" data-value="{{ $taxrate->country_id }}" data-text="{{ $cname }}">{{ $cname }}</td>
                            <td style="vertical-align: middle;" id="taxrate_state_{{$taxrate->id}}" class="text-center" data-value="{{ $taxrate->state_id }}" data-text="{{ $sname }}">{{ $sname }}</td>
                            <td style="vertical-align: middle;" id="taxrate_rate_{{$taxrate->id}}" class="text-center" data-value="{{ $taxrate->rate }}" data-text="{{ $taxrate->rate }}%">{{ $taxrate->rate }}%</td>
                            <td style="vertical-align: middle;" id="taxrate_status_{{$taxrate->id}}" class="text-center" data-value="{{ $taxrate->status }}" data-text="{{ $taxrate->status == 1 ? "Active" : "Inactive" }}">{{ $taxrate->status == 1 ? "Active" : "Inactive" }}</td>
                            <td style="vertical-align: middle;" class="text-center" id="taxrate_actions_{{$taxrate->id}}">
                                <div class="before-edit-actions">
                                    <a href="#" class="btn btn-primary btn-sm edit-taxrate-action" data-taxrateid="{{$taxrate->id}}">Edit</a>
                                    {{-- <a href="{{ url('/dashboard/settings/taxrates/edit/'.$taxrate->id) }}" class="btn btn-primary btn-sm">Edit</a> --}}
                                    {{-- <a href="#" class="btn btn-danger btn-sm delete-taxrate-action" onclick="return confirm('Are you sure you want to delete this tax rate?');">Delete</a> --}}
                                    <a href="{{ url('/dashboard/settings/taxrates/delete/'.$taxrate->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tax rate?');">Delete</a>
                                </div>
                                <div class="after-edit-actions" style="display: none;">
                                    <a href="#" class="btn btn-success btn-sm save-taxrate-action" data-taxrateid="{{$taxrate->id}}">Save</a>
                                    <a href="#" class="btn btn-secondary btn-sm cancel-taxrate-action" data-taxrateid="{{$taxrate->id}}">Cancel</a>
                                </div>
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

{{-- FOR EDIT PORPOSE. DO NOT DELETE --}}

<div id="editporpose_countries" style="display: none !important;">
    <select name="country" id="country" class="form-control">
        <option value=""> &mdash; Select Country &mdash; </option>
        @foreach ( $countries as $country )
            <option value="{{ $country->id }}"> {{ $country->name }} </option>
        @endforeach
    </select>
</div>
<div id="editporpose_states" style="display: none !important;">
    <select name="states" id="states" class="form-control">
        <option value=""> &mdash; Select States &mdash; </option>
    </select>
</div>
<div id="editporpose_rate" style="display: none !important;">
    <div class="input-group">
        <input type="number" name="rate" id="rate" class="form-control text-right" min="0" step="0.01">
        <span class="input-group-addon">%</span>
    </div>
</div>
<div id="editporpose_status" style="display: none !important;">
    <label>
        <input type="radio" name="status" id="status_active" value="1">
        <span> Active </span>
    </label>
    &nbsp;&nbsp;
    <label>
        <input type="radio" name="status" id="status_inactive" value="0">
        <span> Inactive </span>
    </label>
</div>

{{-- FOR EDIT PORPOSE. --}}

@include('admin.pages.layouts.footer')

<script type="text/javascript">
;(function($){
    $(window).on('load', function(){
        $('.edit-taxrate-action').each(function(idx, anchor){
            $(anchor).on('click', function(event){
                event.preventDefault();
                    var taxrateid = $(anchor).attr('data-taxrateid');

                    //--
                    $('td#taxrate_country_' + taxrateid).html( $('#editporpose_countries').html() );
                    $('td#taxrate_country_' + taxrateid).children('select').val( $('td#taxrate_country_' + taxrateid).attr('data-value') );
                    $('td#taxrate_country_' + taxrateid).children('select').attr({'id': 'country_'+taxrateid, 'name': 'country['+taxrateid+']'});
                    $('td#taxrate_country_' + taxrateid).children('select').on('change', function(){
                        var cval = $(this).val();
                        getStatesByCountry(
                            cval,
                            '',
                            $('td#taxrate_state_' + taxrateid).children('select')
                        );
                    });

                    //--
                    $('td#taxrate_state_' + taxrateid).html( $('#editporpose_states').html() );
                    getStatesByCountry(
                        $('td#taxrate_country_' + taxrateid).attr('data-value'),
                        $('td#taxrate_state_' + taxrateid).attr('data-value'),
                        $('td#taxrate_state_' + taxrateid).children('select')
                    );
                    $('td#taxrate_state_' + taxrateid).children('select').attr({'id': 'state_'+taxrateid, 'name': 'state['+taxrateid+']'});

                    //--
                    $('td#taxrate_rate_' + taxrateid).html( $('#editporpose_rate').html() );
                    $('td#taxrate_rate_' + taxrateid).children('.input-group').children('input[type="number"]').val( $('td#taxrate_rate_' + taxrateid).attr('data-value') );
                    $('td#taxrate_rate_' + taxrateid).children('.input-group').children('input[type="number"]').attr({'id': 'rate_'+taxrateid, 'name': 'rate['+taxrateid+']'});

                    //--
                    $('td#taxrate_status_' + taxrateid).html( $('#editporpose_status').html() );
                    if( $('td#taxrate_status_' + taxrateid).attr('data-value') == 1 ) {
                        $('td#taxrate_status_' + taxrateid).children('label').children('input#status_active').attr('checked', true);
                    }
                    else {
                        $('td#taxrate_status_' + taxrateid).children('label').children('input#status_inactive').attr('checked', true);
                    }
                    $('td#taxrate_status_' + taxrateid).children('label').children('input#status_active').attr({'id': 'status_active_'+taxrateid, 'name': 'status['+taxrateid+']'});
                    $('td#taxrate_status_' + taxrateid).children('label').children('input#status_inactive').attr({'id': 'status_inactive_'+taxrateid, 'name': 'status['+taxrateid+']'});

                    //--
                    $('td#taxrate_actions_' + taxrateid).children('.before-edit-actions').hide();
                    $('td#taxrate_actions_' + taxrateid).children('.after-edit-actions').show();

                return false;
            });
        });

        //--Save Editing
        $('.save-taxrate-action').each(function(idx, anchor){
            $(anchor).on('click', function(event){
                event.preventDefault();

                var taxrateid = $(anchor).attr('data-taxrateid');
                var token = $('meta[name="csrf-token"]').attr('content');
                var country_id = $('td#taxrate_country_' + taxrateid).children('select').val(),
                state_id = $('td#taxrate_state_' + taxrateid).children('select').val(),
                rate = $('td#taxrate_rate_' + taxrateid).children('.input-group').children('input[type="number"]').val(),
                status = 0;
                $.each($('td#taxrate_status_' + taxrateid).children('label'), function (indexInArray, valueOfElement) {
                    if( $(valueOfElement).children('input').prop('checked') == true ) {
                        status =  $(valueOfElement).children('input').val();
                    }
                });

                if( !country_id || !state_id || !rate ) {
                    alert('All fields are required. Please fill all fields before saving.');
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "/dashboard/settings/taxrates/update/" + taxrateid,
                    data: {
                        '_method': 'POST', '_token': token, 'country_id': country_id, 'state_id': state_id, 'rate': rate, 'status': status
                    },
                    dataType: "json",
                    async: false,
                    beforeSend: function(){
                        $('td#taxrate_country_' + taxrateid).html( 'Saving...' );
                        $('td#taxrate_state_' + taxrateid).html( 'Saving...' );
                        $('td#taxrate_rate_' + taxrateid).html( 'Saving...' );
                        $('td#taxrate_status_' + taxrateid).html( 'Saving...' );
                    },
                    success: function (response) {
                        if( response ){
                            $('td#taxrate_country_' + taxrateid).html( response.country );
                            $('td#taxrate_country_' + taxrateid).attr({'data-value': country_id, 'data-text': response.country});
                            $('td#taxrate_state_' + taxrateid).html( response.state );
                            $('td#taxrate_state_' + taxrateid).attr({'data-value': state_id, 'data-text': response.state});
                            $('td#taxrate_rate_' + taxrateid).html( response.rate );
                            $('td#taxrate_rate_' + taxrateid).attr({'data-value': rate, 'data-text': response.rate});
                            $('td#taxrate_status_' + taxrateid).html( response.status );
                            $('td#taxrate_status_' + taxrateid).attr({'data-value': status, 'data-text': response.status});
                            $('td#taxrate_actions_' + taxrateid).children('.before-edit-actions').show();
                            $('td#taxrate_actions_' + taxrateid).children('.after-edit-actions').hide();
                        }
                    },
                    error: function() {
                        var taxrateid = $(anchor).attr('data-taxrateid');
                        $('td#taxrate_country_' + taxrateid).html( $('td#taxrate_country_' + taxrateid).attr('data-text') );
                        $('td#taxrate_state_' + taxrateid).html( $('td#taxrate_state_' + taxrateid).attr('data-text') );
                        $('td#taxrate_rate_' + taxrateid).html( $('td#taxrate_rate_' + taxrateid).attr('data-text') );
                        $('td#taxrate_status_' + taxrateid).html( $('td#taxrate_status_' + taxrateid).attr('data-text') );
                        $('td#taxrate_actions_' + taxrateid).children('.before-edit-actions').show();
                        $('td#taxrate_actions_' + taxrateid).children('.after-edit-actions').hide();

                        alert('Something went wrong, please try again later.');
                    }
                });


                return false;
            });
        });

        //--Cancel Editing
        $('.cancel-taxrate-action').each(function(idx, anchor){
            $(anchor).on('click', function(event){
                event.preventDefault();

                var taxrateid = $(anchor).attr('data-taxrateid');
                $('td#taxrate_country_' + taxrateid).html( $('td#taxrate_country_' + taxrateid).attr('data-text') );
                $('td#taxrate_state_' + taxrateid).html( $('td#taxrate_state_' + taxrateid).attr('data-text') );
                $('td#taxrate_rate_' + taxrateid).html( $('td#taxrate_rate_' + taxrateid).attr('data-text') );
                $('td#taxrate_status_' + taxrateid).html( $('td#taxrate_status_' + taxrateid).attr('data-text') );
                $('td#taxrate_actions_' + taxrateid).children('.before-edit-actions').show();
                $('td#taxrate_actions_' + taxrateid).children('.after-edit-actions').hide();

                return false;
            });
        });
    });

    function getStatesByCountry( country_id, state_val, select_el ) {
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "GET",
            url: "/dashboard/settings/taxrates/get_states",
            data: {
                '_method': 'GET', '_token': token, 'country_id': country_id
            },
            dataType: "json",
            async: false,
            beforeSend: function(){
                select_el.val('');
                select_el.attr('disabled');
                select_el.html('<option value=""> &mdash; Select State &mdash; </option>');
            },
            success: function (options) {
                if( options ){
                    // options = $.parseJSON( options );
                    $(options).each(function(idx, opt){
                        var selected = '';
                        if( opt.id == state_val ) { //Pre-select United States
                            selected = 'selected="selected"';
                        }
                        select_el.append('<option value="'+opt.id+'" '+selected+'>'+opt.name+'</option>');
                    });
                    select_el.removeAttr('disabled');
                }
            }
        });
    }
})(jQuery);
</script>
