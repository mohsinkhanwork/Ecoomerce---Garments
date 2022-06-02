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
                        url: '/dashboard/delete-multi-collection',
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
            <strong>Collections</strong>
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
                <h4 class="card-title">Manage Collections
                  <a href="javascript:;" class="text-white btn btn-danger multi-delete-data"><i class="fa fa-trash"></i> Delete Selected</a>
                  <a href="{{ url('/dashboard/add-collection') }}" class="btn btn-primary text-white"><i class="ti-plus"></i> add Collection</a>
                </h4>

                <div class="card-body">

                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                          <th width="50px"><input autocomplete="off" type="checkbox" id="master"></th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Slider&nbsp;Speed</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($collections as $collection)
                        <tr>
                          <td><input autocomplete="off" type="checkbox" class="sub_chk" value="{{$collection->id}}" name="delete_ids[]"></td>
                            <td>{{ $collection->id }}</td>
                            <td>{{ $collection->name }}</td>
                            <td>{{ $collection->description }}</td>
                            <td>{{ $collection->order }}</td>
                            <td>{{ $collection->status == 1 ? "Active" : "Inactive" }}</td>
                            <td>{{ $collection->slider_speed." sec." }}</td>
                            <td>
                                <a href="{{ url('/dashboard/edit-collection/'.$collection->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ url('/dashboard/delete-collection/'.$collection->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm">Delete</a>
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
