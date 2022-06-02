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
                        url: '/dashboard/delete-multi-customer',
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
            <strong>Customers</strong>
        </h1>
        {{--<a href="{{ url('/dashboard/add-category') }}" class="btn btn-float btn-sm btn-primary"><i class="ti-plus"></i></a>--}}
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
                <h4 class="card-title">
                  Manage Customers
                  <a href="javascript:;" class="text-white btn btn-danger multi-delete-data"><i class="fa fa-trash"></i> Delete Selected</a>

                </h4>

                <div class="card-body">

                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                          <th width="50px"><input autocomplete="off" type="checkbox" id="master"></th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            {{--<th>Billing_Address</th>
                            <th>Billing_City</th>
                            <th>Billing_State</th>
                            <th>Billing_Zip</th>
                            <th>Same_Address</th>
                            <th>Shipping_Name</th>
                            <th>Shipping_Email</th>
                            <th>Shipping_Address</th>
                            <th>Shipping_City</th>
                            <th>Shipping_State</th>
                            <th>Shipping_Zip</th>--}}
                            <th>Date/Time</th>
                            <th>Detail</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                              <td><input type="checkbox" autocomplete="off" class="sub_chk" value="{{$customer->id}}" name="delete_ids[]"></td>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->billing_fullname }}</td>
                                <td>{{ $customer->billing_email }}</td>
                                {{--<td>{{ $customer->billing_address }}</td>
                                <td>{{ $customer->billing_city }}</td>
                                <td>{{ $customer->billing_state }}</td>
                                <td>{{ $customer->billing_zip }}</td>
                                <td>{{ $customer->same_address }}</td>
                                <td>{{ $customer->shipping_fullname }}</td>
                                <td>{{ $customer->shipping_email }}</td>
                                <td>{{ $customer->shipping_address }}</td>
                                <td>{{ $customer->shipping_city }}</td>
                                <td>{{ $customer->shipping_state }}</td>
                                <td>{{ $customer->shipping_zip }}</td>--}}
                                <td>{{ $customer->created_at }}</td>
                                <td><a href="javascript:;" class="btn btn-info btn-sm view-customer-detail" data-cid="{{ $customer->id }}">View</a></td>
                                <td>
                                    {{--<a href="{{ url('/dashboard/edit-customer/'.$customer->id) }}" class="btn btn-primary btn-sm">Edit</a>--}}
                                    <a href="{{ url('/dashboard/delete-customer/'.$customer->id) }}" onclick="return confirm('Are you sure you want to delete a data?')" class="btn btn-danger btn-sm">Delete</a>
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

<!-- Modal -->
<div class="modal fade" id="customerDetailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Customer Detail</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Billing &amp; Shipping Detail</h5>
                <table class="table table-responsive">
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@include('admin.pages.layouts.footer')
