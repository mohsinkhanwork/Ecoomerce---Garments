@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Cms Pages</strong>
        </h1>
    </div>
</header><!--/.header -->

<div class="main-content">
    <div class="row">
        <div class="col-sm-12">
            @if (session('status'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('status') }}
            </div>
            @endif
        </div>
        <div class="col-sm-12">
            <div class="card">
                <h4 class="card-title">Manage Cms Pages

                </h4>

                <div class="card-body">

                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th>Page Title</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                                <tr>
                                    <td>{{$page->id}}</td>
                                    <td>{{$page->title}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm edit-taxrate-action" href="{{url('dashboard/settings/pages')}}/{{$page->id}}/edit">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
</div>

    </div>

</div>

@include('admin.pages.layouts.footer')
