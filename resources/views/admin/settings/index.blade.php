@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Settings</strong>
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
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <a href="{{ url('/dashboard/settings/taxrates') }}" class="card-body card">
                <h1>&nbsp;</h1>
                <h1 class="text-center">
                    <span class="icon ti-settings"></span>
                </h1>
                <h1 class="text-center">Tax Rates</h1>
                <h1>&nbsp;</h1>
            </a>
        </div>
        <div class="col-sm-3">
            <a href="{{ url('/dashboard/settings/sliders') }}" class="card-body card">
                <h1>&nbsp;</h1>
                <h1 class="text-center">
                    <span class="icon ti-settings"></span>
                </h1>
                <h1 class="text-center">Sliders</h1>
                <h1>&nbsp;</h1>
            </a>
        </div>
        <div class="col-sm-3">
            <a href="{{ url('/dashboard/settings/general') }}" class="card-body card">
                <h1>&nbsp;</h1>
                <h1 class="text-center">
                    <span class="icon ti-settings"></span>
                </h1>
                <h1 class="text-center">General</h1>
                <h1>&nbsp;</h1>
            </a>
        </div>
    </div><!--/.main-content -->

@include('admin.pages.layouts.footer')