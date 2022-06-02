@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>{{ $page == 'archived_orders' ? 'Archived' : 'Active' }} Orders</strong>
        </h1>
        <a href="{{ url('/dashboard/manage-order/export/'.($page == 'archived_orders' ? 1 : 0)) }}" class="btn btn-float btn-sm btn-primary" title="Download CSV"><i class="ti-download"></i></a>
        {{-- <a href="{{ url('/dashboard/manage-order/shipposync/'.($page == 'archived_orders' ? 1 : 0)) }}" class="btn btn-float btn-sm btn-primary" title="Sync with Shippo"><i class="ti-bolt-alt"></i></a> --}}
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

                @if (session('errors'))
                    @php
                        $errors = is_object( session('errors') ) ? session('errors')->all() : session('errors');
                    @endphp
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                        @foreach ( $errors as $error )
                           {!! $error !!}<br>
                        @endforeach
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                        {!! session('status') !!}
                    </div>
                @endif
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <!--
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            | Zero configuration
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            !-->
            <div class="card">
                <h4 class="card-title">{{ $page == 'archived_orders' ? 'Archived' : 'Active' }} Orders</h4>

                <div class="card-body">
                    @if( $orders->count() > 0 )
                    <form action="{{ url('/dashboard/edit-multple-orders') }}" id="orders_action_form" method="post">
                    @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>Perform an action on selected order(s):</h5>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <select name="orders_action" id="orders_action" class="form-control">
                                            <option value=""> &mdash; Select Action &mdash; </option>
                                            <option value="status">Change orders status</option>
                                            <option value="{{ $page == 'archived_orders' ? 'unarchive' : 'archive' }}">{{ $page == 'archived_orders' ? 'Unarchive' : 'Archive' }} orders</option>
                                            <option value="delete">Delete orders</option>
                                            <option value="export_{{ $page == 'archived_orders' ? 'archived' : 'active' }}">Export CSV</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label id="orders_action_status_label" for="orders_action_status bold" style="display: none;"> to &nbsp;
                                            <select name="orders_action_status" id="orders_action_status" class="form-control">
                                                <option value="1">Pending</option>
                                                <option value="2">In Process</option>
                                                <option value="3">Dispatched</option>
                                                <option value="4">Cancelled</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Submit" id="orders_action_submit" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <hr/>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="orders_check_all" class="orders-check-all" value="0"></th>
                                    <th>Order Id</th>
                                    <th>Customer</th>
                                    <th>Payment Status</th>
                                    <th>Total Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Order Status</th>
                                    <th>Created At</th>
                                    <th>Shippo Status</th>
                                    <th>Detail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selected_orders[]" class="orders-checks" value="{{$order->id}}">
                                    </td>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        @if( $order->customer && $order->customer->user )
                                            ID: {{$order->customer_id}}, <br>Name: {{ $order->customer->user->name }} (Registered)
                                        @elseif($order->customer)
                                        ID: {{$order->customer_id}}, <br>Name: {{ $order->customer->billing_fullname }} (Guest)
                                        @else
                                        ID: {{ $order->customer_id }} (Guest)
                                        @endif
                                    </td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td class="text-right">${{ number_format( $order->total_amount, 2 ) }}</td>
                                    <td class="text-right">${{ number_format( $order->paid_amount, 2 ) }}</td>
                                    <td>
                                    @php $statuses = ['', 'Pending', 'In Process', 'Dispatched', 'Cancelled'] @endphp
                                    {{ $statuses[$order->order_status] }}
                                    {{-- <select id="order-status" class="form-control" data-oid="{{ $order->id }}" data-cid="{{ $order->customer_id }}" style="padding:0;">
                                    <option value="1" {{ $order->order_status == 1 ? 'disabled selected' : '' }}>Pending</option>
                                    <option value="2" {{ $order->order_status == 2 ? 'disabled selected' : '' }}>In Process</option>
                                    <option value="3" {{ $order->order_status == 3 ? 'disabled selected' : '' }}>Dispatched</option>
                                    <option value="4" {{ $order->order_status == 4 ? 'disabled selected' : '' }}>Cancelled</option>
                                    </select> --}}
                                    </td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        @if( $order->order_status == 2 && $order->payment_status == 'Succeeded' )
                                            @if( $order->shippo_synced )
                                                <span class="text-success"> Synced </span>
                                            @else
                                                <span class="text-danger"> Not Synced </span>
                                            @endif
                                        @else
                                            &nbsp;
                                        @endif
                                    </td>
                                    <td><a href="javascript:;" class="btn btn-info btn-sm view-order-detail" data-oid="{{ $order->id }}">View</a></td>
                                    <td>
                                    {{--<a href="{{ url('/dashboard/edit-order/'.$order->id) }}" class="btn btn-primary btn-sm">Edit</a>--}}
                                    <a href="{{ url('/dashboard/delete-order/'.$order->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </form>
                    @else
                        <p class="text-center"><em>no orders found</em></p>
                    @endif
                </div>
            </div>

        </div>


    </div>
</div><!--/.main-content -->

<!-- Modal -->
<div class="modal fade" id="orderDetailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Order Detail</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="order_modal_body" class="modal-body">
                {{-- <h5 class="text-center">Billing &amp; Shipping Detail</h5>
                <table class="table table-responsive">
                    <tbody>

                    </tbody>
                </table> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@include('admin.pages.layouts.footer')
